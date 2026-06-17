<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'System',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'first_name' => 'Manager',
                'last_name' => 'User',
                'email' => 'manager@example.com',
                'password' => Hash::make('password123'),
                'role' => 'manager',
            ],
            [
                'first_name' => 'Staff',
                'last_name' => 'User',
                'email' => 'staff@example.com',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ],
            [
                'first_name' => 'Pegawai',
                'last_name' => 'User',  // <-- TAMBAHKAN INI
                'email' => 'pegawai@example.com',
                'password' => Hash::make('password123'),
                'role' => 'pegawai',
            ],
            [
                'first_name' => 'Kurir',
                'last_name' => 'User',
                'email' => 'kurir@example.com',
                'password' => Hash::make('password123'),
                'role' => 'kurir',
            ],
            [
                'first_name' => 'Client',
                'last_name' => 'User',
                'email' => 'client@example.com',
                'password' => Hash::make('password123'),
                'role' => 'client',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}