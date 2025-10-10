<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController as UserOrderController;

/*
|--------------------------------------------------------------------------
| Public / User Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Product browsing
Route::get('products', [HomeController::class, 'products'])->name('products.index');
Route::get('products/{id}', [HomeController::class, 'showProduct'])->name('products.show');

// Cart
Route::prefix('cart')->middleware('auth')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Wishlist
Route::prefix('wishlist')->middleware('auth')->group(function() {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// User Orders
Route::prefix('orders')->middleware('auth')->group(function() {
    Route::get('/', [UserOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('{id}', [UserOrderController::class, 'show'])->name('admin.orders.show');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/')->name('admin.')->middleware('auth')->group(function() {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Products
    Route::get('admin/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('admin/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('admin/products', [ProductsController::class, 'store'])->name('products.store');
    Route::get('admin/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('admin/products/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('admin/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});
