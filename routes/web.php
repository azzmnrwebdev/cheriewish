<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\ResetPassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimonyController;
use App\Http\Controllers\Auth\ForgotPassController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('shop/{slug}', [ShopController::class, 'show'])->name('shop.show');
Route::get('about', [AboutController::class, 'index'])->name('about');

// AUTH
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('loginAct', [LoginController::class, 'loginAct'])->name('loginAct');
    Route::get('reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reload_captcha');
    Route::get('forgot-password', [ForgotPassController::class, 'forgot'])->name('forgot_pass');
    Route::get('reset-password/{token}', [ResetPassController::class, 'reset'])->name('reset_pass');
});

// DASHBOARD
Route::middleware('auth')->group(function () {
    // LOGOUT
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // CATEGORY
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/', [CategoryController::class, 'store'])->name('category.store');
            Route::get('{category}', [CategoryController::class, 'show'])->name('category.show');
            Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        });

        // PRODUCT
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/', [ProductController::class, 'store'])->name('product.store');
            Route::get('{product}', [ProductController::class, 'show'])->name('product.show');
            Route::get('{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('{product}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        });

        // TESTIMONIALS
        Route::prefix('testimony')->group(function () {
            Route::get('/', [TestimonyController::class, 'index'])->name('testimony.index');
            Route::post('/', [TestimonyController::class, 'store'])->name('testimony.store');
            Route::get('{testimony}', [TestimonyController::class, 'show'])->name('testimony.show');
            Route::get('{testimony}/edit', [TestimonyController::class, 'edit'])->name('testimony.edit');
            Route::put('{testimony}', [TestimonyController::class, 'update'])->name('testimony.update');
            Route::delete('{testimony}', [TestimonyController::class, 'destroy'])->name('testimony.destroy');
        });

        // COMPANY
        Route::prefix('company')->group(function () {
            Route::get('/', [CompanyController::class, 'index'])->name('company.index');
            Route::get('form', [CompanyController::class, 'form'])->name('company.form');
            Route::post('/', [CompanyController::class, 'store'])->name('company.store');
        });
    });
});
