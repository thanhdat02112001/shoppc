<?php

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/products',function(){
    return view('frontend.product');
});

Route::get('/cart',function(){
    return view('frontend.cart');
});

Route::get('/checkout',function(){
    return view('frontend.checkout');
});
//backend
Route::group(['prefix' => "/admin"], function () {
    Route::get('/', function(){
        return view('backend.dashboard');
    });

    Route::group(['prefix' => "/categories"], function() {
        Route::get('/', [CategoryController::class, "show"])->name("categoryHome");
        Route::post('/', [CategoryController::class, 'save'])->name("addCategory");
        Route::get('/edit/{id}', [CategoryController::class, "edit"])->name("editCategory");
        Route::post('/edit/{id}', [CategoryController::class, "save"])->name("saveEdit");
        Route::get('/delete/{id}', [CategoryController::class, "delete"])->name('deleteCategory');
    });

    Route::group(['prefix' => "/products"], function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/addProduct', [ProductController::class, "add"])->name("addProduct");
    });
    
    Route::get('/order', function(){
        return view('backend.order');
    });
    
    Route::get('/listuser', function(){
        return view('backend.listuser');
    });
});

