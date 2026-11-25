<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoryProductSeeder::class, // induk dulu
            ProductSeeder::class,         // baru anak (punya foreign key)
            ContohSeeder::class,
            UserSeeder::class,
        ]);
    }
}
