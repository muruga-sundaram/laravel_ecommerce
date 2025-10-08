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
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Already exists check
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ]
        );
    }
}
