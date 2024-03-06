<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\transactionsController;

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

// Route::prefix('/products')->group(function () {
//     Route::get('/show',[productsController::class,'show']);
//     Route::get('/show/{id}', [productsController::class,'detail']);
//     Route::post('/store', [productsController::class,'store']);
//     Route::put('/update/{id}',[productsController::class,'update']);
//     Route::delete('/destroy/{id}', [productsController::class,'destroy']);
// });

Route::middleware(['auth:sanctum'])->prefix('/products')->group(function () {
    Route::get('/show',[productsController::class,'show']);
    Route::get('/show/{id}', [productsController::class,'detail']);
    Route::post('/store', [productsController::class,'store']);
    Route::put('/update/{id}',[productsController::class,'update']);
    Route::delete('/destroy/{id}', [productsController::class,'destroy']);
});

Route::middleware(['auth:sanctum'])->prefix('/employees')->group(function () {
    Route::get('/show',[employeesController::class,'show']);
    Route::get('/show/{id}', [employeesController::class,'detail']);
    Route::post('/store', [employeesController::class,'store']);
    Route::put('/update/{id}',[employeesController::class,'update']);
    Route::delete('/destroy/{id}', [employeesController::class,'destroy']);
});

Route::middleware(['auth:sanctum'])->prefix('/transactions')->group(function () {
    Route::get('/show',[transactionsController::class,'show']);
    Route::get('/show/{id}', [transactionsController::class,'detail']);
    Route::post('/store', [transactionsController::class,'store']);
    Route::put('/update/{id}',[transactionsController::class,'update']);
    Route::delete('/destroy/{id}', [transactionsController::class,'destroy']);
});