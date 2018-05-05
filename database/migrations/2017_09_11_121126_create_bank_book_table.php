<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_book', function (Blueprint $table) {
            $table->increments('bankBookID');
			$table->integer('bankID')->nullable()->unsigned()->index();
            $table->foreign('bankID')->references('bankID')->on('banks')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amountDeposit', 15, 2)->nullable()->default(0);
            $table->double('amountWithdraw', 15, 2)->nullable()->default(0);
            $table->string('paymentDescription')->nullable();
            $table->string('paymentType',15)->nullable()->default('Debit');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('No Action');
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
        Schema::dropIfExists('bank_book');
    }
}
