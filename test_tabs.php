<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$classes = [
    'Filament\Resources\Components\Tab',
    'Filament\Resources\Components\Tabs\Tab',
    'Filament\Resources\Pages\ListRecords\Tab',
    'Filament\Schemas\Components\Tabs\Tab',
];
foreach($classes as $c) {
    echo $c . ": " . (class_exists($c) ? (new ReflectionClass($c))->getFileName() : 'NOT FOUND') . PHP_EOL;
}
