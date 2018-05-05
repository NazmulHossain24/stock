<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDamageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_damage', function (Blueprint $table) {
            $table->increments('damageID');
            $table->integer('productID')->nullable()->unsigned()->index();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('quantity')->default(1);
            $table->float('buyPrice', 8, 2)->nullable()->default(0);
            $table->string('description')->nullable();
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
        Schema::drop('product_damage');
    }
}
