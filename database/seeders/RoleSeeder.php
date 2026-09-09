<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Super Admin', 'Content Manager', 'Investment Manager', 'Editor'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $demoUsers = [
            ['name' => 'BIG Super Admin', 'email' => 'admin@babilas.test', 'password' => 'AdminPass123!', 'role' => 'Super Admin'],
            ['name' => 'BIG Investment Manager', 'email' => 'investment@babilas.test', 'password' => 'InvestPass123!', 'role' => 'Investment Manager'],
            ['name' => 'BIG Content Manager', 'email' => 'content@babilas.test', 'password' => 'ContentPass123!', 'role' => 'Content Manager'],
            ['name' => 'BIG Editor', 'email' => 'editor@babilas.test', 'password' => 'EditorPass123!', 'role' => 'Editor'],
        ];

        foreach ($demoUsers as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => bcrypt($u['password']), 'email_verified_at' => now()]
            );

            if (! $user->email_verified_at) {
                $user->update(['email_verified_at' => now()]);
            }

            $user->syncRoles([$u['role']]);
        }
    }
}
