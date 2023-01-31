<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionheadersTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_header', function (Blueprint $table) {
            $table->id();

            $table->string('document_code', 3)->nullable();
            $table->string('document_number', 10)->nullable();
            $table->string('total', 10)->nullable();
            $table->dateTime('date')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('login')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_header');
    }
}
