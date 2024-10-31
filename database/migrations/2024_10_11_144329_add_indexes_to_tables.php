<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('category'); 
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->index('user_id'); 
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->index('user_id'); 
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->index('product_id'); 
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->index('order_id');
        });

        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->index('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category']); 
        });
    
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropIndex(['user_id']); 
        });
    
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropIndex(['user_id']); 
        });
    
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropIndex(['product_id']); 
        });
    
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id']);
        });
    
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->dropIndex(['token']);
        });

    }
    
}
