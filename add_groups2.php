<?php
$files = ['Banners' => 'Banner', 'Coupons' => 'Coupon', 'Orders' => 'Order', 'Questions' => 'Question', 'Reviews' => 'Review', 'Tests' => 'Test', 'WholesaleRequests' => 'WholesaleRequest'];
foreach ($files as $dir => $f) {
    $p = "app/Filament/Resources/$dir/{$f}Resource.php";
    if (!file_exists($p)) $p = "app/Filament/Resources/{$f}Resource.php";
    if (file_exists($p)) {
        $c = file_get_contents($p);
        
        // Remove the getNavigationGroup method completely
        $c = preg_replace('/public static function getNavigationGroup\(\): \?string\s*\{\s*return \'MANAGEMENT\';\s*\}/s', '', $c);
        
        // Ensure no leftover empty lines around it
        $c = preg_replace("/\n\n\n+/", "\n\n", $c);

        // Add the property
        if (!str_contains($c, '$navigationGroup = \'MANAGEMENT\'')) {
            $c = preg_replace('/(protected static \?string \$recordTitleAttribute.*?;)/s', "$1\n\n    protected static string|\UnitEnum|null \$navigationGroup = 'MANAGEMENT';", $c);
        }
        
        file_put_contents($p, $c);
        echo "Updated $f\n";
    }
}

// For UserResource, we need to remove getNavigationGroup only
$p = "app/Filament/Resources/Users/UserResource.php";
if (!file_exists($p)) $p = "app/Filament/Resources/UserResource.php";
if (file_exists($p)) {
    $c = file_get_contents($p);
    $c = preg_replace('/public static function getNavigationGroup\(\): \?string\s*\{\s*return \'MANAGEMENT\';\s*\}/s', '', $c);
    $c = preg_replace("/\n\n\n+/", "\n\n", $c);
    file_put_contents($p, $c);
    echo "Updated User\n";
}

// For SalesAnalytics
$p = "app/Filament/Pages/SalesAnalytics.php";
if (file_exists($p)) {
    $c = file_get_contents($p);
    $c = preg_replace('/public static function getNavigationGroup\(\): \?string\s*\{\s*return \'MANAGEMENT\';\s*\}/s', '', $c);
    if (!str_contains($c, '$navigationGroup = \'MANAGEMENT\'')) {
        $c = preg_replace('/(public static function getNavigationIcon\(\): string\|null\s*\{\s*return \'heroicon-o-chart-bar\';\s*\})/s', "$1\n\n    protected static ?string \$navigationGroup = 'MANAGEMENT';", $c);
    }
    file_put_contents($p, $c);
    echo "Updated SalesAnalytics\n";
}
