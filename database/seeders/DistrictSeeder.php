<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Thana;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        // Dhaka Division districts get 70tk delivery, all others 130tk
        $dhakaDistricts = [
            'Dhaka' => 'ঢাকা',
            'Gazipur' => 'গাজীপুর',
            'Narayanganj' => 'নারায়ণগঞ্জ',
            'Manikganj' => 'মানিকগঞ্জ',
            'Munshiganj' => 'মুন্সিগঞ্জ',
            'Narsingdi' => 'নরসিংদী',
            'Tangail' => 'টাঙ্গাইল',
            'Kishoreganj' => 'কিশোরগঞ্জ',
            'Madaripur' => 'মাদারীপুর',
            'Gopalganj' => 'গোপালগঞ্জ',
            'Faridpur' => 'ফরিদপুর',
            'Rajbari' => 'রাজবাড়ী',
            'Shariatpur' => 'শরীয়তপুর',
        ];

        $otherDistricts = [
            // Chattogram Division
            'Chattogram' => 'চট্টগ্রাম',
            "Cox's Bazar" => 'কক্সবাজার',
            'Comilla' => 'কুমিল্লা',
            'Brahmanbaria' => 'ব্রাহ্মণবাড়িয়া',
            'Chandpur' => 'চাঁদপুর',
            'Lakshmipur' => 'লক্ষ্মীপুর',
            'Noakhali' => 'নোয়াখালী',
            'Feni' => 'ফেনী',
            'Khagrachari' => 'খাগড়াছড়ি',
            'Rangamati' => 'রাঙ্গামাটি',
            'Bandarban' => 'বান্দরবান',
            // Rajshahi Division
            'Rajshahi' => 'রাজশাহী',
            'Bogra' => 'বগুড়া',
            'Pabna' => 'পাবনা',
            'Sirajganj' => 'সিরাজগঞ্জ',
            'Natore' => 'নাটোর',
            'Naogaon' => 'নওগাঁ',
            'Nawabganj' => 'নবাবগঞ্জ',
            'Joypurhat' => 'জয়পুরহাট',
            // Khulna Division
            'Khulna' => 'খুলনা',
            'Jessore' => 'যশোর',
            'Satkhira' => 'সাতক্ষীরা',
            'Narail' => 'নড়াইল',
            'Magura' => 'মাগুরা',
            'Kushtia' => 'কুষ্টিয়া',
            'Chuadanga' => 'চুয়াডাঙ্গা',
            'Meherpur' => 'মেহেরপুর',
            'Jhenaidah' => 'ঝিনাইদহ',
            'Bagerhat' => 'বাগেরহাট',
            // Barishal Division
            'Barishal' => 'বরিশাল',
            'Patuakhali' => 'পটুয়াখালী',
            'Pirojpur' => 'পিরোজপুর',
            'Jhalokati' => 'ঝালকাঠি',
            'Bhola' => 'ভোলা',
            'Barguna' => 'বরগুনা',
            // Sylhet Division
            'Sylhet' => 'সিলেট',
            'Moulvibazar' => 'মৌলভীবাজার',
            'Habiganj' => 'হবিগঞ্জ',
            'Sunamganj' => 'সুনামগঞ্জ',
            // Rangpur Division
            'Rangpur' => 'রংপুর',
            'Dinajpur' => 'দিনাজপুর',
            'Kurigram' => 'কুড়িগ্রাম',
            'Gaibandha' => 'গাইবান্ধা',
            'Nilphamari' => 'নীলফামারী',
            'Lalmonirhat' => 'লালমনিরহাট',
            'Thakurgaon' => 'ঠাকুরগাঁও',
            'Panchagarh' => 'পঞ্চগড়',
            // Mymensingh Division
            'Mymensingh' => 'ময়মনসিংহ',
            'Jamalpur' => 'জামালপুর',
            'Netrokona' => 'নেত্রকোণা',
            'Sherpur' => 'শেরপুর',
        ];

        // Seed Dhaka districts (70tk delivery)
        foreach ($dhakaDistricts as $name => $bnName) {
            District::create([
                'name' => $name,
                'bn_name' => $bnName,
                'delivery_charge' => 70.00,
            ]);
        }

        // Seed other districts (130tk delivery)
        foreach ($otherDistricts as $name => $bnName) {
            District::create([
                'name' => $name,
                'bn_name' => $bnName,
                'delivery_charge' => 130.00,
            ]);
        }
    }
}
