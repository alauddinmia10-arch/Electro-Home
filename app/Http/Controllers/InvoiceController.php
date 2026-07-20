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

    public function print(Order $order)
    {
        $order->load(['items.product', 'user']);
        
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($order->invoice_number, $generator::TYPE_CODE_128);

        $pdf = Pdf::loadView('invoices.pdf', [
            'order' => $order,
            'barcode' => $barcode,
        ]);

        return $pdf->stream("invoice-{$order->invoice_number}.pdf");
    }

    public function printBulk(\Illuminate\Http\Request $request)
    {
        $orderIds = $request->input('orders', []);
        
        if (empty($orderIds)) {
            return back()->with('error', 'No orders selected.');
        }

        $orders = Order::whereIn('id', $orderIds)->with(['items.product', 'user'])->get();
        
        $generator = new BarcodeGeneratorHTML();
        $barcodes = [];
        foreach ($orders as $order) {
            $barcodes[$order->id] = $generator->getBarcode($order->invoice_number, $generator::TYPE_CODE_128);
        }

        $pdf = Pdf::loadView('invoices.bulk-pdf', [
            'orders' => $orders,
            'barcodes' => $barcodes,
        ]);

        return $pdf->stream("bulk-invoices.pdf");
    }

    public function printAll()
    {
        // Limiting to latest 200 to prevent memory exhaustion, adjust if needed
        $orders = Order::with(['items.product', 'user'])->latest()->limit(200)->get();
        
        $generator = new BarcodeGeneratorHTML();
        $barcodes = [];
        foreach ($orders as $order) {
            $barcodes[$order->id] = $generator->getBarcode($order->invoice_number, $generator::TYPE_CODE_128);
        }

        $pdf = Pdf::loadView('invoices.bulk-pdf', [
            'orders' => $orders,
            'barcodes' => $barcodes,
        ]);

        return $pdf->stream("all-invoices.pdf");
    }
}
