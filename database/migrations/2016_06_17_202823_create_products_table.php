<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('productID');
            $table->string('name');
            $table->string('type', 10)->nullable()->default('Tiles');
            $table->string('grade', 1)->nullable()->default('N');
            $table->string('description')->nullable();
            $table->float('defaultSellPrice', 8, 2)->default(0)->nullable();
            $table->float('defaultBuyPrice', 8, 2)->default(0)->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->integer('inOrder')->nullable()->default(0);
            $table->integer('productCategoryID')->nullable()->unsigned()->index();
            $table->foreign('productCategoryID')->references('productCategoryID')->on('product_category')->onDelete('SET NULL')->onUpdate('No Action');
            $table->integer('productSizeID')->nullable()->unsigned()->index();
            $table->foreign('productSizeID')->references('productSizeID')->on('product_size')->onDelete('SET NULL')->onUpdate('No Action');
            $table->integer('productBrandID')->nullable()->unsigned()->index();
            $table->foreign('productBrandID')->references('productBrandID')->on('product_brand')->onDelete('SET NULL')->onUpdate('No Action');
            $table->string('unit',16)->nullable();
            $table->unique(array('name', 'type', 'grade', 'productCategoryID', 'productSizeID', 'productBrandID'), 'unique_products');
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
        Schema::drop('products');
    }
}
