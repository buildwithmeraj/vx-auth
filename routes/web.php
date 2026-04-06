<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// guest routes
Route::middleware('guest')->group(function () {
    // login routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'loginProcess']);

    // forgot password routes
    Route::get('/forgot-password', function ()
    {
        return view('auth.forgot-password');
    });
    Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProcess'])->name('password.email');

    // registration routes
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'registrationProcess']);
    Route::get('/register/success', function () {
        return view('auth.success');
    })->name('register.success');
});

// auth required routes
Route::middleware('auth')->group(function () {
    // dashboard route
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'allUsers'])->name('dashboard');

    // logout route
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});

// no middleware routes
Route::get('/reset-password', function () {
    return view('auth.passsword-reset');
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset.submit');
