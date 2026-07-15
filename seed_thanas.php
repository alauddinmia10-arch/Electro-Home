<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\District;
use App\Models\Thana;

// Download JSON
$districtsJson = file_get_contents('https://raw.githubusercontent.com/nuhil/bangladesh-geocode/master/districts/districts.json');
$upazilasJson = file_get_contents('https://raw.githubusercontent.com/nuhil/bangladesh-geocode/master/upazilas/upazilas.json');

if (!$districtsJson || !$upazilasJson) {
    echo "Failed to download JSON files.\n";
    exit;
}

$bdDistricts = json_decode($districtsJson, true)[2]['data'];
$bdUpazilas = json_decode($upazilasJson, true)[2]['data'];

$districtIdMap = [];
foreach ($bdDistricts as $d) {
    // Some names might differ slightly, we'll try to match by name
    $districtIdMap[$d['id']] = $d['name'];
}

$thanaCount = 0;
$dbDistricts = District::all()->keyBy('name');

foreach ($bdUpazilas as $upazila) {
    $districtName = $districtIdMap[$upazila['district_id']] ?? null;
    if ($districtName) {
        // Fix spelling differences
        if ($districtName === 'Coxsbazar') $districtName = 'Cox\'s Bazar';
        if ($districtName === 'Brahmanbaria') $districtName = 'Brahmanbaria';
        if ($districtName === 'Chittagong') $districtName = 'Chattogram';
        if ($districtName === 'Comilla') $districtName = 'Comilla';
        if ($districtName === 'Barisal') $districtName = 'Barishal';
        if ($districtName === 'Jhalokati') $districtName = 'Jhalokati';
        if ($districtName === 'Bogra') $districtName = 'Bogra';
        if ($districtName === 'Jessore') $districtName = 'Jessore';

        $dbDistrict = $dbDistricts->get($districtName);
        if ($dbDistrict) {
            Thana::firstOrCreate(
                ['district_id' => $dbDistrict->id, 'name' => $upazila['name']],
                ['bn_name' => $upazila['bn_name']]
            );
            $thanaCount++;
        }
    }
}

echo "Successfully seeded $thanaCount Thanas/Upazilas!\n";
