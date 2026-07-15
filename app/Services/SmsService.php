<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $token;
    protected $apiUrl;

    public function __construct()
    {
        $this->token = config('services.greenweb.token');
        $this->apiUrl = 'http://api.greenweb.com.bd/api.php';
    }

    public function sendSms($to, $message)
    {
        // Mock mode: if token is empty, log the SMS
        if (empty($this->token)) {
            Log::info("SMS Mock [To: {$to}]: {$message}");
            return true;
        }

        try {
            $response = Http::asForm()->post($this->apiUrl, [
                'token' => $this->token,
                'to' => $to,
                'message' => $message
            ]);

            if ($response->successful()) {
                return true;
            }
            
            Log::error('GreenWeb SMS Error: HTTP ' . $response->status());
        } catch (\Exception $e) {
            Log::error('GreenWeb SMS Exception: ' . $e->getMessage());
        }

        return false;
    }

    public function sendOrderConfirmation($order)
    {
        $message = "আপনার অর্ডার গ্রহণ করা হয়েছে। Invoice: {$order->invoice_number}. ধন্যবাদ, Electro.bd";
        return $this->sendSms($order->customer_phone, $message);
    }

    public function sendOrderShipped($order)
    {
        $message = "আপনার পার্সেল (Invoice: {$order->invoice_number}) কুরিয়ারে হস্তান্তর করা হয়েছে। ধন্যবাদ, Electro.bd";
        return $this->sendSms($order->customer_phone, $message);
    }
}
