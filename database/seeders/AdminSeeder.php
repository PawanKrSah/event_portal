<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'University Admin',
            'email' => 'admin@event.com',
            'password' => bcrypt('admin@123'),
            'role' => 'admin',
        ]);
    }
}
