<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user')->references('id')->on('users')->onDelete('cascade');
            $table->longText('checkouts');
            $table->unsignedDecimal('total', 10, 2);
            $table->unsignedDecimal('payment', 10, 2);
            $table->unsignedDecimal('change', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
