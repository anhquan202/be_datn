<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\Authentication\StaffController;
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
require __DIR__ . "/product_routes.php";

// API Customer
require __DIR__ . "/customer_routes.php";

//API phone details
require __DIR__ . "/phonedetail_routes.php";

//API audio details
require __DIR__ . "/audiodetail_routes.php";

//API computers detail
require __DIR__ . '/computersdetail_routes.php';

//API type
Route::get('types', [TypeController::class, 'show']);

//API auth
Route::post('login', [StaffController::class, 'login']);

//API invoice
require __DIR__ . '/invoice_routes.php';