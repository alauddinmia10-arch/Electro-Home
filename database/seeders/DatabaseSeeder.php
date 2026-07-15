<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DistrictSeeder::class,
            SettingsSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
