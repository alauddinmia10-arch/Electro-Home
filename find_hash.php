<?php
$p = '/var/www/html';
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
foreach ($it as $f) {
    if (strpos($f->getPathname(), '.blade.php') !== false) {
        $path = $p . substr(str_replace('\\', '/', $f->getPathname()), 1);
        $hash = sha1($path);
        if ($hash == 'e8ce3d8ff7d732a3d663f43daf821bf3' || $hash == '6bc7d0987afad9c4105ebd8bf3d9f45b') {
            echo "MATCH: $path => $hash\n";
        }
    }
}
// Also try checking vendor views
$paths = [
    '/var/www/html/vendor/filament/filament/resources/views',
    '/var/www/html/vendor/filament/support/resources/views',
    '/var/www/html/vendor/filament/tables/resources/views',
    '/var/www/html/vendor/filament/forms/resources/views',
    '/var/www/html/vendor/livewire/livewire/src/Features/SupportPageComponents/views',
];
// Just simple search in vendor if possible
