<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_invoice', function (Blueprint $table) {
            $table->increments('invoiceID');
            $table->integer('customerID')->nullable()->unsigned()->index();
            $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('No Action')->onUpdate('No Action');
            $table->string('status', 30)->nullable()->default('Complete');//payment status
            $table->float('discount', 8, 2)->nullable()->default(0);
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
        Schema::drop('sell_invoice');
    }
}
