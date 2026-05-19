<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
Route::get('/', function () {
   return bcrypt('123456');
  //  return view('welcome');
});

Route::get('/login', [\App\Http\Controllers\StaffController::class, 'login'])
    ->name('staffs.login');
Route::post('/login', [\App\Http\Controllers\StaffController::class, 'loginProcess'])
    ->name('staffs.loginProcess');

Route::middleware('authStaff')->prefix('/staffs');
//
//Route hiển thị danh sách
Route::get('/brands', [\App\Http\Controllers\BrandController::class, 'index'])
    ->name('brands.index');
//Route hiển thị form thêm
Route::get('/brands/create', [\App\Http\Controllers\BrandController::class, 'create'])
    ->name('brands.create');
//Route thêm dữ liệu
Route::post('/brands/create', [\App\Http\Controllers\BrandController::class, 'store'])
    ->name('brands.store');
//Route hiển thị form sửa
Route::get('/brands/{brand}/edit', [\App\Http\Controllers\BrandController::class, 'edit'])
    ->name('brands.edit');
//Route update dữ liệu
Route::put('/brands/{brand}/edit', [\App\Http\Controllers\BrandController::class, 'update'])
    ->name('brands.update');
//Route delete dữ liệu
Route::delete('/brands/{brand}', [\App\Http\Controllers\BrandController::class, 'destroy'])
    ->name('brands.destroy');

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
Route::controller(\App\Http\Controllers\ConfigurationController::class)
    ->name('configurations.')
    ->prefix('/configurations')
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
        Route::get('/{configuration}/edit', 'edit')
            ->name('edit');
        //Route update dữ liệu
        Route::put('/{configuration}/edit', 'update')
            ->name('update');
        //Route delete dữ liệu
        Route::delete('/{configuration}', 'destroy')
            ->name('destroy');


    });
Route::controller(\App\Http\Controllers\ProductController::class)
    ->name('products.')
    ->prefix('/products')
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
        Route::get('/{product}/edit', 'edit')
            ->name('edit');
        //Route update dữ liệu
        Route::put('/{product}/edit', 'update')
            ->name('update');
        //Route delete dữ liệu
        Route::delete('/{product}', 'destroy')
            ->name('destroy');


    });

Route::controller(CustomerController::class)
    ->name('customers.')
    ->prefix('/customers')
    ->group(function(){
        // Route hiển thị danh sách
        Route::get('/', 'index')
            ->name('index');

        // Route hiển thị form thêm
        Route::get('/create', 'create')
            ->name('create');

        // Route thêm dữ liệu
        Route::post('/create', 'store')
            ->name('store');

        // Route hiển thị form sửa
        Route::get('/{customer}/edit', 'edit')
            ->name('edit');

        // Route update dữ liệu
        Route::put('/{customer}/edit', 'update')
            ->name('update');

        // Route delete dữ liệu
        Route::delete('/{customer}', 'destroy')
            ->name('destroy');
    });


