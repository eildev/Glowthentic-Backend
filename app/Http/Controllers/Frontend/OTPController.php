<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OTPData;
use App\Models\Order;
use App\Models\OrderBillingDetails;
use App\Models\OrderDetails;
use Illuminate\Support\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Mail\OrderMail;
use App\Mail\OrderNotice;
use Illuminate\Support\Facades\Mail;
class OTPController extends Controller
{
    public function storeOTP(Request $request){

        // $otp = $this->otpGenarate($request->phone);
        // $number = $otp->phone;
        // $api_key = "0yRu5BkB8tK927YQBA8u";
        // $senderid = "8809617615171";
        // $message = "Your One Time Password (OTP) for Verification : ".$otp->otp.". This OTP is valid for 5 minutes. Please do not share Your OTP with anyone";
        // $url = "http://bulksmsbd.net/api/smsapi";
        // $data = [
        //     "api_key" => $api_key,
        //     'number' =>$number,
        //     'senderid' => $senderid,
        //     'message' => $message
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $response = curl_exec($ch);
        // curl_close($ch);
        // $response = json_decode($response, true);
        // if($response['response_code'] == 202){
            return response()->json([
            'status' => 200,
            'message' =>'OTP has been Successfully Sent'
            ]);
        // }
        // else{
        //   return response()->json([
        //     'status' => 404,
        //     'message' => 'Bad Request',
        //     ]);
        // }

    }
    public function otpGenarate($phone){
        $verificationCode = OTPData::wherePhone($phone)->latest()->first();
        $now = Carbon::now();

        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }
        return OTPData::create([
            'phone' => $phone,
            'otp' => rand(123456, 99999),
            'expire_at' => Carbon::now()->addMinutes(5)
        ]);
    }

    public function checkOTP(Request $request){
        // dd($request);
        // $verificationCode = OTPData::where('phone',$request->phone)->where('otp',$request->otp)->first();
        // $now = Carbon::now();
        // if(!$verificationCode){
        //     return response()->json([
        //     'success' => false,
        //     'message' => 'Invalid OTP'
        //     ]);
        // }
        // else if($verificationCode && $now->isAfter($verificationCode->expire_at)){
        //     return response()->json([
        //     'success' => false,
        //     'message' => 'OTP has been Expire'
        //     ]);
        // }else{
            // dd(Cart::content());
            $invoiceNumber = rand(123456,999999);
            // store order details
                $order = new Order;
                $identifer = '';
                if(!empty(Auth::user()->id)){
                    $identifer = Auth::user()->id;
                }
                else{
                    $identifer = $request->phone;
                }
                $order->user_identity = $identifer;
                $order->invoice_number = $invoiceNumber;
                $order->product_quantity = Cart::count();
                $order->product_total = Cart::total();
                $order->coupon_id = $request->coupon_id;
                $order->discount = $request->discount;
                $order->sub_total = $request->sub_total;
                $order->shipping_method = 'In Dhaka';
                $order->shipping_amount = $request->shipping_amount;
                $order->grand_total = $request->sub_total;
                $order->payment_method = 'Cash on Delivery';
                $order->save();
            // store billing details
                $validator = Validator::make($request->all(), [
                    'phone' => 'required|max:11|min:11',
                    'first_name' => 'required|max:15',
                    'address_1' => 'required|max:5',
                    'city' => 'required||max:100',
                    'division' => 'required|max:5',
                    'post_code' => 'required'
                ]);

                    $order_billing_details = new OrderBillingDetails;
                    $order_billing_details->phone = $request->phone;
                    $order_billing_details->order_id = $order->id;
                    $order_billing_details->first_name = $request->first_name;
                    $order_billing_details->last_name = $request->last_name;
                    $order_billing_details->email = $request->email;
                    $order_billing_details->address_1 = $request->address_1;
                    $order_billing_details->address_2 = $request->address_2;
                    $order_billing_details->city = $request->city;
                    $order_billing_details->division = $request->division;
                    $order_billing_details->post_code = $request->post_code;
                    $order_billing_details->country = 'Bangladesh';
                    $order_billing_details->order_notes = $request->order_notes;
                    $order_billing_details->save();


            // Product oRDER Details
                $products = Cart::content();
                foreach ($products as $product) {
                    $OrderDetails = new OrderDetails;
                    $OrderDetails->order_id = $order->id;
                    $OrderDetails->product_id = $product->id;
                    $OrderDetails->variant_id = $product->options->variant_id;
                    $OrderDetails->weight = $product->weight;
                    $OrderDetails->product_price = $product->price;
                    $OrderDetails->total_price = $product->price * $product->qty;
                    $OrderDetails->product_quantity = $product->qty;
                    $OrderDetails->save();
                }
                $data = [
                    'name' => $request->first_name,
                    'phone' => $request->phone,
                    'invoiceNumber' => $invoiceNumber
                ];
                Mail::to('sobrokom.store@gmail.com')->send(new OrderNotice($data));

                Cart::destroy();
                return response()->json([
                'status' => 200,
                'message' =>'Your order has been Submitted successfully',
                'data' => $data
                ]);
        // }

    }
}
