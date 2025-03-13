<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class userController extends Controller
{
    public function allUser(){
        $allusers = User::where('role', 'user')->get();
        return view('backend.all-users.all-users',compact('allusers'));
    }
    public function DisableUser($user_id){
        $user_status = User::where('role', 'user')->where('id', $user_id)->latest()->first();
        // dd($user_status);
        $user_status->status = "Inactive";
        $user_status->update();
        return back();
    }
    public function EnableUser($user_id){
        $user_status = User::where('role', 'user')->where('id', $user_id)->latest()->first();
        // dd($completed_Orders);
        $user_status->status = "Active";
        $user_status->update();
        return back();
    }
}
