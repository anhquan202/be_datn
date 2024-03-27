<?php
use App\Http\Controllers\AudioDetailController;
Route::get('audiodetail/search', [AudioDetailController::class, 'search']);

Route::get('audiodetail/{id?}', [AudioDetailController::class, 'index']);

Route::get('audiodetail', [AudioDetailController::class, 'index']);

Route::post('audiodetail', [AudioDetailController::class, 'create']);

Route::put('audiodetail/{id?}', [AudioDetailController::class, 'update']);
