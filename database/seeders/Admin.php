<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nama_user' => 'Adli',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
        ]);
    }
}
