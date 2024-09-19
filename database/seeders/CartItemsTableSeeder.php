<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cart_items')->insert([
            [
                'cart_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'item_price' => 699.99,
            ],
            [
                'cart_id' => 2,
                'product_id' => 2,
                'quantity' => 2,
                'item_price' => 19.99,
            ],
        ]);
    }
}
