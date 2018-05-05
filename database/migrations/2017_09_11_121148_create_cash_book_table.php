<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_book', function (Blueprint $table) {
            $table->increments('cashBookID');
            $table->double('amountDeposit', 15, 2)->default(0);
            $table->double('amountWithdraw', 15, 2)->default(0);
            $table->text('paymentDescription')->nullable();
            $table->string('paymentType',15)->nullable()->default('Debit');
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
        Schema::dropIfExists('cash_book');
    }
}
