<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin1password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'role' => 'buyer',
        ]);

        User::create([
            'name' => 'superAdmin',
            'email' => 'superShy@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'role' => 'superAdmin',
        ]);
    }
}
