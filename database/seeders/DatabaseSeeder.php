<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ProductCategoryTableSeeder::class,
            ProductsTableSeeder::class,
            CartsTableSeeder::class,
            CartItemsTableSeeder::class,
            WishlistsTableSeeder::class,
            PromotionsTableSeeder::class,
            RatingsTableSeeder::class,
            SalesLogTableSeeder::class,
        ]);
    }
}