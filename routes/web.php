<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\UserAccessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:dashboard.view')
        ->name('dashboard');

    // logout route
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');


    // profile routes
    Route::get('/dashboard/profile', [ProfileController::class, 'show'])
    ->middleware('permission:dashboard.view')
    ->name('dashboard.profile.show');

    Route::get('/dashboard/profile/edit', [ProfileController::class, 'edit'])
    ->middleware('permission:dashboard.view')
    ->name('dashboard.profile.edit');

    Route::put('/dashboard/profile', [ProfileController::class, 'update'])
        ->middleware('permission:dashboard.view')
        ->name('dashboard.profile.update');


    // dashboard management routes

    // role management routes
    Route::prefix('dashboard/roles')->name('dashboard.roles.')->group(function () {
    Route::get('/', [RoleManagementController::class, 'index'])
        ->middleware('permission:roles.view')
        ->name('index');

    // role creation, update, and deletion routes
    Route::post('/', [RoleManagementController::class, 'store'])
        ->middleware('permission:roles.manage')
        ->name('store');

    Route::put('/{role}', [RoleManagementController::class, 'update'])
        ->middleware('permission:roles.manage')
        ->name('update');

    Route::delete('/{role}', [RoleManagementController::class, 'destroy'])
        ->middleware('permission:roles.manage')
        ->name('destroy');
    });

    // permission management routes
    Route::prefix('dashboard/permissions')->name('dashboard.permissions.')->group(function () {
        Route::get('/', [PermissionManagementController::class, 'index'])
            ->middleware('permission:permissions.view')
            ->name('index');

        Route::post('/', [PermissionManagementController::class, 'store'])
            ->middleware('permission:permissions.manage')
            ->name('store');

        Route::put('/{permission}', [PermissionManagementController::class, 'update'])
            ->middleware('permission:permissions.manage')
            ->name('update');

        Route::delete('/{permission}', [PermissionManagementController::class, 'destroy'])
            ->middleware('permission:permissions.manage')
            ->name('destroy');
    });

    // user access management routes
    Route::prefix('dashboard/users')->name('dashboard.users.')->group(function () {
        Route::get('/', [UserAccessController::class, 'index'])
            ->middleware('permission:users.view')
            ->name('index');

        Route::put('/{user}/roles', [UserAccessController::class, 'updateRoles'])
            ->middleware('permission:assignments.manage')
            ->name('roles.update');

        Route::put('/{user}/permissions', [UserAccessController::class, 'updatePermissions'])
            ->middleware('permission:assignments.manage')
            ->name('permissions.update');
    });
});

// no middleware routes
Route::get('/', function (){
    return view('welcome');
})    ->name('home');
Route::get('/reset-password', function () {
    return view('auth.password-reset');
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset.submit');
