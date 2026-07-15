<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // sale, courier_payment, ad_cost, office_expense, other
            $table->decimal('amount', 12, 2);
            $table->string('description')->nullable();
            $table->date('record_date');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('type');
            $table->index('record_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_records');
    }
};
