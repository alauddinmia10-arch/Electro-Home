<?php
$files = [
    'Banners' => 'Banner',
    'Coupons' => 'Coupon',
    'Orders' => 'Order',
    'Questions' => 'Question',
    'Reviews' => 'Review',
    'Tests' => 'Test',
    'WholesaleRequests' => 'WholesaleRequest'
];

foreach ($files as $dir => $f) {
    $path = __DIR__ . "/app/Filament/Resources/{$dir}/{$f}Resource.php";
    if (file_exists($path)) {
        $content = file_get_contents($path);
        
        $content = str_replace("'MANAGEMENT'", "'Management'", $content);
        
        file_put_contents($path, $content);
        echo "Updated $f\n";
    }
}

// Also update SalesAnalytics
$path = __DIR__ . "/app/Filament/Pages/SalesAnalytics.php";
if (file_exists($path)) {
    $content = file_get_contents($path);
    $content = str_replace("'MANAGEMENT'", "'Management'", $content);
    file_put_contents($path, $content);
    echo "Updated SalesAnalytics\n";
}
