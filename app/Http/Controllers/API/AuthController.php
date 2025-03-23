<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class AuthController extends Controller
{
    // Register API, Login API, Profile API, Logout API

    // POST [name, email, password, role_id]
    public function register(Request $request)
    {
        // dd($request->all());
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                // 'username' => 'required|string|unique:users,username',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                // 'confirm_password' => 'required|confirmed|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => 400,
                    "message" => "Validation errors",
                    "errors" => $validator->errors(),
                ]);
            }

            // Create new user
            $user = User::create([
                'name' => $request->name,
                // 'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Create and return token
            $response = [];
            $response["token"] = $user->createToken("MyApp")->plainTextToken;
            $response["name"] = $user->name;
            $response["email"] = $user->email;
            $response["id"] = $user->id;

            return response()->json([
                "status" => 200,
                "message" => "User registered successfully",
                "data" => $response,
            ]);
        } catch (Exception $e) {
            // Handle unexpected errors
            return response()->json([
                "status" => 500,
                "message" => "Something went wrong, please try again later.",
                "error" => $e->getMessage(),
            ]);
        }
    }
    // POST [email, password]
    // public function login(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         // 'username' => 'required|string|unique:users,username',
    //         // 'name' => 'required|string|max:255',
    //         'email' => 'required|email|string',
    //         'password' => 'required|min:6',
    //         // 'confirm_password' => 'required|confirmed|same:password',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             "status" => 400,
    //             "message" => "Validation errors",
    //             "errors" => $validator->errors(),
    //         ]);
    //     }
    //     $user = User::where("email", $request->email)->first();
    //     if (!empty($user)) {
    //         //User exists
    //         if(Hash::check($request->password, $user->password)){
    //             // Password Matched
    //             $token = $user->createToken("mytoken")->plainTextToken;
    //             return response()->json([
    //                 "status" => 200,
    //                 "message" => "User Loged in successfully",
    //                 "token" => $token,
    //                 "data" => $user,
    //             ]);
    //         }else{
    //             return response()->json([
    //                 "status" => 400,
    //                 "message" => "Password does not match",
    //                 "data" => [],
    //             ]);
    //         }
    //     }else{

    //         return response()->json([
    //             "status" => 400,
    //             "message" => "Email does not match with our records",
    //             "data" => [],
    //         ]);
    //     }

    //     // if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
    //     //     $user = Auth::user();

    //     //     $response = [];
    //     //     // $response["token"] = $user->createToken("MyApp")->plainTextToken;
    //     //     $response["name"] = $user->name;
    //     //     $response["email"] = $user->email;
    //     //     $response["id"] = $user->id;

    //     //     return response()->json([
    //     //         "status" => 200,
    //     //         "message" => "User loged in successfully",
    //     //         "data" => $response,
    //     //     ]);
    //     // }
    //     // return response()->json([
    //     //     "status" => 400,
    //     //     "message" => "Authentication Error",
    //     //     "data" => null,
    //     // ]);
    // }

    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'username' => 'required|string|unique:users,username',
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|string|',
            'password' => 'required|min:6',
            // 'confirm_password' => 'required|confirmed|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                "message" => "Validation errors",
                "errors" => $validator->errors(),
            ]);
        }

        // Sanctum-সহ লগিন চেক করুন
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     $user = Auth::user();
        //     $token = $user->createToken("mytoken")->plainTextToken;
        //     // dd($user);
        //     return response()->json([
        //         "status" => 200,
        //         "message" => "User Logged in successfully",
        //         "token" => $token,
        //         "data" => $user,
        //     ]);
        // }


        // $user = User::where("email", $request->email)->first();
        // if (!empty($user)) {
        //     //User exists
        //     if(Hash::check($request->password, $user->password)){
        //         // Password Matched
        //         $token = $user->createToken("mytoken")->plainTextToken;
        //         return response()->json([
        //             "status" => 200,
        //             "message" => "User Loged in successfully",
        //             "token" => $token,
        //             "data" => [],
        //         ]);
        //     }else{
        //         return response()->json([
        //             "status" => 400,
        //             "message" => "Password does not match",
        //             "data" => [],
        //         ]);
        //     }
        // }else{

        //     return response()->json([
        //         "status" => 400,
        //         "message" => "Email does not match with our records",
        //         "data" => [],
        //     ]);
        // }

        try {
            if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
                $user = Auth::user();

                $response = [];
                $response["token"] = $user->createToken("MyApp")->plainTextToken;
                $response["name"] = $user->name;
                $response["email"] = $user->email;
                $response["id"] = $user->id;

                return response()->json([
                    "status" => 200,
                    "message" => "User loged in successfully",
                    "data" => $response,
                ]);
            } else {
                return response()->json([
                    "status" => 401,
                    "message" => "Invalid credentials",
                    "data" => null,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 400,
                "message" => "Authentication Error",
                "data" => null,
            ]);
        }
    }
    // POST [Auth: Token]
    public function profile()
    {
        // dd("hello");
        $userData = Auth::user();
        $id = Auth::user()->id;
        return response()->json([
            "status" => 200,
            "message" => "Profile Information",
            "data" => $userData,
            "id" => $id,
        ]);
    }
    // POST [Auth: Token]
    public function logout(Request $request)
    {

        if (auth()->check()) {
            $request->user()->tokens()->delete(); // Delete all tokens for the user

            return response()->json([
                "status" => 200,
                "message" => "User logged out successfully",
                "data" => []
            ]);
        }

        return response()->json([
            "status" => 401,
            "message" => "User not authenticated",
        ]);
    }

    // Admin Login (Blade View)
    public function adminLoginPage()
    {
        return view('backend.login');
    }
    public function dashboardView()
    {
        return view('backend.dashboard');
    }

    // public function adminLogin(Request $request)
    // {

    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::guard('web')->attempt($credentials)) {
    //         $user = Auth::user();
    //         if (in_array($user->role, ['admin', 'superadmin'])) {
    //             $request->session()->regenerate(); // Keep this for security
    //             return redirect()->intended('/');
    //         }
    //         Auth::logout();
    //         return back()->withErrors(['email' => 'You do not have admin access.']);
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials.']);
    // }





    public function adminLogin(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    "status" => 422,
                    "message" => "Validation error",
                    "errors" => $validator->errors(),
                    "data" => null,
                ], 422);
            }

            // Attempt login
            if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                if (in_array($user->role, ['admin', 'superadmin'])) {
                    $request->session()->regenerate();
                    return response()->json([
                        "status" => 200,
                        "message" => "Login successful",
                    ]);
                }

                Auth::logout();
                return response()->json([
                    "status" => 403,
                    "message" => "You do not have admin access.",
                    "data" => null,
                ], 403);
            }

            return response()->json([
                "status" => 401,
                "message" => "Invalid credentials.",
                "data" => null,
            ], 401);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "An error occurred: " . $e->getMessage(), // Specific error
                "data" => null,
            ], 500);
        }
    }


    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate(); // Clear session
        $request->session()->regenerateToken(); // New CSRF token
        return redirect('/admin/login');
    }
    // public function adminLogin(Request $request)
    // {
    //     // $credentials = $request->validate([
    //     //     'email' => 'required|email',
    //     //     'password' => 'required',
    //     // ]);

    //     // if (Auth::attempt($credentials)) {
    //     //     return redirect()->route('admin.dashboard');
    //     // }

    //     // return back()->withErrors(['email' => 'Invalid credentials']);

    //     // Validate the request
    //     // dd($request->all());
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Attempt to log in using the 'web' guard
    //     if (Auth::guard('web')->attempt($credentials)) {
    //         $user = Auth::user();

    //         // Check if the user has admin or superadmin role
    //         if (in_array($user->role, ['admin', 'superadmin'])) {
    //             $request->session()->regenerate(); // Regenerate session for security
    //             return redirect()->route('admin.dashboard');
    //         } else {
    //             Auth::logout(); // Log out if not admin
    //             return back()->withErrors(['email' => 'You do not have admin access.']);
    //         }
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials.']);
    // }

    // public function adminLogout(Request $request)
    // {
    //     // Auth::logout();
    //     // return redirect()->route('admin.login');

    //     Auth::guard('web')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/admin/login');
    // }


    // public function user(){

    // }
}
