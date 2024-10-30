<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed banners table
        DB::table('banners')->insert([
            'name' => 'About Us',
            'infomation' => 'Information about the company or organization.',
            'image_name' => 'about_us_banner.jpg',
        ]);

        // Seed users table
        DB::table('users')->insert([
            [
                'name' => 'Alice Smith',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
                'image_name' => 'ceo.jpg',
                'phone' => '123-456-7890',
                'location' => 'San Francisco, USA',
                'role' => 'admin', // Add role field
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
                'image_name' => 'bob_image.jpg',
                'phone' => '987-654-3210',
                'location' => 'Chicago, USA',
                'role' => 'user', // Add role field
            ],
        ]);


        // Seed product_categories table
        DB::table('product_categories')->insert([
            ['name' => 'Dog Food'],
            ['name' => 'Cat Food'],
            ['name' => 'Toys'],
            ['name' => 'Grooming Products'],
            ['name' => 'Health Supplies'],
        ]);

        // Seed products table
        DB::table('products')->insert([
            [
                'name' => 'Premium Dog Food',
                'description' => 'High-quality dog food with essential nutrients.',
                'category' => 1,  // Foreign key to 'product_categories'
                'price' => 49.99,
                'stock' => 100,
                'status' => 'available',
                'image_name' => 'dog_food.png',
            ],
            [
                'name' => 'Organic Cat Food',
                'description' => 'Natural ingredients for your feline friends.',
                'category' => 2,  // Foreign key to 'product_categories'
                'price' => 39.99,
                'stock' => 150,
                'status' => 'available',
                'image_name' => 'cat_food.png',
            ],
            [
                'name' => 'Dog Toy - Chew Bone',
                'description' => 'Durable chew bone for dogs of all sizes.',
                'category' => 3,  // Foreign key to 'product_categories'
                'price' => 12.99,
                'stock' => 200,
                'status' => 'available',
                'image_name' => 'chew_bone.jpg',
            ],
            [
                'name' => 'Catnip Toy',
                'description' => 'A fun toy infused with catnip for playful cats.',
                'category' => 3,  // Foreign key to 'product_categories'
                'price' => 7.99,
                'stock' => 180,
                'status' => 'available',
                'image_name' => 'catnip_toy.jpg',
            ],
            [
                'name' => 'Dog Shampoo',
                'description' => 'Gentle shampoo for a clean and shiny coat.',
                'category' => 4,  // Foreign key to 'product_categories'
                'price' => 15.99,
                'stock' => 80,
                'status' => 'available',
                'image_name' => 'dog_shampoo.png',
            ],
        ]);

        // Seed cart_items table
        DB::table('cart_items')->insert([
            ['user_id' => 1, 'product_id' => 1, 'quantity' => 1],
            ['user_id' => 1, 'product_id' => 3, 'quantity' => 2],
            ['user_id' => 2, 'product_id' => 2, 'quantity' => 1],
        ]);

        // Seed wishlists table
        DB::table('wishlists')->insert([
            ['user_id' => 1, 'product_id' => 2],
            ['user_id' => 1, 'product_id' => 4],
            ['user_id' => 2, 'product_id' => 3],
        ]);

        // Seed promotions table
        DB::table('promotions')->insert([
            ['product_id' => 1, 'promotion_type' => 'Discount', 'discount' => 5.00, 'buy_x' => null, 'get_y' => null],
            ['product_id' => 2, 'promotion_type' => 'Buy X Get Y', 'discount' => null, 'buy_x' => 2, 'get_y' => 1],
        ]);

        // Seed ratings table
        DB::table('ratings')->insert([
            ['user_id' => 1, 'product_id' => 1, 'rating' => 5, 'review_text' => 'My dog loves this food!'],
            ['user_id' => 2, 'product_id' => 2, 'rating' => 4, 'review_text' => 'Great quality cat food.'],
        ]);

        // Seed orders table
        DB::table('orders')->insert([
            ['user_id' => 1, 'purchase_date' => now()],
            ['user_id' => 1, 'purchase_date' => null],
            ['user_id' => 2, 'purchase_date' => now()],
            ['user_id' => 2, 'purchase_date' => null],
        ]);

        // Seed order_items table
        DB::table('order_items')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity_sold' => 10, 'price_per_item' => 49.99],
            ['order_id' => 2, 'product_id' => 1, 'quantity_sold' => 3, 'price_per_item' => 83.33],
            ['order_id' => 3, 'product_id' => 2, 'quantity_sold' => 5, 'price_per_item' => 39.99],
            ['order_id' => 4, 'product_id' => 2, 'quantity_sold' => 2, 'price_per_item' => 400.00],
        ]);
    }
}
