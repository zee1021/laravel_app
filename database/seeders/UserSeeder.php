<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@tradeloop.test'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // 2. Create Sellers
        User::firstOrCreate(
            ['email' => 'seller1@test.com'],
            ['name' => 'John Doe', 'password' => Hash::make('password'), 'is_admin' => false]
        );

        User::firstOrCreate(
            ['email' => 'seller2@test.com'],
            ['name' => 'Jane Smith', 'password' => Hash::make('password'), 'is_admin' => false]
        );
    }
}