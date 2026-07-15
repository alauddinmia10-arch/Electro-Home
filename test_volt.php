<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$alias = 'auth.login';
$component = app(\Livewire\Volt\ComponentManager::class)->resolve($alias);
print_r($component);
