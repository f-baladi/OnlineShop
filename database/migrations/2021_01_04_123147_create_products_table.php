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
            $table->foreignId('category_id')->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('english_title')->unique();
            $table->string('slug');
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('special')->default(0);
            $table->integer('order_number')->default(0);
            $table->enum('status',['پیش نویس', 'در انتظار تایید', 'تایید', 'عدم تایید', 'ناموجود']);
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
        Schema::dropIfExists('products');
    }
}
