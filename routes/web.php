<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('shop.home');
Route::get('/san-pham/{product}', [HomeController::class, 'showProduct'])->name('shop.products.show');

Route::controller(CartController::class)
    ->name('carts.')
    ->prefix('/carts')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/addToCart/{productVariant}', 'addToCart')->name('addToCart');
        Route::post('/updateCart', 'updateCart')->name('updateCart');
        Route::get('/removeOneProduct/{productVariant}', 'removeOneProduct')->name('removeOneProduct');
        Route::get('/deleteCart', 'deleteCart')->name('deleteCart');
        Route::get('/plus/{productVariant}', 'plus')->name('plus');
        Route::get('/minus/{productVariant}', 'minus')->name('minus');
    });

Route::get('/login', [StaffController::class, 'login'])->name('staffs.login');
Route::post('/login', [StaffController::class, 'loginProcess'])->name('staffs.loginProcess');
Route::post('/logout', [StaffController::class, 'logout'])->name('staffs.logout');

Route::get('/customers/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customers/register', [CustomerAuthController::class, 'register']);
Route::get('/customers/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customers/login', [CustomerAuthController::class, 'login']);
Route::post('/customers/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('orders.placeOrder');
Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');
Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::middleware('authStaff')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
        Route::put('/orders/{order}/status', [OrderController::class, 'adminUpdateStatus'])->name('admin.orders.updateStatus');
    });

    Route::controller(BrandController::class)
        ->name('brands.')
        ->prefix('/brands')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{brand}/edit', 'edit')->name('edit');
            Route::put('/{brand}/edit', 'update')->name('update');
            Route::delete('/{brand}', 'destroy')->name('destroy');
        });

    Route::controller(ProductTypeController::class)
        ->name('productTypes.')
        ->prefix('/productTypes')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{productType}/edit', 'edit')->name('edit');
            Route::put('/{productType}/edit', 'update')->name('update');
            Route::delete('/{productType}', 'destroy')->name('destroy');
        });

    Route::controller(PaymentController::class)
        ->name('payments.')
        ->prefix('/payments')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{payment}/edit', 'edit')->name('edit');
            Route::put('/{payment}/edit', 'update')->name('update');
            Route::delete('/{payment}', 'destroy')->name('destroy');
        });

    Route::controller(StatusController::class)
        ->name('statuses.')
        ->prefix('/statuses')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{status}/edit', 'edit')->name('edit');
            Route::put('/{status}/edit', 'update')->name('update');
            Route::delete('/{status}', 'destroy')->name('destroy');
        });

    Route::controller(ConfigurationController::class)
        ->name('configurations.')
        ->prefix('/configurations')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{configuration}/edit', 'edit')->name('edit');
            Route::put('/{configuration}/edit', 'update')->name('update');
            Route::delete('/{configuration}', 'destroy')->name('destroy');
        });

    Route::controller(ProductController::class)
        ->name('products.')
        ->prefix('/products')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{product}', 'show')->name('show');
            Route::get('/{product}/edit', 'edit')->name('edit');
            Route::put('/{product}/edit', 'update')->name('update');
            Route::delete('/{product}', 'destroy')->name('destroy');
        });

    Route::controller(ProductVariantController::class)
        ->name('productVariants.')
        ->prefix('/products/{product}/variants')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{productVariant}/edit', 'edit')->name('edit');
            Route::put('/{productVariant}/edit', 'update')->name('update');
            Route::delete('/{productVariant}', 'destroy')->name('destroy');
        });

    Route::controller(CustomerController::class)
        ->name('customers.')
        ->prefix('/customers')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{customer}/edit', 'edit')->name('edit');
            Route::put('/{customer}/edit', 'update')->name('update');
            Route::delete('/{customer}', 'destroy')->name('destroy');
        });
});
