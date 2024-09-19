<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Smartphone',
                'description' => 'Latest model smartphone',
                'category' => 1,
                'price' => 699.99,
                'stock' => 50,
                'status' => 'available',
            ],
            [
                'name' => 'Novel Book',
                'description' => 'Bestselling novel',
                'category' => 2,
                'price' => 19.99,
                'stock' => 100,
                'status' => 'available',
            ],
        ]);
    }
}
