<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/users.json');
        $users = collect(json_decode($json));

        $users->each(function ($user) {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'phone' => $user->phone,
                'address' => $user->address,
                'email_verified_at' => $user->email_verified_at
            ]);
        });
    }
}
