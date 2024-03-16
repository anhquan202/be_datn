<?php
use App\Http\Controllers\PhoneDetailController;
Route::get('phonedetails/search', [PhoneDetailController::class, 'search']);

Route::get('phonedetails/{id?}', [PhoneDetailController::class, 'index']);

Route::get('phonedetails', [PhoneDetailController::class, 'index']);

Route::post('phonedetails', [PhoneDetailController::class, 'create']);

Route::put('phonedetails/{id?}', [PhoneDetailController::class, 'update']);
