<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('promotions')->insert([
            [
                'product_id' => 1,
                'promotion_type' => 'Discount',
                'discount' => 50.00,
                'buy_x' => null,
                'get_y' => null,
            ],
            [
                'product_id' => 2,
                'promotion_type' => 'Buy X Get Y',
                'discount' => null,
                'buy_x' => 2,
                'get_y' => 1,
            ],
        ]);
    }
}
