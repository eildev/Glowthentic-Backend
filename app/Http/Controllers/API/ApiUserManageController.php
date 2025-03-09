<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\BillingInformation;
use Auth;
class ApiUserManageController extends Controller
{

    public function UserDetailsStore(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable|exists:users,id',
                'session_id' => 'nullable|string',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors(),
                    'message' => 'Validation Failed',
                ], 422);
            }


            if (empty($request->user_id) && empty($request->session_id)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'At least one of user_id or session_id must be provided.',
                ], 400);
            }
          else{
            if(!empty($request->user_id)){
                  $userDetails = UserDetails::where('user_id', $request->user_id)->first();
                  if($userDetails){

                    $userDetails->full_name= $request->full_name;
                    $userDetails->phone_number= $request->phone_number;
                    $userDetails->address= $request->address;
                    $userDetails->city= $request->city;
                    $userDetails->postal_code= $request->postal_code;
                    $userDetails->country= $request->country;
                    $userDetails->save();
                  }
                  else{
                    $userDetails = new UserDetails();
                    $userDetails->user_id= $request->user_id;
                    $userDetails->full_name= $request->full_name;
                    $userDetails->phone_number= $request->phone_number;
                    $userDetails->address= $request->address;
                    $userDetails->city= $request->city;
                    $userDetails->postal_code= $request->postal_code;
                    $userDetails->country= $request->country;
                    $userDetails->save();
                  }

            }
            else{
                $userDetails = UserDetails::where('session_id', $request->session_id)->first();
                  if($userDetails){

                    $userDetails->full_name= $request->full_name;
                    $userDetails->phone_number= $request->phone_number;
                    $userDetails->address= $request->address;
                    $userDetails->city= $request->city;
                    $userDetails->postal_code= $request->postal_code;
                    $userDetails->country= $request->country;
                    $userDetails->save();
                  }
                  else{
                    $userDetails = new UserDetails();
                    $userDetails->session_id= $request->session_id;
                    $userDetails->full_name= $request->full_name;
                    $userDetails->phone_number= $request->phone_number;
                    $userDetails->address= $request->address;
                    $userDetails->city= $request->city;
                    $userDetails->postal_code= $request->postal_code;
                    $userDetails->country= $request->country;
                    $userDetails->save();
                  }
            }
          }

            return response()->json([
                'status' => 200,
                'user' => $userDetails,
                'message' => 'User Details Store Successfully'
            ], 200);
        }
       catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id ,Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'phone_number' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'postal_code' => 'required|string',
                'country' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors(),
                    'message' => 'Validation Failed',
                ], 422);
            }
            $userDetails = UserDetails::where('user_id', $id)->first();
            if($userDetails){
              $userDetails->full_name= $request->full_name;
              $userDetails->phone_number= $request->phone_number;
              $userDetails->address= $request->address;
              $userDetails->city= $request->city;
              $userDetails->postal_code= $request->postal_code;
              $userDetails->country= $request->country;
              $userDetails->save();

           }
           return response()->json([
                'status' => 200,
                'user' => $userDetails,
                'message' => 'User Details Updated Successfully'
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }

    }

public function userDetailsShow($id){
    try{
        $userDetails = UserDetails::where('user_id', $id)->first();
        return response()->json([
            'status' => 200,
            'user' => $userDetails,
            'message' => 'User Details'
        ], 200);
    }
    catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
//user info end
//Billings info Start
public function UserBillingInfoInsert(Request $request){
    try{
         if($request->user_id){
            $user= User::where('id', $request->user_id)->first();
            if($user){
             $biilingInfoStore = new BillingInformation();
             $biilingInfoStore->user_id= $request->user_id;
             $userBeforeBillingInfo = BillingInformation::where('user_id', $request->user_id)->first();
             if($userBeforeBillingInfo){

                 $biilingInfoStore->is_default = 1;
             } else {

                 $biilingInfoStore->is_default = 0;
             }
             $biilingInfoStore->status= $request->status;
             $biilingInfoStore->active_payment_method= $request->active_payment_method;
             if($request->active_payment_method == 'card'){
                $biilingInfoStore->card_number= $request->card_number;
                 $biilingInfoStore->cvc_code= $request->cvc_code;
                 $biilingInfoStore->card_expiry_date= $request->card_expiry_date;
             }
             else if($request->active_payment_method == 'mobile_banking'){
                 $biilingInfoStore->mobile_banking_id= $request->mobile_banking_id;
                 $biilingInfoStore->verified_mobile= $request->verified_mobile;
                 $biilingInfoStore->verified_mobile_number= $request->verified_mobile_number;
             }
             $biilingInfoStore->save();
            }

            else{
                return response()->json([
                    'status' => 400,
                    'message' => 'User Not Found'
                ], 400);
            }
         }

         else if($request->session_id){

             $biilingInfoStore = new BillingInformation();
             $biilingInfoStore->session_id= $request->session_id;
             $userBeforeBillingInfo = BillingInformation::where('session_id', $request->session_id)->first();
             if($userBeforeBillingInfo){

                $biilingInfoStore->is_default = 1;
            } else {

                $biilingInfoStore->is_default = 0;
            }
             $biilingInfoStore->status= $request->status;
             $biilingInfoStore->active_payment_method= $request->active_payment_method;
             if($request->active_payment_method == 'card'){
                $biilingInfoStore->card_number= $request->card_number;
                 $biilingInfoStore->cvc_code= $request->cvc_code;
                 $biilingInfoStore->card_expiry_date= $request->card_expiry_date;
             }
             else if($request->active_payment_method == 'mobile_banking'){
                 $biilingInfoStore->mobile_banking_id= $request->mobile_banking_id;
                 $biilingInfoStore->verified_mobile= $request->verified_mobile;
                 $biilingInfoStore->verified_mobile_number= $request->verified_mobile_number;
             }
             $biilingInfoStore->save();


         }
         return response()->json([
             'status' => 200,
             'message' => 'Billing Information Added Successfully',
             'billing_info' => $biilingInfoStore
         ], 200);
    }
    catch(\Exception $e){
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function userBillingInfoUpdate(Request $request,$id){
    try{

    }
   catch(\Exception $e){
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }



}

}
