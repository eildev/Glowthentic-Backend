<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AuthController::class, 'adminLoginPage']);
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->middleware('auth');
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');
