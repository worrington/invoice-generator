<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #222;
    }

    .header {
      width: 100%;
      border-collapse: collapse;
    }

    .header-left {
      width: calc(100% - 200px);
      vertical-align: top;
    }

    .header-right {
      width: 200px;
      text-align: right;
      vertical-align: top;
    }

    .logo {
        width: 200px;
    }

    .section-title {
      font-weight: bold;
      font-size: 16px;
      color: #233a9f;
      margin-top: 10px;
      margin-bottom: 8px;
    }

    p { margin-bottom: 8px; }

    .space { height: 10px; }

    .meta-box {
      margin-top: 10px;
      padding: 8px;
      font-size: 14px;
    }

    .meta-row {
      margin-bottom: 8px;
    }

    .meta-label {
      font-weight: bold;
      color: #233a9f;
    }

    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 40px;
      margin-bottom: 60px;
    }

    .items-table th {
      background: #233a9f;
      color: white;
      padding: 8px;
      font-size: 11px;
      text-align: left;
    }

    .items-table td {
      padding: 8px;
    }

    .items-table tbody tr:nth-child(odd) {
      background: #ffffff ;
    }

    .items-table tbody tr:nth-child(even) {
      background: #f3f5fb;
    }

    .bottom-section {
      width: 100%;
      margin-top: 20px;
    }

    .notes, .totals {
      width: 49%;
      border: 1px solid #ccc;
      padding: 10px;
      vertical-align: top;
      border-radius: 8px;
    }

    .totals table {
      width: 100%;
    }

    .totals td {
      padding: 4px 0;
    }

    .total-row {
      font-weight: bold;
      border-top: 1px solid #000;
      padding-top: 6px;
    }

    .discount {
      color: rgb(148, 18, 18);
    }

    .footer-note {
      font-size: 10px;
      color: #666;
      text-align: right;
      margin-top: 5px;
    }

    @page {
      margin: 40px 40px 70px 40px;
    }

    .footer {
      position: fixed;
      bottom: -50px;
      left: 0;
      right: 0;
      height: 50px;
      font-size: 10px;
      color: #fff;
    }

    .footer-bar-light {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 12px;
      background: #93c5fd;
    }

    .footer-bar-dark {
      position: absolute;
      bottom: 12px;
      left: 0;
      right: 0;
      height: 12px;
      background: #1e40af;
    }

    .safe-block {
      max-height: 600px;
      overflow: hidden;
      word-wrap: break-word;
    }
  </style>
</head>

<body>
  <div class="footer">
    <div class="footer-bar-dark"></div>
    <div class="footer-bar-light"></div>
  </div>

    <table class="header">
      <tr>
        <td class="header-left">
          <h1>Invoice</h1>

          <h2 class="section-title">{{ $invoice['company']['name'] ?? '' }}</h2>
          <p>{{ $invoice['company']['fullName'] ?? '' }}</p>

          @if(!empty($invoice['company']['website']))
            <a href="{{ $invoice['company']['website'] }}" class="safe-block">{{ $invoice['company']['website'] }}</a>
          @endif

          <p>
            {{ $invoice['company']['city'] ?? '' }},
            {{ $invoice['company']['state'] ?? '' }},
            {{ $invoice['company']['zip'] ?? '' }},
            {{ $invoice['company']['country'] ?? '' }}
          </p>

          <p>{{ $invoice['company']['phone'] ?? '' }} • {{ $invoice['company']['email'] ?? '' }}</p>

          <div class="space"></div>

          <h2 class="section-title">{{ $invoice['client']['name'] ?? '' }}</h2>
          <p>{{ $invoice['client']['fullName'] ?? '' }}</p>

          @if(!empty($invoice['client']['website']))
            <a href="{{ $invoice['client']['website'] }}" class="safe-block">{{ $invoice['client']['website'] }}</a>
          @endif

          <p>
            {{ $invoice['client']['city'] ?? '' }},
            {{ $invoice['client']['state'] ?? '' }},
            {{ $invoice['client']['zip'] ?? '' }},
            {{ $invoice['client']['country'] ?? '' }}
          </p>

          <p>{{ $invoice['client']['phone'] ?? '' }} • {{ $invoice['client']['email'] ?? '' }}</p>
        </td>

        <td class="header-right">
          @if(!empty($invoice['logo']))
            <div class="logo">
              <img src="{{ $invoice['logo'] }}" style="max-width: 100%; object-fit: contain; object-position: right top;" alt="Company Logo ">
            </div>
          @endif

          <div class="meta-box">
            <div class="meta-row">
              <span class="meta-label">Invoice #:</span>
              <strong>{{ $invoice['meta']['invoiceNumber'] ?? '' }}</strong>
            </div>

            <div class="meta-row">
              <span class="meta-label">Date:</span>
              {{ $invoice['meta']['invoiceDate'] ?? '' }}
            </div>

            <div class="meta-row">
              <span class="meta-label">Due:</span>
              {{ $invoice['meta']['dueDate'] ?? '' }}
            </div>
          </div>
        </td>
      </tr>
    </table>

    <table class="items-table">
      <thead>
        <tr>
          <th width="10%">ID</th>
          <th width="55%">DESCRIPTION</th>
          <th width="15%">
            @if($invoice['mode'] === 'service') HOURS @else QUANTITY @endif
          </th>
          <th width="20%">PRICE</th>
        </tr>
      </thead>

      <tbody>
        @foreach($invoice['items'] as $item)
          <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>${{ number_format($item['price'], 2) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <table class="bottom-section">
      <tr>
        <td class="notes">
          Notes:<br>
          {{ $invoice['notes'] ?? '' }}
        </td>

        <td width="2%"></td>

        <td class="totals">
          <table>
            <tr>
              <td>Subtotal</td>
              <td align="right">${{ number_format($totals['subtotal'], 2) }}</td>
            </tr>
            <tr>
              <td>Tax %</td>
              <td align="right">{{ $invoice['tax'] ?? 0 }}</td>
            </tr>
            <tr>
              <td>Discount %</td>
              <td align="right">{{ $invoice['discount'] ?? 0 }}</td>
            </tr>
            <tr>
              <td>Tax amount</td>
              <td align="right">${{ number_format($totals['tax'], 2) }}</td>
            </tr>
            <tr>
              <td class="discount">Discount</td>
              <td align="right" class="discount">
                -${{ number_format($totals['discount'], 2) }}
              </td>
            </tr>
            <tr class="total-row">
              <td>Total</td>
              <td align="right">${{ number_format($totals['total'], 2) }}</td>
            </tr>
          </table>

          <div class="footer-note">
          Calculation mode: {{ $invoice['mode'] ?? 'service' }}
          </div>
        </td>
      </tr>
    </table>
</body>
</html>
