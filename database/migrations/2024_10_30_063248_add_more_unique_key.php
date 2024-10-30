<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->unique('image_name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('image_name');
        });

    }

    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
        
        Schema::table('banners', function (Blueprint $table) {
            $table->dropUnique(['image_name']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['image_name']);
        });
    }
};
