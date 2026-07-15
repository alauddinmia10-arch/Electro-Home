<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('invoice_number')->unique();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_charge', 8, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('cod'); // cod, online
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, refunded
            $table->string('delivery_status')->default('pending'); // pending, processing, ready_to_ship, shipped, delivered, cancelled, returned
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_alt_phone')->nullable();
            $table->string('district');
            $table->string('thana');
            $table->text('full_address');
            $table->text('order_note')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('tracking_id')->nullable();
            $table->foreignId('assigned_staff_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('transaction_id')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('delivery_status');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
