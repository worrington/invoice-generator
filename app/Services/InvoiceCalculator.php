<?php

namespace App\Services;

class InvoiceCalculator
{
    public static function calculate(array $data): array
    {
        $subtotal = collect($data['items'])
            ->sum(fn($i) => $i['quantity'] * $i['price']);

        $discount = $subtotal * ($data['discount'] / 100);

        if ($data['mode'] === 'service') {
            $tax = ($subtotal - $discount) * ($data['tax'] / 100);
            $total = $subtotal - $discount + $tax;
        } else {
            $tax = $subtotal * ($data['tax'] / 100);
            $total = $subtotal + $tax - $discount;
        }

        return [
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'tax' => round($tax, 2),
            'total' => round($total, 2),
        ];
    }
}
