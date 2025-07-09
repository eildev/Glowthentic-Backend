<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
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
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
            // dd($socialUser);
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
            UserDetails::firstOrCreate(
                ['secondary_email' => $socialUser->getEmail()],
                [
                    'user_id' => $user->id,
                    'full_name' => $socialUser->getName(),
                    'image'  => $socialUser->getAvatar()
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            // ফ্রন্টএন্ডে রিডাইরেক্ট URL
            $redirectUrl = "https://glowthentic.store/auth/callback?access_token={$token}&user=" . urlencode(json_encode($user));
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            $redirectUrl = "https://glowthentic.store/auth/callback?error=" . urlencode('Google login failed: ' . $e->getMessage());
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
                    'google_id' => $socialUser->getId(),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'user',
                    'status' => 'active',
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            // ফ্রন্টএন্ডে রিডাইরেক্ট URL
            $redirectUrl = "https://glowthentic.store/auth/callback?access_token={$token}&user=" . urlencode(json_encode($user));
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            $redirectUrl = "https://glowthentic.store/auth/callback?error=" . urlencode('Google login failed: ' . $e->getMessage());
            return redirect($redirectUrl);
        }
    }
}