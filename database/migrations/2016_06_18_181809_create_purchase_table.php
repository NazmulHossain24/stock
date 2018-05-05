<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->increments('purchaseID');
            $table->integer('receiptID')->nullable()->unsigned()->index();
            $table->foreign('receiptID')->references('receiptID')->on('purchase_receipt')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('productID')->nullable()->unsigned()->index();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('SET NULL')->onUpdate('No Action');
            $table->integer('quantity')->nullable()->default(1);
            $table->float('unitPrice', 8, 2)->nullable()->default(0);
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
        Schema::drop('purchase');
    }
}
