<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('category_products')->insert([
            [
            'name' => 'Audio'
        ], [
            'name' => 'Gaming'
        ], [
            'name' => 'Fashion'
        ], [
            'name' => 'Wearable'
        ], [
            'name' => 'Aksesori'
        ],
        ]);
    }
}
