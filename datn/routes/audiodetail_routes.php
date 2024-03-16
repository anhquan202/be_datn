<?php
use App\Http\Controllers\AudioDetailController;
Route::get('audiodetails/search', [AudioDetailController::class, 'search']);

Route::get('audiodetails/{id?}', [AudioDetailController::class, 'index']);

Route::get('audiodetails', [AudioDetailController::class, 'index']);

Route::post('audiodetails', [AudioDetailController::class, 'create']);

Route::put('audiodetails/{id?}', [AudioDetailController::class, 'update']);
