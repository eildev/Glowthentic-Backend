<?php

namespace App\Services;

use App\Models\User;
use App\Models\BillingInformation;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BillingInformationService
{
    public function storeBillingInfo($request)
    {
        // Check if the user exists (for logged-in users)
        //    dd($request->all());
        if ($request->user_id) {
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    'status' => 400,
                    'message' => 'User Not Found'
                ], 400);
            }

            $billingInfo = new BillingInformation();
            $billingInfo->user_id = $request->user_id;

            $existingBillingInfo = BillingInformation::where('user_id', $request->user_id)->first();
            $billingInfo->is_default = $existingBillingInfo ? 1 : 0;
        } elseif ($request->session_id) { // Handle guest checkout
            $billingInfo = new BillingInformation();
            $billingInfo->session_id = $request->session_id;

            $existingBillingInfo = BillingInformation::where('session_id', $request->session_id)->first();
            $billingInfo->is_default = $existingBillingInfo ? 1 : 0;
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid request: user_id or session_id required'
            ], 400);
        }

        // Store common details
        $billingInfo->status = $request->status;
        $billingInfo->active_payment_method = $request->payment_method;
      
        // Store payment details based on method
        if ($request->active_payment_method =='card') {
            $billingInfo->card_number = $request->card_number;
            $billingInfo->cvc_code = $request->cvc_code;
            $billingInfo->card_expiry_date = $request->card_expiry_date;
        } elseif ($request->active_payment_method == 'mobile_banking') {
            $billingInfo->mobile_banking_id = $request->mobile_banking_id;
            $billingInfo->verified_mobile = $request->verified_mobile;
            $billingInfo->verified_mobile_number = $request->verified_mobile_number;
        }

        $billingInfo->save();

        return response()->json([
            'status' => 201,
            'message' => 'Billing information stored successfully',
            'data' => $billingInfo
        ], 201);
    }

    public function userBillingInfoUpdate(Request $request, $id)
    {
        try {
            // Find the billing information entry by ID
            $billing_user = BillingInformation::find($id);

            if (!$billing_user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Billing Information not found'
                ], 404);
            }

            // Check if the user exists
            $user = User::find($request->user_id);

            // Validate user or session access
            if (!$user && $billing_user->session_id !== $request->session_id) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found or session mismatch'
                ], 403);
            }

            // Ensure only one default billing address per user
            if ($request->has('is_default') && $request->is_default) {
                BillingInformation::where('user_id', $request->user_id)
                    ->orWhere('session_id', $request->session_id)
                    ->update(['is_default' => 0]); // Reset previous defaults
                $billing_user->is_default = 1;
            }

            // Update fields
            $billing_user->status = $request->status;
            $billing_user->active_payment_method = $request->active_payment_method;

            if ($request->active_payment_method === 'card') {
                $billing_user->card_number = $request->card_number; // Encrypt this
                $billing_user->cvc_code = $request->cvc_code; // Encrypt this
                $billing_user->card_expiry_date = $request->card_expiry_date;
            } elseif ($request->active_payment_method === 'mobile_banking') {
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
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
