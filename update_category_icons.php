<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;

$updates = [
    // Nulls
    10 => '🔋', // Batteries
    15 => '🪫', // Battery Holder
    96 => '🔋', // Lithium Solar Battery
    97 => '🔋', // Alkaline Battery
    
    // heroicons
    86 => '🔄', // Solar Inverters
    87 => '☀️', // Solar Panels
    88 => '📦', // Solar Package
    89 => '🎛️', // Solar Charge Controller
    90 => '🛠️', // Solar Tools
    91 => '⚡', // Solar Power Station
    92 => '🔌', // DC Wire
    93 => '💡', // Street Light
    94 => '💼', // Portable Power Station
    95 => '🎁', // Combo Package
];

foreach ($updates as $id => $icon) {
    Category::where('id', $id)->update(['icon' => $icon]);
}

// Clear cache
\Illuminate\Support\Facades\Cache::forget('home.categories');
\Illuminate\Support\Facades\Cache::flush();

echo "Updated icons and cleared cache.\n";
