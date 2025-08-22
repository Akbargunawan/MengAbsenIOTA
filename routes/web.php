<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;


// Halaman login
Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Halaman Forgot Password
Route::get('/forgot-password', function () {
    return view('ForgotPassword');
})->name('password.request');

// Klik kirim di forgot password → ke halaman New Password
Route::get('/new-password', function () {
    return view('NewPassword');
})->name('new-password');

// Klik simpan di new password → balik ke login
Route::get('/save-password', function () {
    return redirect()->route('login');
})->name('save-password');

// Halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/user-management', function () {
    return view('user-management');
})->name('user.management');

Route::get('/user', [UserController::class, 'index'])->name('user.index');

// routes/web.php
Route::resource('users', UserController::class);


// Jika ingin route khusus buat create user
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/master', function () {
    return view('master', ['title' => 'Master']);
})->name('master');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
