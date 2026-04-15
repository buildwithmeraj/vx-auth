<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])
        ->middleware('permission:dashboard.view')
        ->name('home');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
        ->middleware('permission:dashboard.view')
        ->name('dashboard');

    // logout route
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');


    Route::prefix('dashboard/roles')->name('dashboard.roles.')->group(function () {
    Route::get('/', [\App\Http\Controllers\RoleManagementController::class, 'index'])
        ->middleware('permission:roles.view')
        ->name('index');

    Route::post('/', [\App\Http\Controllers\RoleManagementController::class, 'store'])
        ->middleware('permission:roles.manage')
        ->name('store');

    Route::put('/{role}', [\App\Http\Controllers\RoleManagementController::class, 'update'])
        ->middleware('permission:roles.manage')
        ->name('update');

    Route::delete('/{role}', [\App\Http\Controllers\RoleManagementController::class, 'destroy'])
        ->middleware('permission:roles.manage')
        ->name('destroy');
});


Route::prefix('dashboard/permissions')->name('dashboard.permissions.')->group(function () {
    Route::get('/', [\App\Http\Controllers\PermissionManagementController::class, 'index'])
        ->middleware('permission:permissions.view')
        ->name('index');

    Route::post('/', [\App\Http\Controllers\PermissionManagementController::class, 'store'])
        ->middleware('permission:permissions.manage')
        ->name('store');

    Route::put('/{permission}', [\App\Http\Controllers\PermissionManagementController::class, 'update'])
        ->middleware('permission:permissions.manage')
        ->name('update');

    Route::delete('/{permission}', [\App\Http\Controllers\PermissionManagementController::class, 'destroy'])
        ->middleware('permission:permissions.manage')
        ->name('destroy');

        
});

Route::prefix('dashboard/users')->name('dashboard.users.')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserAccessController::class, 'index'])
        ->middleware('permission:users.view')
        ->name('index');

    Route::put('/{user}/roles', [\App\Http\Controllers\UserAccessController::class, 'updateRoles'])
        ->middleware('permission:assignments.manage')
        ->name('roles.update');

    Route::put('/{user}/permissions', [\App\Http\Controllers\UserAccessController::class, 'updatePermissions'])
        ->middleware('permission:assignments.manage')
        ->name('permissions.update');
});

});

// no middleware routes
Route::get('/reset-password', function () {
    return view('auth.passsword-reset');
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset.submit');
