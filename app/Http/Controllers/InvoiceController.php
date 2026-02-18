<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Services\InvoiceCalculator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function calculate(StoreInvoiceRequest $request)
    {
        $data = $request->all();

        $totals = InvoiceCalculator::calculate($data);

        return response()->json($totals);
    }


    public function pdf(StoreInvoiceRequest $request)
    {
        $data = $request->validated();

        $totals = InvoiceCalculator::calculate($data);

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $data,
            'totals' => $totals
        ]);

        return $pdf->download('invoice.pdf');
    }
}