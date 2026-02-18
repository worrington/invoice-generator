<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Services\InvoiceCalculator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function validateInvoice(StoreInvoiceRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $base64 = base64_encode(file_get_contents($file->getRealPath()));

            $data['logo'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        $totals = InvoiceCalculator::calculate($data);

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $data,
            'totals' => $totals
        ]);

        return $pdf->stream();
    }

}
