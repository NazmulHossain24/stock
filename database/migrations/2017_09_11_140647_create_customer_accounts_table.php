<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->increments('customerAccountsID');
            $table->integer('customerID')->nullable()->unsigned()->index();
            $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amount_add', 15, 2)->default(0);
			$table->double('amount_remove', 15, 2)->default(0);
            $table->string('type',10)->nullable()->default('Buy');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('customer_accounts');
    }
}
