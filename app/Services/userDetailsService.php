<?php

namespace App\Services;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserDetailsService
{

    public function storeUserDetails(Request $request){
        try{

           if($request->user_id){

            $user = User::find($request->user_id);
            if(!$user){
                return response()->json([
                    'status' => 400,
                    'message' => 'User Not Found'
                ], 400);
            }
              $userDetailsFind = UserDetails::where('user_id',$request->user_id)->first();
              if($userDetailsFind){
                $userDetails = $userDetailsFind;
              }else{
                $userDetails = new UserDetails();
              }
              $userDetails->user_id = $request->user_id;
              $userDetails->full_name = $request->full_name;
              $userDetails->phone_number = $request->phone_number;
              $userDetails->address = $request->address;
              $userDetails->city = $request->district;
              $userDetails->postal_code = $request->postal_code;
              $userDetails->police_station = $request->police_station;
              $userDetails->country = $request->country??'';
              $userDetails->save();
              return response()->json([
                'status' => 201,
                'message' => 'userDetails information stored successfully',
                'data' => $userDetails
            ], 201);


           }
           elseif($request->session_id){


              $userDetailsFind = UserDetails::where('session_id',$request->session_id)->first();
              if($userDetailsFind){
                $userDetails = $userDetailsFind;
              }else{
                $userDetails = new UserDetails();
              }
              $userDetails->session_id =$request->session_id;
              $userDetails->full_name = $request->full_name;
              $userDetails->phone_number = $request->phone_number;
              $userDetails->address = $request->address;
              $userDetails->city = $request->district;
              $userDetails->postal_code = $request->postal_code;
              $userDetails->police_station = $request->police_station;
              $userDetails->country = $request->country??'';
            //   $userDetails->country =
            $userDetails->save();
            return response()->json([
                'status' => 201,
                'message' => 'userDetails information stored successfully',
                'data' => $userDetails
            ], 201);
        }
    }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
