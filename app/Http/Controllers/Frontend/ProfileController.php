<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
        // User Profile Update Function
        public function UpdateProfile(Request $request)
        {
            // @dd($request->all());

            $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'fullname' => 'required|max:100',
                'email' => 'required|max:100',
                'phone' => 'required|max:100',
                'present_address' => 'required|max:255',
                'permanent_address' => 'required|max:255',
            ]);

            $user_id = Auth::user()->id;
            // @dd($user_id);

            $user = User::findOrFail($user_id);
            // @dd($user);
            $user->userName = $request->username;
            $user->fullName = $request->fullname;
            $user->phone = $request->phone;
            $user->present_address = $request->present_address;
            $user->permanent_address = $request->permanent_address;
            $user->update();
            return redirect()->route('user.dashboard')->with('success', 'Information Successfully Updated');


        }
}
