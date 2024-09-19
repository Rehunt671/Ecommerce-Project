<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_category')->insert([
            ['name' => 'Electronics'],
            ['name' => 'Books'],
            ['name' => 'Clothing'],
        ]);
    }
}
