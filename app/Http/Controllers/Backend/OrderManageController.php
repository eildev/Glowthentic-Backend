<?php

namespace App\Http\Controllers\Backend;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\OrderBillingDetails;
use App\Models\User;
use App\Models\Variant;
use App\Models\DeliveryOrder;
use App\Models\UserDetails;
class OrderManageController extends Controller
{
    public function allUser(){
        $allUsers = User::all();
        return response()->json([
            'status' => 200,
            'allusers' => $allUsers
            ]);
    }
    public function SendSMS(Request $request){
        // dd($request->all());
        $number = $request->phone;
        $api_key = "0yRu5BkB8tK927YQBA8u";
        $senderid = "8809617615171";
        $message = $request->sms;
        $url = "http://bulksmsbd.net/api/smsapi";
        $data = [
            "api_key" => $api_key,
            'number' =>$number,
            'senderid' => $senderid,
            'message' => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);
        if($response['response_code'] == 202){
            return back()->with('success','Message Successfully Send');
        }
        else{
            return back()->with('warring','Something went wrong Message not Send');
        }
    }
    public function index(){
        $newOrders = Order::where("status", 'pending')->orWhere('status','mismatchOrder')->latest()->get();

        return view('backend.order.new-order', compact('newOrders'));
    }
    public function approvedOrders(){
        $approved_orders = Order::where("status", 'approve')->latest()->get();
        return view('backend.order.approved-order', compact('approved_orders'));
    }
    public function processedOrders(){
        $processed_orders = Order::where("status", 'processing')->latest()->get();
        return view('backend.order.processed-order', compact('processed_orders'));
    }
    public function deliveringOrders(){
        $delivering_orders = DeliveryOrder::where("delivery_status", 'shipping')->with('order')->latest()->get();
        // dd($delivering_orders);
        return view('backend.order.logistics', compact('delivering_orders'));
    }
    public function completedOrders(){
        $completed_orders = Order::where("status", 'completed')->latest()->get();
        return view('backend.order.completed-order', compact('completed_orders'));
    }
    public function refundOrders(){
        $refunding_orders = Order::where("status", 'refunding')->latest()->get();
        return view('backend.order.refunding-order', compact('refunding_orders'));
    }
    public function refundedOrders(){
        $refunded_orders = Order::where("status", 'refunded')->latest()->get();
        return view('backend.order.refunded-orders', compact('refunded_orders'));
    }
    public function canceledOrders(){
        $canceled_orders = Order::where("status", 'canceled')->latest()->get();
        return view('backend.order.canceled-orders', compact('canceled_orders'));
    }
    public function deniedOrders(){
        $denied_orders = Order::where("status", 'denied')->latest()->get();
        return view('backend.order.denied-orders', compact('denied_orders'));
    }
    public function orderProcessing($invoice){
        // dd($invoice);
        $processing_Orders = Order::where("invoice_number",$invoice)->latest()->first();
       
        // dd($processing_Orders);
        $processing_Orders->status = "processing";
        $processing_Orders->update();
        return back()->with('success','Order Status Updated Sucessfully');
    }
    public function orderDelivering($invoice){
        // dd($invoice);
        $orders_delivering = Order::where("invoice_number",$invoice)->latest()->first();
      
        $orders_delivering->status = "delivering";
        $orders_delivering->update();
        return back()->with('success','Order Status Updated Sucessfully');
    }

