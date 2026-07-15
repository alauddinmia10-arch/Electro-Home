<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SslCommerzService
{
    protected $storeId;
    protected $storePassword;
    protected $apiUrl;

    public function __construct()
    {
        $this->storeId = config('services.sslcommerz.store_id');
        $this->storePassword = config('services.sslcommerz.store_password');
        
        // Use sandbox URL for local/testing if true
        $isSandbox = config('services.sslcommerz.sandbox', true);
        $this->apiUrl = $isSandbox 
            ? 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v3/api.php';
    }

    public function initiatePayment(Order $order)
    {
        $postData = [
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'total_amount' => $order->total_amount,
            'currency' => 'BDT',
            'tran_id' => $order->invoice_number, // using invoice_number as tran_id
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'ipn_url' => route('payment.ipn'),
            
            // Customer Information
            'cus_name' => $order->customer_name,
            'cus_email' => $order->user ? $order->user->email : 'customer@electro.bd',
            'cus_phone' => $order->customer_phone,
            'cus_add1' => $order->full_address,
            'cus_city' => $order->district,
            'cus_country' => 'Bangladesh',
            
            // Product Information
            'shipping_method' => 'Courier',
            'product_name' => 'Electronic Components',
            'product_category' => 'Electronics',
            'product_profile' => 'general',
        ];

        // Mock mode: if credentials are empty, log and return mock URL
        if (empty($this->storeId) || empty($this->storePassword)) {
            Log::info('SSLCommerz Mock Initiation: ' . json_encode($postData));
            // Return a mock gateway URL (which will just redirect back to success for testing)
            return url('/payment/mock-gateway?tran_id=' . $order->invoice_number);
        }

        try {
            $response = Http::asForm()->post($this->apiUrl, $postData);
            
            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['status']) && $result['status'] === 'SUCCESS') {
                    return $result['GatewayPageURL'];
                }
                
                Log::error('SSLCommerz Error: ' . ($result['failedreason'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('SSLCommerz Exception: ' . $e->getMessage());
        }
        
        return null;
    }
}
