<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ratings')->insert([
            [
                'user_id' => 1,
                'product_id' => 1,
                'rating' => 5,
                'review_text' => 'Excellent product!',
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'rating' => 4,
                'review_text' => 'Very good book.',
            ],
        ]);
    }
}
