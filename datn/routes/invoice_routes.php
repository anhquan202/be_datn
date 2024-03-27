<?php
use App\Http\Controllers\InvoiceController;

Route::get('invoices/{id?}', [InvoiceController::class, 'index']);

Route::get('invoices', [InvoiceController::class, 'index']);

Route::post('invoices', [InvoiceController::class, 'create']);