    public function orderCompleted($invoice){
        $completed_Orders = Order::where("invoice_number",$invoice)->latest()->first();
        // dd($completed_Orders);
        $completed_Orders->status = "completed";
        $completed_Orders->update();

        $orderId = $completed_Orders->id;
        // dd($orderId);
        $orders = OrderDetails::where("order_id", $orderId)->get();

        foreach($orders as $order){
            // dd($order);
            $variant_id = $order->variant_id;
            // $product_id = $order->product_id;
            $product_quantity = $order->product_quantity;
            // dd($product_id);

            $variant = Variant::findOrFail($variant_id);
            // dd($variant);
            // dd($variant->stock_quantity);
            $updated_stock = (int)$variant->stock_quantity - (int)$product_quantity;
            $variant->stock_quantity = $updated_stock;

            // dd($variant->stock_quantity);
            $variant->update();
        }
        return back()->with('success','Order Status Updated Sucessfully');
    }
    public function orderRefund($invoice){
        $refund_orders = Order::where("invoice_number",$invoice)->latest()->first();
        $refund_orders->status = "refunding";
        $refund_orders->update();
        return back()->with('success','Order Status Updated Sucessfully');
    }
    public function orderRefunded($invoice){
        $refunded_orders = Order::where("invoice_number",$invoice)->latest()->first();
        $refunded_orders->status = "refunded";
        $refunded_orders->update();
        return back()->with('success','Order Status Updated Sucessfully');
    }
    public function orderCancel($invoice){
        $canceled_order = Order::where("invoice_number",$invoice)->latest()->first();
        $canceled_order->status = "canceled";
        $canceled_order->update();
        return back()->with('success','Order Status Updated Sucessfully');
    }
    public function adminDenied($invoice){

        $denied_order = Order::where("invoice_number",$invoice)->latest()->first();

        $denied_order->status = "denied";
        $denied_order->update();
        return back()->with('success','Order Status Denied Sucessfully');
    }
    public function adminApprove($id){

        $newOrders = Order::where("id",$id)->latest()->first();

        $newOrders->status="approve";
        $newOrders->update();

        $trackingUrl = 'https://sobrokom.store/order-tracking';
        $number = $newOrders->user_identity;
        $api_key = "0yRu5BkB8tK927YQBA8u";
        $senderid = "8809617615171";
        $message = "Your order has been confirmed. your invoice number is : ".$newOrders->invoice_number." you find your product using this invoice Number in here: ".$trackingUrl;
        $url = "http://bulksmsbd.net/api/smsapi";
        $data = [
            "api_key" => $api_key,
            'number' =>$number,
            'senderid' => $senderid,
            'message' => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $email = OrderBillingDetails::where('order_id',$newOrders->id)->first();
        $url = 'https://sobrokom.store/order-tracking/invoice';
        $data = [
            'name' => $newOrders->first_name,
            'invoiceNumber' => $newOrders->invoice_number,
            'trackingURL'=> $url
        ];
        if(!empty($email->email)){
            Mail::to($email->email)->send(new OrderMail($data));
        }


        $response = json_decode($response, true);
        if($response['response_code'] == 202){
            return back()->with('success','Order Successfully Approved');
        }
        else{
            return back()->with('warring','Something went wrong Order Not Approved');
        }
    }
    public function orderTracking(){
        return view('frontend/e-com/tracking-product');
    }
    public function orderTrackingInvoice(Request $request){
        $searchTag = $request->search;
        $trackes = Order::where('invoice_number', $request->search)->get();
        return view('frontend/e-com/tracking-product', compact('trackes','searchTag'));
    }

    public function DetailOrders($order_id){

        $orders = Order::findOrFail($order_id);
        // dd($orders);
        return view('backend.order.order_details', compact('orders'));
        // $order_details->status = "Inactive";
        // $order_details->update();
        return back();
    }
     public function thank($id)
    {
        $order = Order::where('invoice_number', $id)->first();
        $order_details = OrderDetails::where('order_id', $order->id)->get();
        $billing = OrderBillingDetails::where('order_id', $order->id)->latest()->first();
        return view('frontend.e-com.thank-you', compact('order', 'order_details', 'billing'));
    }

    public function getOrderDetails(Request $request){
        $order_id = $request->order_id;

         $getorder= Order::where('id',$order_id)->first();
         $user_id = $getorder->user_id??$getorder->session_id;

         $userInfo = UserDetails::where('user_id',$user_id)->orWhere('session_id',$user_id)->first();

         return response()->json([
            'status' => 200,
            'userInfo' => $userInfo,
            'order' => $getorder
         ]);

    }
}
