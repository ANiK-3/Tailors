<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GenderSeeder::class,
            RoleSeeder::class,
            TailorSeeder::class,
            StatusSeeder::class,
        ]);

        // User::factory(30)->create();

    }
}