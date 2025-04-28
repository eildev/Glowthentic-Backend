<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OTPData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Generate 6-digit OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in o_t_p_data table
        OTPData::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expire_at' => Carbon::now()->addSeconds(120), // 120 seconds expiry
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Send OTP via email
        Mail::raw("Your OTP for password reset is: $otp. It will expire in 120 seconds.", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password Reset OTP');
        });

        return response()->json([
            'status' => 200,
            'message' => 'OTP sent to your email.',
        ]);
    }

    public function verifyOTP(Request $request)
    {
        // Validate email and OTP input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Find OTP data for the email
        $otpData = OTPData::where('email', $request->email)->first();

        if (!$otpData) {
            return response()->json([
                'status' => 400,
                'message' => 'No OTP found for this email.',
            ], 400);
        }

        // Check if OTP has expired
        if (Carbon::now()->greaterThan($otpData->expire_at)) {
            return response()->json([
                'status' => 400,
                'message' => 'OTP has expired.',
            ], 400);
        }

        // Verify OTP
        if ($otpData->otp !== $request->otp) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        // Generate a reset token
        $token = Str::random(60);

        // Store the token in the password_reset_tokens table
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token), // Hash the token
                'created_at' => Carbon::now(),
            ]
        );

        // Delete the OTP after successful verification
        $otpData->delete();

        return response()->json([
            'status' => 200,
            'message' => 'OTP verified successfully.',
            'token' => $token, // Return the unhashed token to the frontend
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json([
                'status' => 200,
                'message' => 'Password has been reset successfully.',
            ])
            : response()->json([
                'status' => 400,
                'message' => 'Invalid token or email.',
            ], 400);
    }
    // // Send password reset link
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Validation error',
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     }

    //     // Send reset link
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? response()->json([
    //             'status' => 200,
    //             'message' => 'Password reset link sent to your email.',
    //         ])
    //         : response()->json([
    //             'status' => 400,
    //             'message' => 'Unable to send reset link.',
    //         ], 400);
    // }

    // // Reset password
    // public function reset(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|min:8|confirmed',
    //         'token' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Validation error',
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     }

    //     // Attempt to reset password
    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password),
    //                 'remember_token' => Str::random(60),
    //             ])->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     return $status === Password::PASSWORD_RESET
    //         ? response()->json([
    //             'status' => 200,
    //             'message' => 'Password has been reset successfully.',
    //         ])
    //         : response()->json([
    //             'status' => 400,
    //             'message' => 'Invalid token or email.',
    //         ], 400);
    // }
}
