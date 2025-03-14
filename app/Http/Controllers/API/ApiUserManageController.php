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

                    if($request->hasFile('image')){
                        $file= $request->file('image');
                        $extension = $file->Extension();
                        $filename = time().'.'.$extension;
                        $path='uploads/user_image/';
                        $file->move($path,$filename);
                        $userDetails->image= $path.$filename;
                    }
                    $userDetails->police_station= $request->police_station;
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
                    if($request->hasFile('image')){
                        $file= $request->file('image');
                        $extension = $file->Extension();
                        $filename = time().'.'.$extension;
                        $path='uploads/user_image/';
                        $file->move($path,$filename);
                        $userDetails->image= $path.$filename;
                    }
                    $userDetails->police_station= $request->police_station;
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
                    if($request->hasFile('image')){
                        $file= $request->file('image');
                        $extension = $file->Extension();
                        $filename = time().'.'.$extension;
                        $path='uploads/user_image/';
                        $file->move($path,$filename);
                        $userDetails->image= $path.$filename;
                    }
                    $userDetails->police_station= $request->police_station;
                    $userDetails->city= $request->city;
                    $userDetails->postal_code= $request->postal_code;
                    $userDetails->country= $request->country;
                    $userDetails->save();
                  }
                  else{
                    $userDetails = new UserDetails();
                    $userDetails->session_id= $request->session_id;
                    if($request->hasFile('image')){
                        $file= $request->file('image');
                        $extension = $file->Extension();
                        $filename = time().'.'.$extension;
                        $path='uploads/user_image/';
                        $file->move($path,$filename);
                        $userDetails->image= $path.$filename;
                    }
                    $userDetails->police_station= $request->police_station;
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
              if($request->hasFile('image')){
                if ($userDetails->image && file_exists($userDetails->image)) {
                    unlink($userDetails->image);
                }
                $file= $request->file('image');
                $extension = $file->Extension();
                $filename = time().'.'.$extension;
                $path='uploads/user_image/';
                $file->move($path,$filename);
                $userDetails->image= $path.$filename;
            }
            $userDetails->police_station= $request->police_station;
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
        $user= User::where('id', $id)->first();
        $userDetails = UserDetails::Where('session_id', $id)->orWhere('user_id', $user->id)->with('user')
        ->first();

        return response()->json([
            'status' => 200,
            'user'=> $user,
            'userDetails' => $userDetails,
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

public function userBillingInfoUpdate(Request $request, $id)
{
    try {
        // Try to find the user using user_id or session_id

        $billing_user = BillingInformation::where('id', $id)->first();

        if (!$billing_user) {
            return response()->json([
                'status' => false,
                'message' => 'Billing Information not found'
            ], 404);
        }

        $user = User::where('id', $request->user_id)->first();

        if (!$user && $billing_user->session_id != $request->session_id) {
            return response()->json([
                'status' => false,
                'message' => 'User not found or session mismatch'
            ], 404);
        }

        if (($user && $user->id == $billing_user->user_id) || $billing_user->session_id == $request->session_id) {
            if ($request->is_default) {
                $billing_user->is_default = $request->is_default;
            }

            $billing_user->status = $request->status;
            $billing_user->active_payment_method = $request->active_payment_method;

            if ($request->active_payment_method == 'card') {
                $billing_user->card_number = $request->card_number;
                $billing_user->cvc_code = $request->cvc_code;
                $billing_user->card_expiry_date = $request->card_expiry_date;
            } elseif ($request->active_payment_method == 'mobile_banking') {
                $billing_user->mobile_banking_id = $request->mobile_banking_id;
                $billing_user->verified_mobile = $request->verified_mobile;
                $billing_user->verified_mobile_number = $request->verified_mobile_number;
            }

            $billing_user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Billing Information Updated Successfully',
                'billing_info' => $billing_user
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function GetUserBillingInfo(Request $request){
    try {
        $query = BillingInformation::query();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('session_id')) {
            $query->orWhere('session_id', $request->session_id);
        }


        if (!$request->filled('user_id') && !$request->filled('session_id')) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid request: user_id or session_id is required'
            ], 400);
        }

        $billing_info = $query->get();

        return response()->json([
            'status' => 200,
            'message' => 'Billing Information Fetched Successfully',
            'billing_info' => $billing_info
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


}
