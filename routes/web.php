<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return bcrypt('123456');
});

Route::get('/login', [\App\Http\Controllers\StaffController::class, 'login'])
    ->name('staffs.login');
Route::post('/login', [\App\Http\Controllers\StaffController::class, 'loginProcess'])
    ->name('staffs.loginProcess');

Route::middleware('authStaff')->prefix('/staffs')
    ->group(function(){
        Route::controller(\App\Http\Controllers\BrandController::class)
            ->name('brands.')
            ->prefix('/brands')
            ->group(function(){
                //Route hiển thị danh sách
                Route::get('/', 'index')
                    ->name('index');
                //Route hiển thị form thêm
                Route::get('/create', 'create')
                    ->name('create');
                //Route thêm dữ liệu
                Route::post('/create', 'store')
                    ->name('store');
                //Route hiển thị form sửa
                Route::get('/{brand}/edit', 'edit')
                    ->name('edit');
                //Route update dữ liệu
                Route::put('/{brand}/edit', 'update')
                    ->name('update');
                //Route delete dữ liệu
                Route::delete('/{brand}', 'destroy')
                    ->name('destroy');
            });
        Route::controller(\App\Http\Controllers\ProductTypeController::class)
            ->name('productTypes.')
            ->prefix('/productTypes')
            ->group(function(){
                //Route hiển thị danh sách
                Route::get('/', 'index')
                    ->name('index');
                //Route hiển thị form thêm
                Route::get('/create', 'create')
                    ->name('create');
                //Route thêm dữ liệu
                Route::post('/create', 'store')
                    ->name('store');
                //Route hiển thị form sửa
                Route::get('/{productType}/edit', 'edit')
                    ->name('edit');
                //Route update dữ liệu
                Route::put('/{productType}/edit', 'update')
                    ->name('update');
                //Route delete dữ liệu
                Route::delete('/{productType}', 'destroy')
                    ->name('destroy');
            });
        Route::controller(\App\Http\Controllers\PaymentController::class)
            ->name('payments.')
            ->prefix('/payments')
            ->group(function(){
                //Route hiển thị danh sách
                Route::get('/', 'index')
                    ->name('index');
                //Route hiển thị form thêm
                Route::get('/create', 'create')
                    ->name('create');
                //Route thêm dữ liệu
                Route::post('/create', 'store')
                    ->name('store');
                //Route hiển thị form sửa
                Route::get('/{payment}/edit', 'edit')
                    ->name('edit');
                //Route update dữ liệu
                Route::put('/{payment}/edit', 'update')
                    ->name('update');
                //Route delete dữ liệu
                Route::delete('/{payment}', 'destroy')
                    ->name('destroy');
            });
        Route::controller(\App\Http\Controllers\StatusController::class)
            ->name('statuses.')
            ->prefix('/statuses')
            ->group(function(){
                //Route hiển thị danh sách
                Route::get('/', 'index')
                    ->name('index');
                //Route hiển thị form thêm
                Route::get('/create', 'create')
                    ->name('create');
                //Route thêm dữ liệu
                Route::post('/create', 'store')
                    ->name('store');
                //Route hiển thị form sửa
                Route::get('/{status}/edit', 'edit')
                    ->name('edit');
                //Route update dữ liệu
                Route::put('/{status}/edit', 'update')
                    ->name('update');
                //Route delete dữ liệu
                Route::delete('/{status}', 'destroy')
                    ->name('destroy');
            });
    });


