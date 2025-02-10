<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Register API, Login API, Profile API, Logout API

    // POST [name, email, password, role_id]
    public function register(Request $request){

    }
    // POST [email, password]
    public function login(Request $request){

    }
    // POST [Auth: Token]
    public function profile(Request $request){

    }
    // POST [Auth: Token]
    public function logout(Request $request){

    }
}
