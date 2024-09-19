<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('carts')->insert([
            ['user_id' => 1, 'total_price' => 0.00],
            ['user_id' => 2, 'total_price' => 0.00],
        ]);
    }
}
