<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SocialLoginController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function googleLogin(){
        $user = Socialite::driver('google')->user();
        $checkUser = User::where('socialId',$user->id)->first();

        if(!$checkUser){
            $newUser = new User;
            $newUser->userName = $user->name;
            $newUser->socialId = $user->id;
            $newUser->email = $user->email;
            $newUser->pic = $user->avatar;
            $newUser->fullName = $user->name;
            $newUser->password = Hash::make($user->email);
            $newUser->save();
            Auth::login($newUser);
            return redirect('/user/dashboard');
        }
        else{
            Auth::login($checkUser);
            return redirect('/user/dashboard');
        }
    }
}
