<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;

Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'productsDetails'])->name('product.details');
Route::get('/cart/wishlist/count',[ShopController::class, 'getCartWishlistCount'])->name('cart.wishlist.count');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class, 'updateCartProduct'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

Route::post('/wishlist/store', [WishlistController::class, 'addProductToWishlist'])->name('wishlist.store');


Auth::routes();


Route::middleware('auth')->group(function(){
  Route::get('/user-account', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', 'auth.admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
