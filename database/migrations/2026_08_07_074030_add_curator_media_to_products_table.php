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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('cover_image_id')->nullable()->constrained('curator')->nullOnDelete();
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->foreignId('media_id')->nullable()->constrained('curator')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['cover_image_id']);
            $table->dropColumn('cover_image_id');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
            $table->dropColumn('media_id');
        });
    }
};
