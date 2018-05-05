<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_transactions', function (Blueprint $table) {
            $table->increments('sellTransactionID');
            $table->integer('invoiceID')->nullable()->unsigned()->index();
            $table->foreign('invoiceID')->references('invoiceID')->on('sell_invoice')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amount', 15, 2)->default(0);
            $table->string('paymentType', 30)->nullable()->default('Cash');
            $table->string('chequeNumber', 30)->nullable();
            $table->string('bankName')->nullable();
            $table->date('issueDate')->nullable();
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
        Schema::dropIfExists('sell_transaction');
    }
}
