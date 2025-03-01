<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Open Routes
Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->noContent();
// });
// Protected Routes
Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get("/profile", [AuthController::class, "profile"]);
    Route::get("/logout", [AuthController::class, "logout"]);
});
