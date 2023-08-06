<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DashboardAccountController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WishlistController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\DashboardTransactionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [ControllersCategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [ControllersCategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('detail-add'); //add to cart
// Route::post('/whislist/{id}', [DetailController::class, 'addfav'])->name('detail-fav'); //add to wishlist

Route::get('/success', [CartController::class, 'success'])->name('success');

Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart-update');

    // Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    // Route::post('/wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist-cart');
    // Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist-delete');

    Route::get('/dashboard', [ControllersDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::get('/dashboard/accounts', [DashboardAccountController::class, 'index'])->name('dashboard-account');
});


// ->middleware(['auth', 'admin'])
// ->namespace('Admin')
Route::prefix('admin')->middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('gallery', ProductGalleryController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('account', UserController::class);
});

Auth::routes();
