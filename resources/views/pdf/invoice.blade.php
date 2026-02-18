<h1>Invoice</h1>

@foreach($invoice['items'] as $item)
<p>
  {{ $item['description'] }}
  - {{ $item['quantity'] }}
  x {{ $item['price'] }}
</p>
@endforeach

<hr>

<p>Subtotal: {{ $totals['subtotal'] }}</p>
<p>Tax: {{ $totals['tax'] }}</p>
<p>Discount: {{ $totals['discount'] }}</p>
<h2>Total: {{ $totals['total'] }}</h2>
