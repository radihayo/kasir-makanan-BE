<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\transactionsController;
use App\Http\Controllers\forgotPasswordController;

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

Route::post('/login', [authController::class, 'login']);
Route::get('/logout', [authController::class,'logout'])->middleware(['auth:sanctum']);
Route::post('/forgot_password', [forgotPasswordController::class, 'forgot_password']);

Route::middleware(['auth:sanctum'])->prefix('/products')->group(function () {
    Route::get('/show',[productsController::class,'show']);
    Route::post('/store', [productsController::class,'store']);
    Route::put('/update/{id}',[productsController::class,'update']);
    Route::delete('/destroy/{id}', [productsController::class,'destroy']);
});

Route::middleware(['auth:sanctum'])->prefix('/employees')->group(function () {
    Route::get('/show',[employeesController::class,'show']);
    Route::post('/store', [employeesController::class,'store']);
    Route::put('/update/{id}',[employeesController::class,'update']);
    Route::delete('/destroy/{id}', [employeesController::class,'destroy']);
    Route::put('/change_password/{id}',[employeesController::class,'change_password']);
    Route::put('/reset_password/{id}',[employeesController::class,'reset_password']);
});

Route::middleware(['auth:sanctum'])->prefix('/transactions')->group(function () {
    Route::get('/show',[transactionsController::class,'show']);
    Route::post('/store', [transactionsController::class,'store']);
});

Route::middleware(['auth:sanctum'])->prefix('/dashboard')->group(function () {
    Route::get('/total_employees',[dashboardController::class, 'total_employees']);
    Route::get('/total_products',[dashboardController::class, 'total_products']);
    Route::get('/order_today',[dashboardController::class,'order_today']);
    Route::get('/products_sell_today',[dashboardController::class,'products_sell_today']);
    Route::get('/best_selling_products_today',[dashboardController::class,'best_selling_products_today']);
    Route::get('/statistic_revenue_each_month',[dashboardController::class,'statistic_revenue_each_month']);
    Route::get('/statistic_revenue_each_day',[dashboardController::class,'statistic_revenue_each_day']);
});