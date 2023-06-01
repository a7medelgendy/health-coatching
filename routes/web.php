<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'verifyUser']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['role:admin|doctor'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

// Customer routes
Route::prefix('customer')->middleware(['role:customer'])->group(function () {
    Route::get('/customer/profile', [CustomerController::class, 'profile']);
});
