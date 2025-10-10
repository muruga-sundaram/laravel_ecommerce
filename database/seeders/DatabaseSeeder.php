<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Call other seeders here if needed
        // $this->call(UserSeeder::class);
            $this->call([
                UserSeeder::class,
                CategorySeeder::class,
            ]);

    }
}
