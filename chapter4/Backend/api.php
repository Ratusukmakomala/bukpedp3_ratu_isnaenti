<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Home\MenuController as HomeMenuController;
use App\Http\Controllers\Api\Home\OrderController as HomeOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/auth')->controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::prefix('/home')->group(function(){
    Route::get('/menu', HomeMenuController::class);
    Route::post('/order', HomeOrderController::class);
});

Route::middleware('auth:api')->prefix('/admin')->group(function(){
    Route::get('/user', UserController::class);
    Route::get('/dashboard', DashboardController::class);
    Route::apiResource('menu', MenuController::class);
    Route::prefix('/order')->controller(OrderController::class)->group(function(){
        Route::get('/','index');
        Route::get('/notification','notification');
        Route::get('/history','history');
        Route::get('/{transaction}','show');
        Route::put('/{transaction}','update');
    });
});
