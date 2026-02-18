<?php
use App\Http\Controllers\InvoiceController;

Route::post('/invoice/validate', [InvoiceController::class, 'validateInvoice']);
Route::post('/invoice/pdf', [InvoiceController::class, 'pdf']);