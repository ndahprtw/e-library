<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456),
        ]);
        $admin->assignRole('Admin');


        $petugas = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make(123456),
        ]);
        $petugas->assignRole('Petugas');


        $user = User::create([
            'name' => 'User',
            'email' => 'User@gmail.com',
            'password' => Hash::make(123456),
        ]);
        $user->assignRole('User');
    }
}
