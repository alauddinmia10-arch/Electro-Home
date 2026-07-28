<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$col = Filament\Tables\Columns\ImageColumn::make('cover_image');
$record = App\Models\Product::find(3);
$col->record($record);
echo $col->getImageUrl('products/01KY5ENJAXGDB71ES8HTZ0A0AG.jpg');
