<?php
$files = ['Banners' => 'Banner', 'Coupons' => 'Coupon', 'Orders' => 'Order', 'Questions' => 'Question', 'Reviews' => 'Review', 'Tests' => 'Test', 'Users' => 'User', 'WholesaleRequests' => 'WholesaleRequest'];
foreach ($files as $dir => $f) {
    $p = "app/Filament/Resources/$dir/{$f}Resource.php";
    if (!file_exists($p)) $p = "app/Filament/Resources/{$f}Resource.php";
    if (file_exists($p)) {
        $c = file_get_contents($p);
        $c = preg_replace('/protected static string\|\\\\UnitEnum\|null \$navigationGroup = \'MANAGEMENT\';/', '', $c);
        $c = preg_replace('/protected static \?string \$navigationGroup = \'MANAGEMENT\';/', '', $c);
        if (!str_contains($c, 'public static function getNavigationGroup')) {
            $c = preg_replace('/(protected static \?string \$recordTitleAttribute.*?;)/s', "$1\n\n    public static function getNavigationGroup(): ?string\n    {\n        return 'MANAGEMENT';\n    }", $c);
        }
        file_put_contents($p, $c);
        echo "Updated $f\n";
    }
}
$p = "app/Filament/Widgets/SalesAnalyticsChart.php";
if (file_exists($p)) {
    $c = file_get_contents($p);
    $c = preg_replace('/protected static string\|\\\\UnitEnum\|null \$navigationGroup = \'MANAGEMENT\';/', '', $c);
    if (!str_contains($c, 'public static function getNavigationGroup')) {
        $c = preg_replace('/(protected static \?string \$heading.*?;)/s', "$1\n\n    public static function getNavigationGroup(): ?string\n    {\n        return 'MANAGEMENT';\n    }", $c);
    }
    file_put_contents($p, $c);
    echo "Updated SalesAnalytics\n";
}
