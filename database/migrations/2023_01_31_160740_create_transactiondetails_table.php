<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactiondetailsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id();

            $table->string('document_code', 3)->nullable();
            $table->string('document_number', 10)->nullable();
            $table->string('product_code', 10)->nullable();
            $table->integer('price', 6)->nullable()->unsigned();
            $table->integer('quantity', 6)->nullable()->unsigned();
            $table->string('unit', 5)->nullable();
            $table->integer('sub_total', 10)->nullable()->unsigned();
            $table->string('currency', 5)->nullable();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_detail');
    }
}
