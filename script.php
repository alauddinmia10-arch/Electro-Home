<?php
$path = 'app/Filament/Resources/IncompleteOrders/Pages/ManageIncompleteOrders.php';
$content = file_get_contents($path);
if (!str_contains($content, 'unreadNotifications')) {
    $mountCode = "    public function mount(): void\n    {\n        parent::mount();\n        if (auth()->check()) {\n            auth()->user()->unreadNotifications()->where('data', 'like', '%\"title\":\"New Incomplete Order\"%')->update(['read_at' => now()]);\n        }\n    }\n";
    $content = preg_replace('/(class [a-zA-Z0-9_]+ extends ManageRecords\s*\{)/', "\n" . $mountCode, $content);
    file_put_contents($path, $content);
    echo "Updated Page $path\n";
}
