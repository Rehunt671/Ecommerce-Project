<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesLogTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sales_log')->insert([
            [
                'product_id' => 1,
                'quantity_sold' => 1,
                'total_price_sold' => 699.99,
                'sale_date' => now(),
            ],
            [
                'product_id' => 2,
                'quantity_sold' => 2,
                'total_price_sold' => 39.98,
                'sale_date' => now(),
            ],
        ]);
    }
}
