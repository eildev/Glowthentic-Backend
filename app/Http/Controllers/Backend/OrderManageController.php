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
use App\Mail\OrderConformationMail;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ProductPromotion;
use App\Models\VariantPromotion;
use Illuminate\Support\Collection;
use App\Services\BillingInformationService;
use App\Services\UserDetailsService;
use App\Models\BillingInformation;
use App\Models\Combo;
use App\Models\ComboProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrderManageController extends Controller
{
    // protected variable 
    protected $billingInformationService;
    protected $userDetailsService;


    // call to service function 
    public function __construct(BillingInformationService $billingInformationService, UserDetailsService $userDetailsService)
    {
        $this->billingInformationService = $billingInformationService;
        $this->userDetailsService = $userDetailsService;
    }

    // all user function 
    public function allUser()
    {
        $allUsers = User::all();
        return response()->json([
            'status' => 200,
            'allusers' => $allUsers
        ]);
    }

    // sendSMS function 
    public function SendSMS(Request $request)
    {
        // dd($request->all());
        $number = $request->phone;
        $api_key = "0yRu5BkB8tK927YQBA8u";
        $senderid = "8809617615171";
        $message = $request->sms;
        $url = "http://bulksmsbd.net/api/smsapi";
        $data = [
            "api_key" => $api_key,
            'number' => $number,
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
        if ($response['response_code'] == 202) {
            return back()->with('success', 'Message Successfully Send');
        } else {
            return back()->with('warring', 'Something went wrong Message not Send');
        }
    }

    public function index()
    {
        $newOrders = Order::where("status", 'pending')->orWhere('status', 'mismatchOrder')->latest()->get();

        return view('backend.order.new-order', compact('newOrders'));
    }
    public function approvedOrders()
    {
        $approved_orders = Order::where("status", 'approve')->latest()->get();
        return view('backend.order.approved-order', compact('approved_orders'));
    }
    public function processedOrders()
    {
        $processed_orders = Order::where("status", 'processing')->latest()->get();
        return view('backend.order.processed-order', compact('processed_orders'));
    }
    public function deliveringOrders()
    {
        $delivering_orders = DeliveryOrder::where("delivery_status", 'shipping')->with('order')->latest()->get();
        // dd($delivering_orders);
        return view('backend.order.logistics', compact('delivering_orders'));
    }
    public function completedOrders()
    {
        $completed_orders = Order::where("status", 'completed')->latest()->get();
        return view('backend.order.completed-order', compact('completed_orders'));
    }
    public function refundOrders()
    {
        $refunding_orders = Order::where("status", 'refunding')->latest()->get();
        return view('backend.order.refunding-order', compact('refunding_orders'));
    }
    public function refundedOrders()
    {
        $refunded_orders = Order::where("status", 'refunded')->latest()->get();
        return view('backend.order.refunded-orders', compact('refunded_orders'));
    }
    public function canceledOrders()
    {
        $canceled_orders = Order::where("status", 'canceled')->latest()->get();
        return view('backend.order.canceled-orders', compact('canceled_orders'));
    }
    public function deniedOrders()
    {
        $denied_orders = Order::where("status", 'denied')->latest()->get();
        return view('backend.order.denied-orders', compact('denied_orders'));
    }
    public function orderProcessing($invoice)
    {
        // dd($invoice);
        $processing_Orders = Order::where("invoice_number", $invoice)->latest()->first();

        // dd($processing_Orders);
        $processing_Orders->status = "processing";
        $processing_Orders->update();
        return back()->with('success', 'Order Status Updated Sucessfully');
    }
    public function orderDelivering($invoice)
    {
        // dd($invoice);
        $orders_delivering = Order::where("invoice_number", $invoice)->latest()->first();

        $orders_delivering->status = "delivering";
        $orders_delivering->update();
        return back()->with('success', 'Order Status Updated Sucessfully');
    }

    public function orderCompleted($invoice)
    {
        $completed_Orders = Order::where("invoice_number", $invoice)->latest()->first();
        // dd($completed_Orders);
        $completed_Orders->status = "completed";
        $completed_Orders->update();

        $orderId = $completed_Orders->id;
        // dd($orderId);
        $orders = OrderDetails::where("order_id", $orderId)->get();

        foreach ($orders as $order) {
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
        return back()->with('success', 'Order Status Updated Sucessfully');
    }
    public function orderRefund($invoice)
    {
        $refund_orders = Order::where("invoice_number", $invoice)->latest()->first();
        $refund_orders->status = "refunding";
        $refund_orders->update();
        return back()->with('success', 'Order Status Updated Sucessfully');
    }
    public function orderRefunded($invoice)
    {
        $refunded_orders = Order::where("invoice_number", $invoice)->latest()->first();
        $refunded_orders->status = "refunded";
        $refunded_orders->update();
        return back()->with('success', 'Order Status Updated Sucessfully');
    }
    public function orderCancel($invoice)
    {
        $canceled_order = Order::where("invoice_number", $invoice)->latest()->first();
        $canceled_order->status = "canceled";
        $canceled_order->update();
        return back()->with('success', 'Order Status Updated Sucessfully');
    }
    public function adminDenied($invoice)
    {

        $denied_order = Order::where("invoice_number", $invoice)->latest()->first();

        $denied_order->status = "denied";
        $denied_order->update();
        return back()->with('success', 'Order Status Denied Sucessfully');
    }




    // admin approve 
    public function adminApprove($id)
    {

        $newOrders = Order::findOrFail($id);

        $newOrders->status = "approve";
        $newOrders->update();
        if ($newOrders->user_id) {
            $userDetails = UserDetails::where("user_id", $newOrders->user_id)->latest()->first();
            if ($userDetails && $userDetails->secondary_email) {
                Mail::to($userDetails->secondary_email)->send(new OrderConformationMail($newOrders));
            } else {
                $user = User::find($newOrders->user_id);
                if ($user && $user->email) {
                    Mail::to($user->email)->send(new OrderConformationMail($newOrders));
                }
            }
        } else {
            $userDetails = UserDetails::where("session_id", $newOrders->session_id)->latest()->first();
            if ($userDetails && $userDetails->secondary_email) {
                Mail::to($userDetails->secondary_email)->send(new OrderConformationMail($newOrders));
            }
        }


        $first_digit = substr($newOrders->userDetails->phone_number, 0, 1);

        if ($first_digit === '0') {
            $phone_number = '+88' . $newOrders->userDetails->phone_number;
        } elseif ($first_digit === '1') {
            $phone_number = '+880' . $newOrders->userDetails->phone_number;
        } else {
            $phone_number = '+880' . $newOrders->userDetails->phone_number;
        }

        // sms to phone 
        $trackingUrl = 'https://glowthentic.store/order-progress?orderId=' . ($newOrders ? $newOrders->invoice_number : '');
        // $number = $newOrders->userDetails->phone_number;
        $number = $phone_number;
        $api_key = "0yRu5BkB8tK927YQBA8u";
        $senderid = "8809617615171";
        $message = "Your order has been confirmed. your invoice number is : " . $newOrders->invoice_number . " you find your product using this invoice Number in here: " . $trackingUrl;
        $url = "http://bulksmsbd.net/api/smsapi";
        $data = [
            "api_key" => $api_key,
            'number' => $number,
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
        $email = OrderBillingDetails::where('order_id', $newOrders->id)->first();
        $data = [
            'name' => $newOrders->first_name,
            'invoiceNumber' => $newOrders->invoice_number,
            'trackingURL' => $trackingUrl
        ];

        $response = json_decode($response, true);
        if ($response['response_code'] == 202) {
            return back()->with('success', 'Order Successfully Approved');
        } else {
            return back()->with('warring', 'Something went wrong Order Not Approved');
        }
    }
    public function orderTracking()
    {
        return view('frontend/e-com/tracking-product');
    }
    public function orderTrackingInvoice(Request $request)
    {
        $searchTag = $request->search;
        $trackes = Order::where('invoice_number', $request->search)->get();
        return view('frontend/e-com/tracking-product', compact('trackes', 'searchTag'));
    }

    public function DetailOrders($order_id)
    {

        $orders = Order::findOrFail($order_id);

        // dd($orders);
        return view('backend.order.order_details', compact('orders'));
        // $order_details->status = "Inactive";
        // $order_details->update();
        // return back();
    }
    public function thank($id)
    {
        $order = Order::where('invoice_number', $id)->first();
        $order_details = OrderDetails::where('order_id', $order->id)->get();
        $billing = OrderBillingDetails::where('order_id', $order->id)->latest()->first();
        return view('frontend.e-com.thank-you', compact('order', 'order_details', 'billing'));
    }

    public function getOrderDetails(Request $request)
    {
        $order_id = $request->order_id;

        $getorder = Order::where('id', $order_id)->first();
        $user_id = $getorder->user_id ?? $getorder->session_id;

        $userInfo = UserDetails::where('user_id', $user_id)->orWhere('session_id', $user_id)->first();
        // dd($userInfo);

        return response()->json([
            'status' => 200,
            'userInfo' => $userInfo,
            'order' => $getorder
        ]);
    }



    public function customOrderCreate()
    {

        $allproduct = Product::where('status', 1)
            ->get()
            ->map(function ($item) {

                return [
                    'id' => $item->id,
                    'name' => $item->product_name,
                    'type' => 'product',
                ];
            });


        $comboProducts = Combo::where('status', 'active')
            ->whereIn('id', function ($query) {
                $query->select('combo_id')
                    ->from('combo_products')
                    ->distinct();
            })
            ->get()
            ->map(function ($item) {
                $item->type = 'combo';
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'type' => 'combo',
                ];
            });


        $product = $allproduct->concat($comboProducts);


        $user = User::where('role', 'user')->get()->map(function ($u) {
            return [
                'id' => $u->id,
                'name' => $u->name,
                'source' => 'user',
            ];
        });


        $user_details = UserDetails::whereNull('user_id')->get()->map(function ($u) {
            return [
                'id' =>  $u->id,
                'name' => $u->full_name,
                'source' => 'user_detail',
            ];
        });


        $custom_user = $user->merge($user_details);

        return view('backend.order.custom_order', compact('product', 'custom_user'));
    }

    public function getCustomUserDetails(Request $request)
    {
        try {
            if ($request->source == 'user') {
                $user = User::findOrFail($request->id);
                $user_details = UserDetails::where('user_id', $request->id)->first();
                if ($user_details) {
                    $user_data = $user_details;
                } else {
                    $user_data = $user;
                }
            } else {
                $user = UserDetails::findOrFail($request->id);
                $user_data = UserDetails::where('id', $request->id)->first();
            }
            return response()->json([
                'status' => 200,
                'user_data' => $user_data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function getVariantCustomOrderInfo($id)
    {
        try {
            $today = Carbon::today();


            $variant = Variant::with([
                'product',
                'product.category',
                'productStock'
            ])->findOrFail($id);


            $checkCategoryPromotion = ProductPromotion::with('coupon')
                ->where('category_id', $variant->product->category_id)
                ->first();


            $checkProductPromotion = ProductPromotion::with('coupon')
                ->where('product_id', $variant->product_id)
                ->first();


            $variantPromotion = VariantPromotion::with('coupon')
                ->where('variant_id', $id)
                ->first();


            $activePromotion = null;
            $promotionSource = null;
            $activePromotioncal = 0;

            if (
                $checkCategoryPromotion && $checkCategoryPromotion->coupon &&
                $today->between(Carbon::parse($checkCategoryPromotion->coupon->start_date), Carbon::parse($checkCategoryPromotion->coupon->end_date))
            ) {

                $promotionId = $checkCategoryPromotion->promotion_id;

                if (
                    (!$checkProductPromotion || ($checkProductPromotion->promotion_id == $promotionId)) &&
                    (!$variantPromotion || ($variantPromotion->promotion_id == $promotionId))
                ) {
                    $activePromotion = $checkCategoryPromotion;
                    $promotionSource = 'category';
                }
            }


            if (
                !$activePromotion && $checkProductPromotion && $checkProductPromotion->coupon &&
                $today->between(Carbon::parse($checkProductPromotion->coupon->start_date), Carbon::parse($checkProductPromotion->coupon->end_date))
            ) {

                $promotionId = $checkProductPromotion->promotion_id;

                if (!$variantPromotion || $variantPromotion->promotion_id != $promotionId) {
                    $activePromotion = $checkProductPromotion;
                    $promotionSource = 'product';
                }
            }


            if (
                !$activePromotion && $variantPromotion && $variantPromotion->coupon &&
                $today->between(Carbon::parse($variantPromotion->coupon->start_date), Carbon::parse($variantPromotion->coupon->end_date))
            ) {

                $activePromotion = $variantPromotion;
                $promotionSource = 'variant';
            }
            if ($activePromotion && $activePromotion->coupon->discount_type == 'percentage') {

                $activePromotioncal = $variant->regular_price * $activePromotion->coupon->discount_value / 100;
            }
            if ($activePromotion && $activePromotion->coupon->discount_type == 'fixed') {
                $activePromotioncal = $activePromotion->coupon->discount_value;
            }


            return response()->json([
                'status' => 200,
                'variant' => $variant,
                'promotion' => $activePromotioncal,
                'promotion_source' => $promotionSource,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    // create custome Order 
    public function createCustomOrder(Request $request)
    {

        // dd($request->all());
        try {
            // dd($request->all());
            if ($request->source == "user") {
                $user_data = User::findOrFail($request->custom_user_id);
                $user_details = UserDetails::where('user_id', $request->custom_user_id)->first();
                if ($user_details) {
                    $user_data = $user_details;
                } else {
                    $user_data = new UserDetails();
                }
                $user_data->user_id = $user_data->id;
                $user_data->full_name = $request->full_name;
                $user_data->secondary_email = $request->secondary_email;
                $user_data->phone_number = $request->phone_number;
                $user_data->address = $request->address;

                $user_data->city = $request->district;
                $user_data->postal_code = $request->postal_code;
                $user_data->police_station = $request->police_station;
                $user_data->country = $request->country ?? '';
                $user_data->save();

                // Billing Information
                $billingInfo = new BillingInformation();
                $billingInfo->user_id = $request->user_id;
                $existingBillingInfo = BillingInformation::where('user_id', $request->user_id)->first();
                $billingInfo->is_default = $existingBillingInfo ? 1 : 0;
                $billingInfo->status = "saved";
                $billingInfo->active_payment_method = $request->active_payment_method;

                // Store payment details based on method
                if ($request->active_payment_method == 'card') {
                    $billingInfo->card_number = $request->card_number;
                    $billingInfo->cvc_code = $request->cvc_code;
                    $billingInfo->card_expiry_date = $request->card_expiry_date;
                } elseif ($request->active_payment_method == 'mobile_banking') {
                    $billingInfo->mobile_banking_id = $request->mobile_banking_id;
                    $billingInfo->verified_mobile = $request->verified_mobile;
                    $billingInfo->verified_mobile_number = $request->verified_mobile_number;
                }

                $billingInfo->save();
            } else if ($request->source == "user_detail") {
                $user_details = UserDetails::where('id', $request->custom_user_id)->first();

                if ($user_details) {
                    $user_data = $user_details;
                } else {
                    $user_data = new UserDetails();
                }
                if ($user_details->customer_id == null) {
                    $cust_id = UserDetails::latest()->first();
                    $user_data->customer_id = $cust_id ? $cust_id->id + 1 : 1;
                }
                $user_data->full_name = $request->full_name;
                $user_data->secondary_email = $request->secondary_email;
                $user_data->phone_number = $request->phone_number;
                $user_data->address = $request->address;

                $user_data->city = $request->district;
                $user_data->postal_code = $request->postal_code;
                $user_data->police_station = $request->police_station;
                $user_data->country = $request->country ?? '';
                $user_data->save();

                // Billing Information
                $billingInfo = new BillingInformation();
                $billingInfo->session_id = $user_data->session_id;
                $existingBillingInfo = BillingInformation::where('user_id', $request->user_id)->first();
                $billingInfo->is_default = $existingBillingInfo ? 1 : 0;
                $billingInfo->status = "saved";
                $billingInfo->active_payment_method = $request->active_payment_method;

                // Store payment details based on method
                if ($request->active_payment_method == 'card') {
                    $billingInfo->card_number = $request->card_number;
                    $billingInfo->cvc_code = $request->cvc_code;
                    $billingInfo->card_expiry_date = $request->card_expiry_date;
                } elseif ($request->active_payment_method == 'mobile_banking') {
                    $billingInfo->mobile_banking_id = $request->mobile_banking_id;
                    $billingInfo->verified_mobile = $request->verified_mobile;
                    $billingInfo->verified_mobile_number = $request->verified_mobile_number;
                }

                $billingInfo->save();
            } else {

                $user_data = new UserDetails();

                $user_data->full_name = $request->full_name;
                $cust_id = UserDetails::latest()->first();
                $user_data->customer_id = $cust_id ? $cust_id->id + 1 : 1;

                $user_data->secondary_email = $request->secondary_email;
                $user_data->phone_number = $request->phone_number;
                $user_data->address = $request->address;

                $user_data->city = $request->district;
                $user_data->postal_code = $request->postal_code;
                $user_data->police_station = $request->police_station;
                $user_data->country = $request->country ?? '';
                $user_data->save();

                // Billing Information
                $billingInfo = new BillingInformation();
                $billingInfo->customer_id = $user_data->customer_id;

                $existingBillingInfo = BillingInformation::where('user_id', $request->user_id)->first();
                $billingInfo->is_default = $existingBillingInfo ? 1 : 0;
                $billingInfo->status = "saved";
                $billingInfo->active_payment_method = $request->active_payment_method;

                // Store payment details based on method
                if ($request->active_payment_method == 'card') {
                    $billingInfo->card_number = $request->card_number;
                    $billingInfo->cvc_code = $request->cvc_code;
                    $billingInfo->card_expiry_date = $request->card_expiry_date;
                } elseif ($request->active_payment_method == 'mobile_banking') {
                    $billingInfo->mobile_banking_id = $request->mobile_banking_id;
                    $billingInfo->verified_mobile = $request->verified_mobile;
                    $billingInfo->verified_mobile_number = $request->verified_mobile_number;
                }

                $billingInfo->save();
            }

            $order = new Order();
            if ($request->source == "user") {
                $order->user_id = $user_data->user_id;
            } elseif ($request->source == "user_detail") {
                $order->session_id = $user_data->session_id;
            } else {

                $order->customer_id = $user_data->customer_id;
            }

            $total_discount = 0;
            $total_amount = 0;
            $total_quantity = 0;

            foreach ((array) ($request->total_discount ?? []) as $key => $value) {
                $total_discount += $value;
            }

            foreach ((array) ($request->quantity ?? []) as $key => $value) {
                $total_quantity += $value;
            }

            foreach ((array) ($request->combo_quantity ?? []) as $key => $value) {
                $total_quantity += $value;
            }

            $total_amount = (float) ($request->subtotal ?? 0) + $total_discount;

            $order->discount_amount = $total_discount + $request->discount;

            $order->total_amount = $total_amount;
            $order->total_quantity = $total_quantity;
            $order->sub_total = $request->subtotal;
            $order->status = "Approve";
            $order->grand_total = $request->grand_total;
            $order->payment_method = $request->active_payment_method;
            $order->shipping_charge = $request->shipping_charge;
            $order->invoice_number = rand(100000, 999999);
            $order->save();

            if ($order->id) {
                if (isset($request->variant_id) && is_array($request->variant_id)) {
                    foreach ($request->variant_id as $key => $variant_id) {
                        $order_details = new OrderDetails();
                        $order_details->order_id = $order->id;
                        $order_details->variant_id = $variant_id;
                        $order_details->product_id = $request->product_id[$key] ?? null;
                        $order_details->product_quantity = $request->quantity[$key] ?? 0;
                        $order_details->unit_price = $request->price[$key] ?? 0;
                        $order_details->total_price = $request->variant_total_price[$key] ?? 0;
                        $order_details->save();
                    }
                }

                if (isset($request->combo_id) && is_array($request->combo_id)) {
                    foreach ($request->combo_id as $key => $combo_id) {
                        $order_details = new OrderDetails();
                        $order_details->order_id = $order->id;
                        $order_details->combo_id = $combo_id;
                        $order_details->product_quantity = $request->combo_quantity[$key] ?? 0;
                        $order_details->unit_price = $request->combo_price[$key] ?? 0;
                        $order_details->total_price = $request->combo_total_price[$key] ?? 0;
                        $order_details->save();
                    }
                }


                if ($request->source == "user") {
                    $userDetails = UserDetails::where("user_id", $order->user_id)->latest()->first();
                    if ($userDetails && $userDetails->secondary_email) {
                        Mail::to($userDetails->secondary_email)->send(new OrderConformationMail($order));
                    } else {
                        $user = User::find($order->user_id);
                        if ($user && $user->email) {
                            Mail::to($user->email)->send(new OrderConformationMail($order));
                        }
                    }
                } elseif ($request->source == "user_detail") {
                    $userDetails = UserDetails::where("session_id", $order->session_id)->latest()->first();
                    if ($userDetails && $userDetails->secondary_email) {
                        Mail::to($userDetails->secondary_email)->send(new OrderConformationMail($order));
                    }
                } elseif ($request->source == "guest") {
                    $userDetails = UserDetails::where("customer_id", $order->customer_id)->latest()->first();
                    if ($userDetails && $userDetails->secondary_email) {
                        Mail::to($userDetails->secondary_email)->send(new OrderConformationMail($order));
                    }
                }

                $userDetails = $user_data; // $user_data 
                if ($userDetails && $userDetails->phone_number) {
                    $first_digit = substr($userDetails->phone_number, 0, 1);
                    if ($first_digit === '0') {
                        $phone_number = '+88' . $userDetails->phone_number;
                    } elseif ($first_digit === '1') {
                        $phone_number = '+880' . $userDetails->phone_number;
                    } else {
                        $phone_number = '+880' . $userDetails->phone_number;
                    }

                    // SMS 
                    $trackingUrl = 'https://glowthentic.store/order-progress?orderId=' . $order->invoice_number;
                    $api_key = "0yRu5BkB8tK927YQBA8u";
                    $senderid = "8809617615171";
                    $message = "Your order has been confirmed. Your invoice number is: " . $order->invoice_number . ". Track your order here: " . $trackingUrl;
                    $url = "http://bulksmsbd.net/api/smsapi";
                    $data = [
                        "api_key" => $api_key,
                        "number" => $phone_number,
                        "senderid" => $senderid,
                        "message" => $message
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
                    if ($response['response_code'] != 202) {
                        Log::error('SMS sending failed: ' . json_encode($response));
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
    // custom order end

    public function getComboCustom($id)
    {
        try {
            $combo = Combo::findOrFail($id);
            return response()->json([
                'status' => 200,
                'combo' => $combo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
}