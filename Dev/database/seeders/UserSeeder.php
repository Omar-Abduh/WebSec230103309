<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@websec.dev',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => null,
            
        ])->assignRole('Admin');

        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@websec.dev',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => null,
        ])->assignRole('Employee');

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@websec.dev',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => null,
        ])->assignRole('Customer');

    }
}
