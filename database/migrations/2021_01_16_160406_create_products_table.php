<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user')->references('id')->on('users');
            $table->foreignId('last_user')->references('id')->on('users');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedDecimal('price', 10, 2);
            $table->string('code');
            $table->unsignedBigInteger('stock');
            $table->string('thumbnail')->nullable();
            $table->string('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
