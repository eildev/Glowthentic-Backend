<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GlobalCoupon;
use Illuminate\Http\Request;

class GlobalCouponController extends Controller
{
   // Global Coupon index function
   public function index()
   {
       return view('backend.global_coupons.insert');
   }

   // Global Coupon store function
   public function store(Request $request)
   {
    $request->validate([
        'coupon_code' => 'required',
        'discount' => 'required',
        'startDate' => 'required|date',
        'expiration' => 'required|date',
    ]);

    $coupon = new GlobalCoupon;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount = $request->discount;
        $coupon->startDate = $request->startDate;
        $coupon->expiration = $request->expiration;
        $coupon->save();
        return back()->with('success', 'Global Coupons Successfully Saved');
   }

   public function applyCoupon($coupon){
        $couponDiscount = GlobalCoupon::where('coupon_code', $coupon)->first();

        if($couponDiscount){
            return response()->json([
                'status' => '200',
                'couponData' => $couponDiscount
            ]);
        } else{
            return response()->json([
                'status' => '500',
                'message' => "coupon dose not match"
            ]);
        }
   }
}