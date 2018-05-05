<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_receipt', function (Blueprint $table) {
            $table->increments('receiptID');
            $table->integer('supplierID')->nullable()->unsigned()->index();
            $table->foreign('supplierID')->references('supplierID')->on('suppliers')->onDelete('No Action')->onUpdate('No Action');
            $table->string('status', 30)->nullable()->default('Complete');//payment status
            $table->float('otherCost', 8, 2)->nullable()->default(0);
            $table->string('note')->nullable();
            $table->boolean('checkOut')->nullable()->default(0); //0 = checkout & 1=not checkout like order
            $table->date('checkOutDate')->nullable();
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
        Schema::drop('purchase_receipt');
    }
}
