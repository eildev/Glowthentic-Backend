<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
class ApiCouponController extends Controller
{
    public function checkCoupon(Request $request){
      
        $coupon = Coupon::whereRaw('LOWER(cupon_code) = ?', [strtolower($request->coupon_code)])
        ->where('type', 'coupon')
        ->where('is_global', 1)
        ->where('status', 'Active')
        ->first();
// dd($coupon);
      if($coupon){
        return response()->json([
            'status'=>200,
            'message'=>'Coupon Applied Successfully',
            'data'=>$coupon
        ]);
      }
      else{
        return response()->json([
            'status'=>401,
           
            'message'=>'Coupon Code Does Not Match',
        ]);
      }
    }
}
