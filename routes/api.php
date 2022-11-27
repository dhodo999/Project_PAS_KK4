<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;

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

//public route 
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('makanan', [ListController::class, 'index']);
Route::get('review', [ReviewController::class, 'index']);


//protected route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('makanan/{id}', [ListController::class, 'show']);
    Route::resource('makanan', ListController::class)->except('create', 'edit', 'show', 'index');
    
    Route::get('order', [OrderController::class, 'index']);
    Route::get('order/{id}', [OrderController::class, 'show']);
    Route::resource('order', OrderController::class)->except('create', 'edit', 'show', 'index');
    
    Route::get('payment', [PaymentController::class, 'index']);
    Route::get('payment/{id}', [PaymentController::class, 'show']);
    Route::resource('payment', PaymentController::class)->except('create', 'edit', 'show', 'index');

    Route::get('review/{id}', [ReviewController::class, 'show']);
    Route::resource('review', ReviewController::class)->except('create', 'edit', 'show', 'index');
    
    Route::post('logout', [AuthController::class, 'logout']);
});