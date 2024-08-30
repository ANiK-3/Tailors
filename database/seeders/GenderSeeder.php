<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender;
use App\Models\User;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = ['male', 'female', 'other'];

        foreach ($genders as $gender) {
            Gender::create(['name' => $gender]);
        }

        $usersWithGender = [
            1 => 1,
            2 => 1,
            3 => 2,
        ];

        foreach ($usersWithGender as $userId => $genderId) {
            $user = User::find($userId);
            $user->update([
                'gender_id' => $genderId,
            ]);
        }
    }
}
