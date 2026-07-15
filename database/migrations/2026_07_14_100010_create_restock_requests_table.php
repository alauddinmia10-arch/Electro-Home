<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restock_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('contact'); // phone or email
            $table->boolean('notified')->default(false);
            $table->timestamps();

            $table->index('product_id');
            $table->index('notified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restock_requests');
    }
};
