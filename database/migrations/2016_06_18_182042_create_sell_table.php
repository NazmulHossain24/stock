<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell', function (Blueprint $table) {
            $table->increments('sellID');
            $table->integer('invoiceID')->nullable()->unsigned()->index();
            $table->foreign('invoiceID')->references('invoiceID')->on('sell_invoice')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('productID')->nullable()->unsigned()->index();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('SET NULL')->onUpdate('No Action');
            $table->integer('quantity')->nullable()->default(1);
            $table->float('buyPrice', 8, 2)->nullable()->default(0);
            $table->float('unitPrice', 8, 2)->nullable()->default(0);
            $table->float('discount', 8, 2)->nullable()->default(0);
            $table->float('mainPrice', 8, 2)->nullable()->default(0);
            $table->boolean('isReturn')->default(0);
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
        Schema::drop('sell');
    }
}
