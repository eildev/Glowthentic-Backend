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
use App\Services\BillingInformationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ApiUserManageController extends Controller
{

    protected $billingInformationService;
    public function __construct(BillingInformationService $billingInformationService)
    {
        $this->billingInformationService = $billingInformationService;
    }
    public function UserDetailsStore(Request $request)
    {
        // dd($request->all());
        try {

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
            } else {
                if (!empty($request->user_id)) {
                    $userDetails = UserDetails::where('user_id', $request->user_id)->first();
                    if ($userDetails) {

                        $userDetails->full_name = $request->full_name;
                        $userDetails->phone_number = $request->phone_number;
                        $userDetails->address = $request->address;
                        $userDetails->city = $request->city;

                        if ($request->hasFile('image')) {
                            $file = $request->file('image');
                            $extension = $file->Extension();
                            $filename = time() . '.' . $extension;
                            $path = 'uploads/user_image/';
                            $file->move($path, $filename);
                            $userDetails->image = $path . $filename;
                        }
                        $userDetails->police_station = $request->police_station;
                        $userDetails->postal_code = $request->postal_code;
                        $userDetails->country = $request->country;
                        $userDetails->save();
                    } else {
                        $userDetails = new UserDetails();
                        $userDetails->user_id = $request->user_id;
                        $userDetails->full_name = $request->full_name;
                        $userDetails->phone_number = $request->phone_number;
                        $userDetails->address = $request->address;
                        if ($request->hasFile('image')) {
                            $file = $request->file('image');
                            $extension = $file->Extension();
                            $filename = time() . '.' . $extension;
                            $path = 'uploads/user_image/';
                            $file->move($path, $filename);
                            $userDetails->image = $path . $filename;
                        }
                        $userDetails->police_station = $request->police_station;
                        $userDetails->city = $request->city;
                        $userDetails->postal_code = $request->postal_code;
                        $userDetails->country = $request->country;
                        $userDetails->save();
                    }
                } else {

                    return response()->json([
                        'status' => 401,
                        'message' => 'You must need to login first',
                    ], 401);
                }
            }

            return response()->json([
                'status' => 200,
                'user' => $userDetails,
                'message' => 'User Details Store Successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id, Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
                'secondary_email' => 'nullable|email|max:255',
                'phone_number' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:100',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120', // Updated to 5MB
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors(),
                    'message' => 'Validation Failed',
                ], 422);
            }

            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found',
                ], 404);
            }

            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->save();

            $userDetails = UserDetails::where('user_id', $id)->first();

            if ($userDetails) {
                $userDetails->full_name = $request->full_name;
                $userDetails->secondary_email = $request->secondary_email;
                $userDetails->phone_number = $request->phone_number;
                $userDetails->address = $request->address;
                $userDetails->city = $request->city;
                $userDetails->postal_code = $request->postal_code;
                $userDetails->country = $request->country;

                if ($request->hasFile('image')) {
                    if ($userDetails->image && file_exists(public_path($userDetails->image))) {
                        unlink(public_path($userDetails->image));
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $path = 'uploads/userImage/';
                    $file->move(public_path($path), $filename);
                    $userDetails->image = $path . $filename;
                }
                $userDetails->save();
            } else {
                $userDetails = new UserDetails();
                $userDetails->user_id = $id;
                $userDetails->full_name = $request->full_name;
                $userDetails->secondary_email = $request->secondary_email;
                $userDetails->phone_number = $request->phone_number;
                $userDetails->address = $request->address;
                $userDetails->city = $request->city;
                $userDetails->postal_code = $request->postal_code;
                $userDetails->country = $request->country;

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $path = 'uploads/userImage/';
                    $file->move(public_path($path), $filename);
                    $userDetails->image = $path . $filename;
                }
                $userDetails->save();
            }

            return response()->json([
                'status' => 200,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $userDetails->image ? asset($userDetails->image) : null,
                    'secondary_email' => $userDetails->secondary_email,
                    'phone_number' => $userDetails->phone_number,
                    'address' => $userDetails->address,
                    'city' => $userDetails->city,
                    'postal_code' => $userDetails->postal_code,
                    'country' => $userDetails->country,
                ],
                'message' => 'User Details Updated Successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Update Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating user details',
            ], 500);
        }
    }


    public function userDetailsShow($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found',
                ], 404);
            }

            $userDetails = UserDetails::where('user_id', $id)->first();

            return response()->json([
                'status' => 200,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'userDetails' => $userDetails ? [
                    'full_name' => $userDetails->full_name,
                    'secondary_email' => $userDetails->secondary_email,
                    'phone_number' => $userDetails->phone_number,
                    'address' => $userDetails->address,
                    'city' => $userDetails->city,
                    'postal_code' => $userDetails->postal_code,
                    'country' => $userDetails->country,
                    'image' => $userDetails->image ? asset($userDetails->image) : null,
                ] : null,
                'message' => 'User Details',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching user details',
            ], 500);
        }
    }
    //user info end
    //Billings info Start
    public function UserBillingInfoInsert(Request $request)
    {


        try {
            $billingResponse = $this->billingInformationService->storeBillingInfo($request);
            if ($billingResponse instanceof JsonResponse && $billingResponse->getStatusCode() !== 201) {
                return $billingResponse;
            }
            return response()->json([
                'status' => 200,
                'message' => 'Billing Information Added Successfully',
                'billing_info' => $billingResponse
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function userBillingInfoUpdate(Request $request, $id)
    {
        // try {
        //     // Try to find the user using user_id or session_id

        //     $billing_user = BillingInformation::where('id', $id)->first();

        //     if (!$billing_user) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Billing Information not found'
        //         ], 404);
        //     }

        //     $user = User::where('id', $request->user_id)->first();

        //     if (!$user && $billing_user->session_id != $request->session_id) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'User not found or session mismatch'
        //         ], 404);
        //     }

        //     if (($user && $user->id == $billing_user->user_id) || $billing_user->session_id == $request->session_id) {
        //         if ($request->is_default) {
        //             $billing_user->is_default = $request->is_default;
        //         }

        //         $billing_user->status = $request->status;
        //         $billing_user->active_payment_method = $request->active_payment_method;

        //         if ($request->active_payment_method == 'card') {
        //             $billing_user->card_number = $request->card_number;
        //             $billing_user->cvc_code = $request->cvc_code;
        //             $billing_user->card_expiry_date = $request->card_expiry_date;
        //         } elseif ($request->active_payment_method == 'mobile_banking') {
        //             $billing_user->mobile_banking_id = $request->mobile_banking_id;
        //             $billing_user->verified_mobile = $request->verified_mobile;
        //             $billing_user->verified_mobile_number = $request->verified_mobile_number;
        //         }

        //         $billing_user->save();

        //         return response()->json([
        //             'status' => 200,
        //             'message' => 'Billing Information Updated Successfully',
        //             'billing_info' => $billing_user
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Unauthorized access'
        //         ], 403);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $e->getMessage()
        //     ], 500);
        // }

        try {
            $billingResponse = $this->billingInformationService->userBillingInfoUpdate($request, $id);
            if ($billingResponse instanceof JsonResponse && $billingResponse->getStatusCode() !== 200) {
                return $billingResponse;
            }
            return response()->json([
                'status' => 200,
                'message' => 'Billing Information Updated Successfully',
                'billing_info' => $billingResponse
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function GetUserBillingInfo(Request $request)
    {
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
