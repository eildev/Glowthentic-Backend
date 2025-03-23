<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Validator;
class CouponController extends Controller
{
  public function index(){
        return view('backend.coupon.index');
    }

    public function store(Request $request){

        try {

            $validator = Validator::make($request->all(), [

                'is_global' => 'required|boolean',
                'start_date' => 'required',
                'promotion_name'=>'required',
                'end_date' => 'required|date|after_or_equal:today',
                'discount_type' => 'required',
                'discount_value' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }


            $coupon = new Coupon();
            $coupon->promotion_name = $request->promotion_name;
            $coupon->cupon_code = $request->coupon_code;
            // dd($coupon->cupon_code);
            $coupon->discount_type = $request->discount_type;
            $coupon->discount_value = $request->discount_value;
            $coupon->type = $request->type;

            $coupon->is_global = $request->is_global;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->save();

            return response()->json([
                'status'=>200,
                'message'=>'Data Saved Successfully'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }

    public function view(){
        try{
        $coupon = Coupon::all();
        return response()->json([
            'status'=>200,
            'coupon'=>$coupon
        ]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function edit($id){
        try{
        $coupon = Coupon::find($id);
        // dd($coupon);
        return response()->json([
            'status'=>200,
            'coupon'=>$coupon
        ]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request){
        // dd($request->all());
        try {

            $validator = Validator::make($request->all(), [

                'is_global' => 'required|boolean',
                'promotion_name'=>'required',
                'start_date' => 'required',
                'end_date' => 'required|date|after_or_equal:today',
                'discount_type' => 'required',
                'discount_value' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }


            $coupon =Coupon::find($request->coupon_id);
            $coupon->promotion_name = $request->promotion_name;
            $coupon->cupon_code = $request->coupon_code;
            // dd($coupon->cupon_code);
            $coupon->discount_type = $request->discount_type;
            $coupon->discount_value = $request->discount_value;
            $coupon->type = $request->type;
            $coupon->is_global = $request->is_global;
            $coupon->start_date = $request->start_date;
            $coupon->status = $request->status;
            $coupon->end_date = $request->end_date;
            $coupon->save();

            return response()->json([
                'status'=>200,
                'message'=>'Data Saved Successfully'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function delete(Request $request){

        try{
        $coupon = Coupon::find($request->id);

        $coupon->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Data Deleted Successfully'
        ]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
