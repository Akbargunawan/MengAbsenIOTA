<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

Route::get('/test', function () {
    return response()->json(['success' => true]);
});


// Login mobile (user sudah ada, tidak perlu register)
Route::post('/login', [UserApiController::class, 'login']);

// Route protected, pakai token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserApiController::class, 'profile']);
    Route::post('/logout', [UserApiController::class, 'logout']);
});
