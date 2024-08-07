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
        $roles = ['admin', 'customer', 'tailor'];

        foreach ($roles as $role) {
            Role::create(['role' => $role]);
        }

        $usersWithRoles = [
            1 => 1,
            2 => 3,
            3 => 2,
        ];

        foreach ($usersWithRoles as $userId => $roleIds) {
            $user = User::find($userId);
            $user->roles()->attach($roleIds);
        }

        // Attach Tailor Roles to fake users
        $length = User::get()->count();
        if ($length > 3) {
            for ($i = 4; $i <= $length; $i++) {
                $user = User::find($i);
                $user->roles()->attach(3);
            }
        }
    }
}
