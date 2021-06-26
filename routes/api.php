<?php

use App\Http\Controllers\ClientController\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController\BrandController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ProductSizeController;
use App\Http\Controllers\AdminController\ProductColorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:sanctum']], function (){
    Route::get('/users', [AuthController::class, 'users']);
    Route::post('/logout', [AuthController::class, 'logOut']);
});

Route::prefix('/backend')->group(function(){
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::prefix('/category')->group(function(){
        Route::post('/store', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::get('/products', [ProductController::class, 'index']);
    Route::prefix('/product')->group(function(){
        Route::get('/init', [ProductController::class, 'init']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);

        Route::get('/colors', [ProductColorController::class, 'index']);
        Route::prefix('/color')->group(function(){
            Route::post('/store', [ProductColorController::class, 'store']);
            Route::put('/{id}', [ProductColorController::class, 'update']);
            Route::delete('/{id}', [ProductColorController::class, 'destroy']);
        });

        Route::get('/sizes', [ProductSizeController::class, 'index']);
        Route::prefix('/size')->group(function(){
            Route::post('/store', [ProductSizeController::class, 'store']);
            Route::put('/{id}', [ProductSizeController::class, 'update']);
            Route::delete('/{id}', [ProductSizeController::class, 'destroy']);
        });
    });

    Route::get('/brands', [BrandController::class, 'index']);
    Route::prefix('/brand')->group(function(){
        Route::post('/store', [BrandController::class, 'store']);
        Route::put('/{id}', [BrandController::class, 'update']);
        Route::delete('/{id}', [BrandController::class, 'destroy']);
    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot', [AuthController::class, 'checkForgot']);
Route::post('/reset/{token}', [AuthController::class, 'passUpdate']);
Route::post('/login', [AuthController::class, 'login']);
