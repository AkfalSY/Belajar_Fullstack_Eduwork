<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('products')->insert([
                        [
                'name' => 'Headphone Nirkabel ANC Pro',
                'description' => 'Headphone nirkabel dengan active noise cancelling, desain elegan dan modern.',
                'image' => 'https://cdnpro.eraspace.com/media/catalog/product/n/o/nothing_headphone_1_black_1.jpg',
                'price' => 899000,
                'stock' => 40,
                'category_product_id' => 1, // Audio
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Smartwatch Fit Series 5',
                'description' => 'Smartwatch dengan pelacak aktivitas, detak jantung, dan notifikasi.',
                'image' => 'https://placehold.co/600x600?text=Smartwatch',
                'price' => 1149000,
                'stock' => 25,
                'category_product_id' => 4, // Wearable
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Keyboard Mekanikal 60% RGB',
                'description' => 'Keyboard mekanikal ringkas 60% dengan lampu RGB dan switch hot-swap.',
                'image' => 'https://placehold.co/600x600?text=Keyboard',
                'price' => 549000,
                'stock' => 60,
                'category_product_id' => 2, // Gaming
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Mouse Gaming Ringan 59g',
                'description' => 'Mouse gaming ultra ringan dengan sensor presisi tinggi.',
                'image' => 'https://placehold.co/600x600?text=Mouse',
                'price' => 329000,
                'stock' => 80,
                'category_product_id' => 2, // Gaming
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Speaker Bluetooth Portabel',
                'description' => 'Speaker bluetooth portabel dengan suara jernih dan baterai tahan lama.',
                'image' => 'https://placehold.co/600x600?text=Speaker',
                'price' => 459000,
                'stock' => 35,
                'category_product_id' => 1, // Audio
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Tas Ransel Laptop 15 inci',
                'description' => 'Tas ransel dengan kompartemen laptop 15 inci, ringan dan tahan air.',
                'image' => 'https://placehold.co/600x600?text=Tas+Ransel',
                'price' => 279000,
                'stock' => 50,
                'category_product_id' => 3, // Fashion
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Earbuds TWS Mini',
                'description' => 'Earbuds nirkabel mungil dengan case pengisi daya.',
                'image' => 'https://placehold.co/600x600?text=Earbuds',
                'price' => 249000,
                'stock' => 100,
                'category_product_id' => 1, // Audio
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Power Bank 20.000 mAh',
                'description' => 'Power bank kapasitas besar dengan dukungan pengisian cepat.',
                'image' => 'https://placehold.co/600x600?text=Power+Bank',
                'price' => 319000,
                'stock' => 45,
                'category_product_id' => 5, // Aksesori
                'created_at' => $now, 'updated_at' => $now,
            ],

        ]);
    }
}
