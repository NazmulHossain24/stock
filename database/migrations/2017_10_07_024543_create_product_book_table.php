<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_book', function (Blueprint $table) {
            $table->increments('productBookID');
            $table->integer('productID')->nullable()->unsigned()->index();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('SET NULL')->onUpdate('No Action');
            $table->integer('qtyIn')->nullable()->default(0);
            $table->integer('qtyOut')->nullable()->default(0);
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('No Action')->onUpdate('No Action');
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
        Schema::dropIfExists('product_book');
    }
}
