<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('prices')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('price');
            $table->integer('product_number');
            $table->integer('max_number_order');
            $table->integer('Number_product_sales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('old_prices');
    }
}
