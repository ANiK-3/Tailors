<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role' => 'admin'],
            ['role' => 'customer'],
            ['role' => 'tailor']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $user = User::find(1);
        $user->roles()->attach([1]);
    }
}
