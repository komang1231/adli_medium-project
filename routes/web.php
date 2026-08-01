<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentProviderController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;




Route::get('/', function () {
    return view('auth.login');
});

// Login and Logout Routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});


Route::middleware('auth')->group(function () {
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::middleware('role:Manager,Admin,Staff')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');
        Route::get('/dashboard/daily-chart', [DashboardController::class, 'dailyChart'])
            ->name('dashboard.daily-chart');
        Route::get('/dashboard/yearly-chart', [DashboardController::class, 'yearlyChart'])
            ->name('dashboard.yearly-chart');

        Route::resource('members', MemberController::class);

        // Transaksi
        Route::get('/members/check', [MemberController::class, 'check'])
            ->name('members.check');
        Route::get('transaksis/trash', [TransaksiController::class, 'trash'])
            ->name('transaksis.trash');
        Route::resource('transaksis', TransaksiController::class);

        // Payment
        Route::resource('payment-methods', PaymentMethodController::class);
        Route::resource('payment-providers', PaymentProviderController::class);

        // Profile
        Route::get('/profile', [UserController::class, 'profile'])
            ->name('profile.show');
        Route::put('/profile', [UserController::class, 'updateProfile'])
            ->name('profile.update');
    });


    Route::middleware('role:Manager,Admin')->group(function () {

        // User
        Route::get('users/trash', [UserController::class, 'trash'])
            ->name('users.trash');

        Route::patch('users/{id}/restore', [UserController::class, 'restore'])
            ->name('users.restore');

        Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])
            ->name('users.forceDelete');

        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggleStatus');

        Route::resource('users', UserController::class);

        Route::resource('payment-methods', PaymentMethodController::class);

        Route::resource('payment-providers', PaymentProviderController::class);
    });

    Route::middleware('role:Admin')->group(function () {

        // Category
        Route::get('categories/trash', [CategoryController::class, 'trash'])
            ->name('categories.trash');

        Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
            ->name('categories.restore');

        Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
            ->name('categories.forceDelete');
        Route::resource('categories', CategoryController::class);

        // Menu
        Route::get('menus/trash', [MenuController::class, 'trash'])
            ->name('menus.trash');

        Route::patch('menus/{id}/restore', [MenuController::class, 'restore'])
            ->name('menus.restore');

        Route::delete('menus/{id}/force-delete', [MenuController::class, 'forceDelete'])
            ->name('menus.forceDelete');

        Route::resource('menus', MenuController::class);
        // Route::resource('members', MemberController::class);
        // Route::resource('transaksis', TransaksiController::class);
    });
});
