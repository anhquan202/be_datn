<?php
use App\Http\Controllers\ComputersDetailController;
Route::get('computersdetail/search', [ComputersDetailController::class, 'search']);

Route::get('computersdetail/{id?}', [ComputersDetailController::class, 'index']);

Route::get('computersdetail', [ComputersDetailController::class, 'index']);

Route::post('computersdetail', [ComputersDetailController::class, 'create']);

Route::put('computersdetail/{id?}', [ComputersDetailController::class, 'update']);
