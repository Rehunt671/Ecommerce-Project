<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed users
        DB::table('users')->insert([
            [
                'name' => 'Alice Smith',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
                'image_name' => 'dog_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
                'image_name' => 'dog_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed product_categories
        DB::table('product_categories')->insert([
            ['name' => 'Dog Food'],
            ['name' => 'Cat Food'],
            ['name' => 'Toys'],
            ['name' => 'Grooming Products'],
            ['name' => 'Health Supplies'],
        ]);

        // Seed products
        DB::table('products')->insert([
            [
                'name' => 'Premium Dog Food',
                'description' => 'High-quality dog food with essential nutrients.',
                'category' => 1,
                'price' => 49.99,
                'stock' => 100,
                'status' => 'available',
                'image_name' => 'dog_food.png',
                'created_at' => now(),
            ],
            [
                'name' => 'Organic Cat Food',
                'description' => 'Natural ingredients for your feline friends.',
                'category' => 2,
                'price' => 39.99,
                'stock' => 150,
                'status' => 'available',
                'image_name' => 'dog_food.png',
                'created_at' => now(),
            ],
            [
                'name' => 'Dog Toy - Chew Bone',
                'description' => 'Durable chew bone for dogs of all sizes.',
                'category' => 3,
                'price' => 12.99,
                'stock' => 200,
                'status' => 'available',
                'image_name' => 'dog_food.png',
                'created_at' => now(),
            ],
            [
                'name' => 'Catnip Toy',
                'description' => 'A fun toy infused with catnip for playful cats.',
                'category' => 3,
                'price' => 7.99,
                'stock' => 180,
                'status' => 'available',
                'image_name' => 'dog_food.png',
                'created_at' => now(),
            ],
            [
                'name' => 'Dog Shampoo',
                'description' => 'Gentle shampoo for a clean and shiny coat.',
                'category' => 4,
                'price' => 15.99,
                'stock' => 80,
                'status' => 'available',
                'image_name' => 'dog_food.png',
                'created_at' => now(),
            ],
        ]);

        // Seed carts
        DB::table('carts')->insert([
            ['user_id' => 1, 'total_price' => 0],
            ['user_id' => 2, 'total_price' => 0],
        ]);

        // Seed cart_items
        DB::table('cart_items')->insert([
            ['cart_id' => 1, 'product_id' => 1, 'quantity' => 1, 'item_price' => 49.99],
            ['cart_id' => 1, 'product_id' => 3, 'quantity' => 2, 'item_price' => 12.99],
            ['cart_id' => 2, 'product_id' => 2, 'quantity' => 1, 'item_price' => 39.99],
        ]);

        // Seed wishlists
        DB::table('wishlists')->insert([
            ['user_id' => 1, 'product_id' => 2],
            ['user_id' => 1, 'product_id' => 4],
            ['user_id' => 2, 'product_id' => 3],
        ]);

        // Seed promotions
        DB::table('promotions')->insert([
            ['product_id' => 1, 'promotion_type' => 'Discount', 'discount' => 5.00, 'buy_x' => null, 'get_y' => null],
            ['product_id' => 2, 'promotion_type' => 'Buy X Get Y', 'discount' => null, 'buy_x' => 2, 'get_y' => 1],
        ]);

        // Seed ratings
        DB::table('ratings')->insert([
            ['user_id' => 1, 'product_id' => 1, 'rating' => 5, 'review_text' => 'My dog loves this food!', 'created_at' => now()],
            ['user_id' => 2, 'product_id' => 2, 'rating' => 4, 'review_text' => 'Great quality cat food.', 'created_at' => now()],
        ]);

        // Seed sales_log
        DB::table('sales_log')->insert([
            ['product_id' => 1, 'quantity_sold' => 10, 'total_price_sold' => 499.90, 'sale_date' => now()],
            ['product_id' => 2, 'quantity_sold' => 5, 'total_price_sold' => 199.95, 'sale_date' => now()],
        ]);
    }
}
