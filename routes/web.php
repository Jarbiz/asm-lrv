<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
// sent email
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// Admin
use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\OrderController;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/product',[ProductController::class, 'products'])->name('products');
Route::get('/search',[ProductController::class, 'search'])->name('product.search');
Route::get('/product/{category_id}',[ProductController::class, 'products'])->name('productsByCategory');
Route::get('/productdetail/{id}',[ProductController::class, 'detail'])->name('productdetail');
Route::get('/cart',[CartController::class, 'cart'])->name('cart');
Route::post('/product/addCart',[CartController::class, 'addCart'])->name('addCart');
Route::get('/del/cart/{id}',[CartController::class, 'delCart'])->name('delCart');
Route::post('/updateCart',[CartController::class, 'updateCart'])->name('updateCart');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('showCheckout');
Route::post('/checkout',[CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/allcheckout',[CheckoutController::class, 'allCheckout'])->name('allCheckout');
Route::get('/loginForm',[LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/myaccount', [UserController::class, 'updateUser'])->name('updateUser');
Route::get('/myaccount', [MyAccountController::class, 'myAccount'])->name('myaccount');
// Xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Admin
Route::get('/admin',[AdminController::class, 'index'])->name('admin')->middleware('admin');
// Product
Route::get('/productlist',[ProductAdminController::class, 'productlist'])->name('productlist');
Route::post('/product/add',[ProductAdminController::class, 'addProduct'])->name('product.add');
Route::get('/product/del/{id}',[ProductAdminController::class, 'delProduct'])->name('product.del');
Route::get('/product/update/{id}',[ProductAdminController::class, 'updateProductForm'])->name('product.updateForm');
Route::post('/product/update/{id}',[ProductAdminController::class, 'updateProduct'])->name('product.update');

// Categories
Route::get('/categories',[CategoriesController::class, 'categories'])->name('categories');
Route::post('/categories/add', [CategoriesController::class, 'addCategory'])->name('categories.add');
Route::get('/categories/del/{id}', [CategoriesController::class, 'delCategory'])->name('categories.del');
Route::get('/categories/edit/{id}', [CategoriesController::class, 'showEditForm'])->name('categories.edit');
Route::post('/categories/edit/{id}', [CategoriesController::class, 'editCategory'])->name('categories.update');

// Order
Route::get('/order',[OrderController::class, 'order'])->name('order');
Route::get('/order/detail/{id}',[OrderController::class, 'orderDetail'])->name('orderDetail');