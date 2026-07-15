<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomplete_orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_phone')->nullable();
            $table->string('customer_name')->nullable();
            $table->json('cart_data')->nullable();
            $table->string('last_active_step')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamps();

            $table->index('customer_phone');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomplete_orders');
    }
};
