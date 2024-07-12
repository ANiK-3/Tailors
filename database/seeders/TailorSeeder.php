<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tailor;

class TailorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        foreach ($users as $user) {
            $roles = $user->roles()->pluck('role');
            if ($roles->contains('Tailor')) {
                Tailor::create([
                    'user_id' => $user->id,
                    'shop_name' => $user->name . " Tailors",
                    'bio' => 'I am an experienced tailor with over 15 years of expertise in crafting high-quality men\'s suits.',
                    'specialty' => 'Men\'s Suits',
                ]);
            }
        }
    }
}
