<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        foreach ($users as $user) {
            $roles = $user->roles()->pluck('role');
            if ($roles->contains('Customer')) {
                Customer::create([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
