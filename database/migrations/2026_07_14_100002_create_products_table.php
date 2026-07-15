<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->json('specifications')->nullable();
            $table->string('status')->default('in_stock');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_flash_sale')->default(false);
            $table->timestamp('flash_sale_ends_at')->nullable();
            $table->integer('total_sold')->default(0);
            $table->timestamps();

            $table->index('category_id');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_flash_sale');

            // Full-text index only works on MySQL/MariaDB, skip on SQLite
            if (config('database.default') !== 'sqlite') {
                $table->fullText(['name', 'description']);
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
