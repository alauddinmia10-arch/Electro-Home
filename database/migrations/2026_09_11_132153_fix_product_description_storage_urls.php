<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $cloudName = config('filesystems.disks.cloudinary.cloud_name') ?? env('CLOUDINARY_CLOUD_NAME', 'cwru1emq');
        $cldBase = "https://res.cloudinary.com/{$cloudName}/image/upload/";

        $products = \Illuminate\Support\Facades\DB::table('products')
            ->where('description', 'LIKE', '%storage%')
            ->get();

        foreach ($products as $product) {
            if (!$product->description) {
                continue;
            }

            $updated = preg_replace_callback(
                '#(?:https?://[^/]+)?/storage/([^\s"\'<>]+)#i',
                function ($matches) use ($cldBase) {
                    $filename = $matches[1];
                    if (str_contains($filename, 'res.cloudinary.com')) {
                        return $matches[0];
                    }
                    return $cldBase . $filename;
                },
                $product->description
            );

            if ($updated !== $product->description) {
                \Illuminate\Support\Facades\DB::table('products')
                    ->where('id', $product->id)
                    ->update(['description' => $updated]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // irreversible data migration
    }
};
