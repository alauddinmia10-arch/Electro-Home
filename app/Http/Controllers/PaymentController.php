<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order = Order::where('invoice_number', $tran_id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'paid',
                'transaction_id' => $request->input('val_id', 'mock_val_id_' . time())
            ]);
            
            // Optional: send SMS confirmation
            // app(\App\Services\SmsService::class)->sendPaymentSuccessSms($order);

            return redirect()->route('checkout.success', $order->id)
                ->with('message', 'Payment successful!');
        }

        return redirect()->route('home')->with('error', 'Invalid transaction.');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        
        return redirect()->route('home')
            ->with('error', "Payment failed for order: {$tran_id}. Please try again.");
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        
        return redirect()->route('home')
            ->with('warning', "Payment cancelled for order: {$tran_id}.");
    }

    public function ipn(Request $request)
    {
        // This is a server-to-server call from SSLCommerz. No session available.
        $tran_id = $request->input('tran_id');
        $status = $request->input('status');
        
        Log::info('SSLCommerz IPN Received', $request->all());

        if ($status === 'VALID' || $status === 'VALIDATED') {
            $order = Order::where('invoice_number', $tran_id)->first();
            if ($order && $order->payment_status !== 'paid') {
                $order->update([
                    'payment_status' => 'paid',
                    'transaction_id' => $request->input('val_id')
                ]);
            }
        }

        return response()->json(['message' => 'IPN Processed']);
    }

    public function mockGateway(Request $request)
    {
        // This is a local mock page to simulate the SSLCommerz UI
        $tran_id = $request->query('tran_id');
        
        return view('payment.mock', compact('tran_id'));
    }
}
