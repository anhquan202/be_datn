<?php
use App\Http\Controllers\CustomerController;

Route::get('customers/search', [CustomerController::class, 'search']);

Route::get('customers/{id?}', [CustomerController::class, 'index']);

Route::get('customers', [CustomerController::class, 'index']);

Route::post('customers', [CustomerController::class, 'create']);
