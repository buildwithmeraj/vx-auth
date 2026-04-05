<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (){
    return view('auth.login');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginProcess']);

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegistrationForm']);

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registrationProcess']);

Route::get('/register/success', function (){
    return view('auth.success');
});

