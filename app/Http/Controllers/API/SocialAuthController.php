<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    // public function handleGoogleCallback()
    // {
    //     try {
    //         $socialUser = Socialite::driver('google')->stateless()->user();
    //         $user = User::firstOrCreate(
    //             ['email' => $socialUser->getEmail()],
    //             [
    //                 'name' => $socialUser->getName(),
    //                 'password' => null,
    //                 'google_id' => $socialUser->getId(),
    //                 'email_verified_at' => Carbon::now(),
    //                 'role' => 'user',
    //                 'status' => 'active',
    //             ]
    //         );

    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //             'user' => $user,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Google login failed: ' . $e->getMessage()], 500);
    //     }
    // }
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'password' => null,
                    'google_id' => $socialUser->getId(),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'user',
                    'status' => 'active',
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            // ফ্রন্টএন্ডে রিডাইরেক্ট URL
            $redirectUrl = "http://127.0.0.1:5173/auth/callback?access_token={$token}&user=" . urlencode(json_encode($user));
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            $redirectUrl = "http://127.0.0.1:5173/auth/callback?error=" . urlencode('Google login failed: ' . $e->getMessage());
            return redirect($redirectUrl);
        }
    }

    // Facebook লগইন
    public function redirectToFacebook()
    {
        return response()->json([
            'url' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function handleFacebookCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->stateless()->user();
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'password' => null,
                    'facebook_id' => $socialUser->getId(),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'user',
                    'status' => 'active',
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Facebook login failed: ' . $e->getMessage()], 500);
        }
    }
}
