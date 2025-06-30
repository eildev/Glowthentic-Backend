<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDetails;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.profile');
    }

    public function update(Request $request)
    {




        $user = User::where('id', Auth::user()->id)->first();
        $user_details = UserDetails::where('user_id', $user->id)->first();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'status' => 401,
                'error' => 'Current password is incorrect'
            ]);
        }



        if (!$user_details) {
            $user_details = new UserDetails();
            $user_details->user_id = $user->id;
            $user_details->full_name = $user->name;
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $image_name);
            $user_details->image ='uploads/user/'.$image_name;
        }


        $user_details->save();


        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Profile updated successfully',
        ]);
    }
}
