<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$product = \App\Models\Product::first();
echo "Slug: " . ($product ? $product->slug : 'None') . PHP_EOL;
