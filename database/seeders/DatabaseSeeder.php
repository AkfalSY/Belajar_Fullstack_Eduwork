<?php

namespace Database\Seeders;

use App\Models\User;
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
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'test123',
        ]);
    }
}
