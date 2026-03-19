<?php

use App\Http\Controllers\API\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --------------- Public Routes (Register and Login) ----------------//
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtp']);

// ------------------ Category Routes ----------------------//
Route::get('/categories', [\App\Http\Controllers\API\CategoryController::class, 'index']);
Route::get('/categories/search', [\App\Http\Controllers\API\CategoryController::class, 'search']);

// ------------------ Protected Routes ----------------------//
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/get-user', [AuthenticationController::class, 'userInfo'])->name('get-user');
    Route::post('/logout', [AuthenticationController::class, 'logOut'])->name('logout');
});
