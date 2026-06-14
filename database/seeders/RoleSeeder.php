<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create minimal 2 roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolePegawai = Role::firstOrCreate(['name' => 'pegawai']);

        // Create an admin user if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'), // password
            ]
        );
        $admin->assignRole($roleAdmin);

        // Create a pegawai user if not exists
        $pegawai = User::firstOrCreate(
            ['email' => 'pegawai@pegawai.com'],
            [
                'name' => 'Pegawai Biasa',
                'password' => bcrypt('password'), // password
            ]
        );
        $pegawai->assignRole($rolePegawai);
    }
}
