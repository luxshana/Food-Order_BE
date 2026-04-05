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
Route::post('/categories', [\App\Http\Controllers\API\CategoryController::class, 'store']);
Route::put('/categories/{category}', [\App\Http\Controllers\API\CategoryController::class, 'update']);
Route::delete('/categories/{category}', [\App\Http\Controllers\API\CategoryController::class, 'destroy']);
Route::get('/categories/search', [\App\Http\Controllers\API\CategoryController::class, 'search']);
Route::get('/categories/{category}/products', [\App\Http\Controllers\API\ProductController::class, 'getByCategory']);

// ------------------ Product Routes ----------------------//
Route::get('/products', [\App\Http\Controllers\API\ProductController::class, 'index']);
Route::post('/products', [\App\Http\Controllers\API\ProductController::class, 'store']);
Route::put('/products/{product}', [\App\Http\Controllers\API\ProductController::class, 'update']);
Route::delete('/products/{product}', [\App\Http\Controllers\API\ProductController::class, 'destroy']);
Route::get('/categories-with-products', [\App\Http\Controllers\API\ProductController::class, 'allCategoriesWithProducts']);
Route::get('/get-user', [AuthenticationController::class, 'userInfo'])->name('get-user');
 Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
 Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show']);
 Route::put('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
 Route::get('/dashboard', [\App\Http\Controllers\API\DashboardController::class, 'index']);

// ------------------ Protected Routes ----------------------//
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthenticationController::class, 'logOut'])->name('logout');

    // ------------------ Order Routes -------------------------//
   
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store']);
    Route::get('/users/{user}/orders', [\App\Http\Controllers\OrderController::class, 'userOrders']);
});
