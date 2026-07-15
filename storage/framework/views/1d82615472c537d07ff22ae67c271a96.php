<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - <?php echo e($order->invoice_number); ?></title>
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
            <?php echo $barcode; ?>

            <div style="font-size: 12px; letter-spacing: 2px; margin-top: 5px;"><?php echo e($order->invoice_number); ?></div>
        </div>
    </div>

    <table class="info-section">
        <tr>
            <td style="padding-right: 15px;">
                <div class="info-box">
                    <strong>Invoice To:</strong><br>
                    <?php echo e($order->customer_name); ?><br>
                    Phone: <?php echo e($order->customer_phone); ?><br>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->customer_alt_phone): ?> Alt Phone: <?php echo e($order->customer_alt_phone); ?><br> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    Address: <?php echo e($order->full_address); ?><br>
                    <?php echo e($order->thana); ?>, <?php echo e($order->district); ?>

                </div>
            </td>
            <td style="padding-left: 15px;">
                <div class="info-box">
                    <strong>Order Details:</strong><br>
                    Invoice No: <?php echo e($order->invoice_number); ?><br>
                    Date: <?php echo e($order->created_at->format('F d, Y')); ?><br>
                    Payment Method: <?php echo e(strtoupper($order->payment_method)); ?><br>
                    Payment Status: <?php echo e(ucfirst($order->payment_status)); ?>

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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <tr>
                <td><?php echo e($item->product ? $item->product->name : 'Unknown Product'); ?></td>
                <td style="text-align: center;"><?php echo e($item->quantity); ?></td>
                <td class="right">BDT <?php echo e(number_format($item->unit_price, 2)); ?></td>
                <td class="right">BDT <?php echo e(number_format($item->unit_price * $item->quantity, 2)); ?></td>
            </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td class="label">Subtotal:</td>
            <td>BDT <?php echo e(number_format($order->subtotal, 2)); ?></td>
        </tr>
        <tr>
            <td class="label">Delivery Charge:</td>
            <td>BDT <?php echo e(number_format($order->delivery_charge, 2)); ?></td>
        </tr>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount_amount > 0): ?>
        <tr>
            <td class="label">Discount:</td>
            <td style="color: green;">- BDT <?php echo e(number_format($order->discount_amount, 2)); ?></td>
        </tr>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <tr class="grand-total">
            <td class="label">Grand Total:</td>
            <td>BDT <?php echo e(number_format($order->total_amount, 2)); ?></td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for shopping with Electro.bd!</p>
        <p>If you have any questions, please contact our support at support@electro.bd</p>
    </div>

</body>
</html>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\electro-bd\resources\views\invoices\pdf.blade.php ENDPATH**/ ?>