<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorHTML;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        $order->load(['items.product', 'user']);
        
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($order->invoice_number, $generator::TYPE_CODE_128);

        $pdf = Pdf::loadView('invoices.pdf', [
            'order' => $order,
            'barcode' => $barcode,
        ]);

        return $pdf->download("invoice-{$order->invoice_number}.pdf");
    }
}
