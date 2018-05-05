<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePurchaseTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->increments('purchaseTransactionID');
            $table->integer('receiptID')->nullable()->unsigned()->index();
            $table->foreign('receiptID')->references('receiptID')->on('purchase_receipt')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amount', 15, 2)->nullable()->default(0);
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
        Schema::dropIfExists('purchase_transactions');
    }
}
