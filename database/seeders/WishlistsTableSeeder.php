<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('wishlists')->insert([
            ['user_id' => 1, 'product_id' => 1],
            ['user_id' => 2, 'product_id' => 2],
        ]);
    }
}
