<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Delivery settings
            'free_delivery_threshold' => '5000',
            'hidden_profit_target' => '500',
            'dhaka_delivery_charge' => '70',
            'outside_dhaka_delivery_charge' => '130',

            // Contact info
            'whatsapp_number' => '+8801880223099',
            'support_phone' => '+8801880223099',
            'support_email' => 'support@electrohome.bd',

            // Site settings
            'site_name' => 'Electrohome.bd',
            'site_tagline' => 'Premium Electronics Components Store',
            'currency' => 'BDT',
            'currency_symbol' => '৳',

            // Facebook tracking
            'facebook_pixel_id' => '',
            'facebook_capi_token' => '',

            // SMS settings
            'sms_api_key' => '',
            'sms_sender_id' => 'Electrohome.bd',

            // Invoice settings
            'invoice_prefix' => 'EL-',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
