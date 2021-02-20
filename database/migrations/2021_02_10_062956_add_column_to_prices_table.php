<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->smallInteger('showOffers')->default(0);
            $table->smallInteger('offers')->default(0);
            $table->string('offers_first_date')->nullable();
            $table->string('offers_last_date')->nullable();
            $table->integer('offers_first_time')->default(0);
            $table->integer('offers_last_time')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            //
        });
    }
}
