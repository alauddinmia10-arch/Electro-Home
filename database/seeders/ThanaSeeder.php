<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Thana;
use Illuminate\Database\Seeder;

class ThanaSeeder extends Seeder
{
    public function run(): void
    {
        $dhakaThanas = [
            'Mirpur' => 'মিরপুর',
            'Gulshan' => 'গুলশান',
            'Dhanmondi' => 'ধানমন্ডি',
            'Uttara' => 'উত্তরা',
            'Mohammadpur' => 'মোহাম্মদপুর',
            'Badda' => 'বাড্ডা',
            'Tejgaon' => 'তেজগাঁও',
            'Jatrabari' => 'যাত্রাবাড়ী',
        ];

        $districts = District::all();

        foreach ($districts as $district) {
            if ($district->name === 'Dhaka') {
                foreach ($dhakaThanas as $name => $bnName) {
                    Thana::firstOrCreate(
                        ['district_id' => $district->id, 'name' => $name],
                        ['bn_name' => $bnName]
                    );
                }
            } else {
                Thana::firstOrCreate(
                    ['district_id' => $district->id, 'name' => $district->name . ' Sadar'],
                    ['bn_name' => $district->bn_name . ' সদর']
                );
            }
        }
    }
}
