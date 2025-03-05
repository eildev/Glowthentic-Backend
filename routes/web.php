<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AuthController::class, 'adminLoginPage']);
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->middleware('auth');
Route::get('/admin/dashboard', [AuthController::class, 'dashboardView'])->middleware('auth')->name('admin.dashboard');
// Route::get('/admin/dashboard', function () {
//     return view('backend.admin.dashboard');
// })->middleware('auth')->name('admin.dashboard');
