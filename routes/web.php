<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController\AuthController;

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

Route::prefix('backend')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/', function () {
            return view('backend.page.category.index');
        })->name("categories");
    });
    Route::prefix('brand')->group(function () {
        Route::get('/', function () {
            return view('backend.page.brand.index');
        });
    });
    Route::prefix('product')->group(function () {
        Route::get('/color', function () {
            return view('backend.page.product.product_color.index');
        });
        Route::get('/size', function () {
            return view('backend.page.product.product_size.index');
        });
        Route::get('/', function () {
            return view('backend.page.product.index');
        });
    });
    Route::get('/index', function(){
        return view('backend.page.index');
    });
});

Route::prefix('account')->group(function () {
    Route::get('/login-register', function () {
        return view('frontend.page.login.index');
    })->name('login');
    Route::get('/forgot', [AuthController::class, 'forgot'])->name('password.update');
    Route::get('/reset/{token}', [AuthController::class, 'passReset'])->name('password.reset');
});

Route::get('/', function () {
    return view('frontend.page.home.index');
});