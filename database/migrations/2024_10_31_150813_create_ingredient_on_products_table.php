<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientOnProductsTable extends Migration
{
    public function up()
    {
        Schema::create('ingredient_on_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->string('quantity');
            $table->string('unit')->nullable(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredient_on_products');
    }
}
