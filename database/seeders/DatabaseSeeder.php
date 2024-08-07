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
            CustomerSeeder::class,
            TailorSeeder::class,
            TailorTypeSeeder::class,
            StatusSeeder::class,
        ]);

        // User::factory(12)->create();
    }
}
