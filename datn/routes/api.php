<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
// */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//API Product
Route::get('products/search', [ProductController::class, 'search']);

Route::get('products/{id?}', [ProductController::class, 'index']);

Route::get('products', [ProductController::class, 'index']);

Route::post('products', [ProductController::class, 'create']);

Route::put('products/{id}', [ProductController::class, 'update']);

Route::delete('products/{id}', [ProductController::class, 'delete']);

// API Customer
Route::get('customers/search', [ProductController::class, 'search']);

Route::get('customers/{id?}', [ProductController::class, 'index']);

Route::get('customers', [ProductController::class, 'index']);

Route::post('customers', [ProductController::class, 'create']);

Route::put('customers/{id}', [ProductController::class, 'update']);

Route::delete('customers/{id}', [ProductController::class, 'delete']);