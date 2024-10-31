<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('category')->constrained('product_categories');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('status');
            $table->string('image_name')->nullable();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('information')->nullable();
            $table->string('image_name')->nullable();
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('image_name')->nullable();
            $table->rememberToken();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->onDelete('cascade');;
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->unique(['user_id', 'product_id']);
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });

        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('promotion_type');
            $table->decimal('discount', 5, 2)->nullable();
            $table->integer('buy_x')->nullable();
            $table->integer('get_y')->nullable();
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
            $table->foreignId('product_id')->constrained();
            $table->integer('rating');
            $table->text('review_text')->nullable();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('purchase_date')->useCurrent()->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained(); 
            $table->integer('quantity_sold');
            $table->decimal('price_per_item', 10, 2); 
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners'); // Drop before products
        Schema::dropIfExists('cart_items'); // Drop before products
        Schema::dropIfExists('wishlists'); // Drop before products
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('products'); 
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
}
