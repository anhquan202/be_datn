<?php
use App\Http\Controllers\ProductController;

Route::get('products/search', [ProductController::class, 'search']);
//test
Route::get('upload', [ProductController::class, 'upload']);

Route::get('products/producttype', [ProductController::class, 'getTypeID']);

Route::get('products/{id?}', [ProductController::class, 'index']);

Route::get('products', [ProductController::class, 'index']);

Route::post('products', [ProductController::class, 'create']);

Route::put('products/{id}', [ProductController::class, 'update']);

Route::delete('products/{id}', [ProductController::class, 'delete']);