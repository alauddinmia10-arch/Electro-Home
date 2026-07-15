<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $order->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2b3a4a;
            margin: 0;
            font-size: 28px;
        }
        .barcode {
            margin-top: 10px;
            text-align: center;
        }
        .barcode div {
            display: inline-block;
        }
        .info-section {
            width: 100%;
            margin-bottom: 30px;
        }
        .info-section td {
            vertical-align: top;
            width: 50%;
        }
        .info-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.items th {
            background: #2b3a4a;
            color: #fff;
            padding: 10px;
            text-align: left;
        }
        table.items td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        table.items th.right, table.items td.right {
            text-align: right;
        }
        .totals {
            width: 100%;
            border-collapse: collapse;
        }
        .totals td {
            padding: 8px 10px;
            text-align: right;
        }
        .totals td.label {
            font-weight: bold;
            width: 75%;
        }
        .totals tr.grand-total td {
            font-size: 18px;
            font-weight: bold;
            color: #e53e3e;
            border-top: 2px solid #333;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Electro.bd</h1>
        <p>Premium Electronics in Bangladesh</p>
        <div class="barcode">
            {!! $barcode !!}
            <div style="font-size: 12px; letter-spacing: 2px; margin-top: 5px;">{{ $order->invoice_number }}</div>
        </div>
    </div>

    <table class="info-section">
        <tr>
            <td style="padding-right: 15px;">
                <div class="info-box">
                    <strong>Invoice To:</strong><br>
                    {{ $order->customer_name }}<br>
                    Phone: {{ $order->customer_phone }}<br>
                    @if($order->customer_alt_phone) Alt Phone: {{ $order->customer_alt_phone }}<br> @endif
                    Address: {{ $order->full_address }}<br>
                    {{ $order->thana }}, {{ $order->district }}
                </div>
            </td>
            <td style="padding-left: 15px;">
                <div class="info-box">
                    <strong>Order Details:</strong><br>
                    Invoice No: {{ $order->invoice_number }}<br>
                    Date: {{ $order->created_at->format('F d, Y') }}<br>
                    Payment Method: {{ strtoupper($order->payment_method) }}<br>
                    Payment Status: {{ ucfirst($order->payment_status) }}
                </div>
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>Item Description</th>
                <th style="width: 15%; text-align: center;">Qty</th>
                <th style="width: 20%;" class="right">Unit Price</th>
                <th style="width: 20%;" class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product ? $item->product->name : 'Unknown Product' }}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td class="right">BDT {{ number_format($item->unit_price, 2) }}</td>
                <td class="right">BDT {{ number_format($item->unit_price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td class="label">Subtotal:</td>
            <td>BDT {{ number_format($order->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Delivery Charge:</td>
            <td>BDT {{ number_format($order->delivery_charge, 2) }}</td>
        </tr>
        @if($order->discount_amount > 0)
        <tr>
            <td class="label">Discount:</td>
            <td style="color: green;">- BDT {{ number_format($order->discount_amount, 2) }}</td>
        </tr>
        @endif
        <tr class="grand-total">
            <td class="label">Grand Total:</td>
            <td>BDT {{ number_format($order->total_amount, 2) }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for shopping with Electro.bd!</p>
        <p>If you have any questions, please contact our support at support@electro.bd</p>
    </div>

</body>
</html>
