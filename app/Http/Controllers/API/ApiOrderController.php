<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Variant;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\OrderDetails;
use App\Models\ComboProduct;
use App\Models\Combo;
use App\Models\Product;
use App\Models\ProductPromotion;
use App\Models\DeliveryOrder;
use App\Models\BillingInformation;
use Auth;
use App\Models\User;
use App\Services\BillingInformationService;
use Illuminate\Http\JsonResponse;
class ApiOrderController extends Controller
{

    protected $billingInformationService;
    public function __construct(BillingInformationService $billingInformationService){
        $this->billingInformationService = $billingInformationService;
    }
    public function store(Request $request)
    {



        try {
            $billingResponse = $this->billingInformationService->storeBillingInfo($request);

            // If billing response is an error, return the error response
            if ($billingResponse instanceof JsonResponse && $billingResponse->getStatusCode() !== 201) {
                return $billingResponse;
            }

            $variant_quantity = 0;
            $variant_price = 0;
            $variant_total_price = 0;
            $total_quantity = 0;
            $total_price = 0;
            $discount_price = 0;

            $error_messages = []; // Array to collect error messages

            // Process products
            foreach ($request->products as $product) {
                $variant = Variant::where('id', $product['variant_id'])->first();

                if ($variant->regular_price == $product['variant_price']) {
                    $variant_quantity += $product['variant_quantity'];
                    $variant_price += $product['variant_price'] * $product['variant_quantity'];

                    $product_promotion = ProductPromotion::where('product_id', $variant->product_id)
                        ->latest()
                        ->first();

                    $discount_amount = 0;
                    if ($product_promotion) {
                        $coupon = Coupon::where('id', $product_promotion->id)
                            ->where('is_global', 0)
                            ->where('end_date', '>=', Carbon::today())
                            ->first();

                        if ($coupon) {
                            if ($coupon->discount_type == 'fixed') {
                                $discount_amount = $coupon->discount_value * $product['variant_quantity'];
                            } else {
                                $discount_amount = ($variant_price * $coupon->discount_value) / 100 * $product['variant_quantity'];
                            }
                        }
                    } elseif (isset($product['cupon_code']) && !empty($product['cupon_code'])) {
                        $coupon = Coupon::where('cupon_code', $product['cupon_code'])
                            ->where('is_global', 0)
                            ->where('type', 'coupon')
                            ->where('end_date', '>=', Carbon::today())
                            ->first();

                        if ($coupon) {
                            if ($coupon->discount_type == 'fixed') {
                                $discount_amount = $coupon->discount_value * $product['variant_quantity'];
                            } else {
                                $discount_amount = ($variant_price * $coupon->discount_value) / 100 * $product['variant_quantity'];
                            }
                        }
                    }
                    $discount_price += $discount_amount;
                    $variant_total_price = $variant_price - $discount_price;
                } else {
                    $error_messages[] = 'Variant Price Does not match for product ' . $product['product_id'];
                }
            }

            // Process combos
            $combo_quantity = 0;
            $combo_price = 0;
            if ($request->combo) {
                foreach ($request->combo as $combo) {
                    $combo_product = ComboProduct::where('combo_id', $combo['combo_id'])->first();
                    $single_combo = Combo::where('id', $combo['combo_id'])->where('status', 'active')->first();

                    if ($single_combo) {
                        $combo_quantity += $combo['combo_quantity'];
                        $combo_price += $single_combo->offerd_price * ($combo['combo_quantity'] ?? 1);
                    } else {
                        $error_messages[] = 'Combo Not Found for combo ' . $combo['combo_id'];
                    }
                }
            }

            $total_price = $variant_total_price + $combo_price;
            $total_quantity = $variant_quantity + $combo_quantity;

            // Create order
            $order = new Order();
            $order->total_amount = $total_price;
            $order->total_quantity = $total_quantity;
            $order->payment_method = $request->payment_method;
            $order->shipping_method = $request->shipping_method;
            $order->shipping_charge = $request->shipping_charge;

            if ($request->payment_method == 'COD') {
                $order->payment_status = 'due';
            } else {
                $order->payment_status = 'paid';
            }
            $order->status = 'pending';
            $order->order_note = $request->order_note;
            $order->invoice_number = rand(100000, 999999);

            if ($request->user_id) {
                $order->user_id = $request->user_id;
            } else if ($request->session_id) {
                $order->session_id = $request->session_id;
            }

            $verified_phone = BillingInformation::where(function ($query) use ($request) {
                $query->where('user_id', $request->user_id)
                    ->orWhere('session_id', $request->session_id);
            })->first();
            if ($verified_phone) {
                $order->phone_number = $verified_phone->phone;
            } else {
                $order->phone_number = $request->phone_number;
            }

            // Coupon Validation
            if ($request->coupon_code) {
                $coupon = Coupon::where('cupon_code', $request->coupon_code)
                    ->where('is_global', 1)
                    ->where('end_date', '>=', Carbon::today())
                    ->first();
                if (!$coupon) {
                    $error_messages[] = 'Invalid Coupon Code: ' . $request->coupon_code;
                    $order->sub_total = $total_price;
                    $order->grand_total = $total_price + $request->shipping_charge;
                } else {
                    $order->global_coupon_id = $coupon->id;
                    if ($coupon->discount_type == 'fixed') {
                        $order->sub_total = $total_price - $coupon->discount_value;
                        $order->grand_total = $total_price + $request->shipping_charge - $coupon->discount_value;
                    } else {
                        $order->sub_total = $total_price - ($total_price * $coupon->discount_value) / 100;
                        $order->grand_total = $total_price + $request->shipping_charge - ($total_price * $coupon->discount_value) / 100;
                    }
                }
            } else {

                $order->sub_total = $total_price;
                $order->grand_total = $total_price + $request->shipping_charge;
            }


            $order->save();

            // Save order details
            if ($order->id) {
                if ($request->products) {
                    foreach ($request->products as $product) {
                        $order_details = new OrderDetails();
                        $order_details->order_id = $order->id;
                        $order_details->product_id = $product['product_id'];
                        $order_details->variant_id = $product['variant_id'];
                        $order_details->product_quantity = $product['variant_quantity'];
                        $order_details->unit_price = $product['variant_price'];
                        $order_details->total_price = $product['variant_price'] * $product['variant_quantity'];
                        $order_details->save();
                    }
                }

                if ($request->combo) {
                    foreach ($request->combo as $combo) {
                        $single_combo = Combo::where('id', $combo['combo_id'])->where('status', 'active')->first();
                        if ($single_combo) {
                            $order_details = new OrderDetails();
                            $order_details->order_id = $order->id;
                            $order_details->combo_id = $combo['combo_id'];
                            $order_details->product_quantity = $combo['combo_quantity'];
                            $order_details->unit_price = $single_combo->offerd_price;
                            $order_details->total_price = $single_combo->offerd_price * ($combo['combo_quantity'] ?? 1);
                            $order_details->save();
                        }
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'order' => $order,
                'order_details' => $order->orderDetails,
                'error_messages' => $error_messages,
                'message' => 'Order Created Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function trackingOrder(Request $request)
    {
        try {
            $order_id = $request->order_id;
            $order = Order::where('invoice_number', $order_id)->with('orderDetails')->first();
            $order_details = OrderDetails::where('order_id', $order->id)->with('product')->get();

            if ($order) {
                if ($order->status != "Delivering") {
                    return response()->json([
                        'status' => 200,
                        'order_tracking_status' => "Ordered",
                        'orderDetails' => $order_details,
                        'message' => 'Order Tracking Successfully',
                    ]);
                } else {
                    $delivered_order = DeliveryOrder::where('order_id', $order->id)->first();

                    if ($delivered_order->delivery_status != "delivered") {
                        return response()->json([
                            'status' => 200,
                            'order_tracking_status' => "Shipped",
                            'orderDetails' => $order_details,
                            'message' => 'Order Delivered Successfully',
                        ]);
                    } else if ($delivered_order->delivery_status == "delivered") {
                        return response()->json([
                            'status' => 200,
                            'order_tracking_status' => "Completed",
                            'orderDetails' => $order_details,
                            'message' => 'Order Delivered Successfully',
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
