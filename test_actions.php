<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$classes = [
    'Filament\Tables\Actions\Action',
    'Filament\Tables\Actions\ViewAction',
    'Filament\Tables\Actions\EditAction',
];
foreach($classes as $c) {
    echo $c . ": " . (class_exists($c) ? (new ReflectionClass($c))->getFileName() : 'NOT FOUND') . PHP_EOL;
}
