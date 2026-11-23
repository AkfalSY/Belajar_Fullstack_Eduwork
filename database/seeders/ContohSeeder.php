<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContohSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contoh')->insert([
            [
            'title'=> "Judul Pertama",
            'description' => "Description pertama menggunakan seeder"
        ],[
            'title'=> "Judul kedua",
            'description' => "Description kedua menggunakan seeder"
        ],[
            'title'=> "Judul ketiga",
            'description' => "Description ketiga menggunakan seeder"
        ]
        ]);
    }
}
