<?php
use App\Http\Controllers\InvoiceController;

Route::post('/invoice/calculate', [InvoiceController::class, 'calculate']);
Route::post('/invoice/pdf', [InvoiceController::class, 'pdf']);