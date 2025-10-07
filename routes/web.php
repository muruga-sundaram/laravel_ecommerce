<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;

// Frontend
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('product/{id}', [HomeController::class,'show'])->name('product.show');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Cart & Wishlist
Route::middleware('auth')->group(function(){
    Route::resource('cart', CartController::class)->only(['index','store','update','destroy']);
    Route::resource('wishlist', WishlistController::class)->only(['index','store','destroy']);
    Route::resource('checkout', CheckoutController::class)->only(['index','store']);
});

// Admin routes
Route::prefix('admin')->middleware('auth','is_admin')->group(function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::resource('categories',CategoryController::class,['as'=>'admin']);
    Route::resource('products',ProductController::class,['as'=>'admin']);
    Route::get('orders',[OrderController::class,'index'])->name('admin.orders.index');
    Route::post('orders/{order}/status',[OrderController::class,'updateStatus'])->name('admin.orders.status');
});

Route::middleware('auth')->group(function(){
    Route::get('user/orders',[UserDashboardController::class,'orders'])->name('user.orders');
    Route::get('user/wishlist',[UserDashboardController::class,'wishlist'])->name('user.wishlist');
    Route::get('user/addresses',[UserDashboardController::class,'addresses'])->name('user.addresses');
    Route::post('user/addresses/add',[UserDashboardController::class,'addAddress'])->name('user.address.add');
    Route::put('user/addresses/{address}/edit',[UserDashboardController::class,'editAddress'])->name('user.address.edit');
    Route::delete('user/addresses/{address}/delete',[UserDashboardController::class,'deleteAddress'])->name('user.address.delete');
});
