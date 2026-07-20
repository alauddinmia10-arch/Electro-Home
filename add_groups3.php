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
        
        // Remove the property entirely
        $content = preg_replace('/protected static string\\\\\|\\\\\\\UnitEnum\\\\\|null \$navigationGroup = \'MANAGEMENT\';\s*/m', '', $content);
        $content = preg_replace('/protected static string\|\\\\\\\UnitEnum\|null \$navigationGroup = \'MANAGEMENT\';\s*/m', '', $content);
        $content = preg_replace('/protected static string\|\\\\UnitEnum\|null \$navigationGroup = \'MANAGEMENT\';\s*/m', '', $content);
        $content = preg_replace('/protected static \?string \$navigationGroup = \'MANAGEMENT\';\s*/m', '', $content);
        
        // Check if getNavigationGroup already exists
        if (strpos($content, 'function getNavigationGroup') === false) {
            // Add the method before form()
            $method = "\n    public static function getNavigationGroup(): ?string\n    {\n        return 'MANAGEMENT';\n    }\n\n    public static function form";
            $content = str_replace('    public static function form', $method, $content);
        }
        
        file_put_contents($path, $content);
        echo "Updated $f\n";
    }
}
