<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('curator')
            ->where('disk', 'public')
            ->update(['disk' => 'cloudinary']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('curator')
            ->where('disk', 'cloudinary')
            ->update(['disk' => 'public']);
    }
};
