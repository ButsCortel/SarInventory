<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('note')->nullable();
            $table->enum('action', ['CREATE', 'UPDATE', 'DELETE', 'RESTOCK', 'SOLD']);
            $table->unsignedBigInteger('previous_stock');
            $table->unsignedBigInteger('stock');
            $table->foreignId('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
