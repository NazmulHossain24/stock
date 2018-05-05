<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempBuysellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempbuysell', function (Blueprint $table) {
            $table->increments('tempID');
            $table->integer('productID')->nullable()->unsigned()->index();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('quantity')->nullable()->default(1);
            $table->float('buyPrice', 8, 2)->nullable()->default(0);
            $table->float('sellPrice', 8, 2)->nullable()->default(0);
            $table->float('discount', 8, 2)->nullable()->default(0);
            $table->float('mainPrice', 8, 2)->nullable()->default(0);
            $table->float('otherCost', 8, 2)->nullable()->default(0);
            $table->string('refType', 30)->nullable()->default('Sell');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade')->onUpdate('No Action');
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
        Schema::drop('tempbuysell');
    }
}
