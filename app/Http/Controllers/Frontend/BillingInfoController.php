<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use Illuminate\Http\Request;
use Validator;


class BillingInfoController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'division' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            'order_notes' => 'required',
        ]);

        if ($validator->passes()) {
            $billing = BillingInfo::updateOrCreate([
                'user_id' => $request->user_id ?? 0
            ], [
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'division' => $request->division,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'order_notes' => $request->order_notes,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Add Billing Address Successfully',
                'billing' => $billing
            ]);
        }
        return response()->json([
            'status' => '500',
            'error' => $validator->messages()
        ]);
    }



}
