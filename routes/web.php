<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentProviderController;
use App\Http\Controllers\TransaksiController;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// User
Route::resource('users', UserController::class);
// Category

Route::get('categories/trash', [CategoryController::class, 'trash'])
    ->name('categories.trash');

Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
    ->name('categories.restore');

Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
    ->name('categories.forceDelete');
Route::resource('categories', CategoryController::class);

// Menu    
Route::resource('menus', MenuController::class);
Route::resource('members', MemberController::class);
Route::resource('payment-methods', PaymentMethodController::class);
Route::resource('payment-providers', PaymentProviderController::class);
Route::resource('transaksis', TransaksiController::class);


// Payment
Route::get('/payment/payment_methods', function () {
    return view('payment_method.index');
})->name('payment.index');

// // Transaksi
// Route::get('/transaksi', function () {
//     return view('transaksi.index');
// })->name('transaksi.index');

// // Users
// Route::get('/users', function () {
//     return view('users.index');
// })->name('users.index');

// // Pelanggan
// Route::get('/pelanggan', function () {
//     return view('pelanggan.index');
// })->name('pelanggan.index');
