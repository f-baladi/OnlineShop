<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('color_id')->references('id')->on('colors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('price');
            $table->integer('product_number')->nullable();
            $table->integer('max_number_order')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('prices');
    }
}
