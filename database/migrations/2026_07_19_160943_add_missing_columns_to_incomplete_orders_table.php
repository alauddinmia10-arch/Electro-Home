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
        Schema::table('incomplete_orders', function (Blueprint $table) {
            $table->string('customer_alt_phone')->nullable()->after('customer_phone');
            $table->string('district')->nullable()->after('customer_name');
            $table->string('thana')->nullable()->after('district');
            $table->text('full_address')->nullable()->after('thana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incomplete_orders', function (Blueprint $table) {
            $table->dropColumn(['customer_alt_phone', 'district', 'thana', 'full_address']);
        });
    }
};
