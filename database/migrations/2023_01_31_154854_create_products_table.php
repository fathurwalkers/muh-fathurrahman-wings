<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();

            $table->string('product_code', 18)->nullable();
            $table->string('product_name', 30)->nullable();
            $table->integer('price')->nullable()->unsigned();
            $table->string('currency', 5)->nullable();
            $table->integer('discount')->nullable()->unsigned();
            $table->string('dimension', 50)->nullable();
            $table->string('unit', 5)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product');
    }
}
