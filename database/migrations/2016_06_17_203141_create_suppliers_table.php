<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('supplierID');
            $table->integer('supplierCategoryID')->nullable()->unsigned()->index();
            $table->foreign('supplierCategoryID')->references('supplierCategoryID')->on('suppliers_category')->onDelete('SET NULL')->onUpdate('No Action');
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('contact', 30)->nullable();
            $table->string('email', 160)->nullable();
            $table->string('social')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
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
        Schema::drop('suppliers');
    }
}
