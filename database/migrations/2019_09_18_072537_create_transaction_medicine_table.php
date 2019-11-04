<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_medicine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->unsignedInteger('medicine_id');
            $table->integer('qty');
            $table->string('instructions')->nullable()->default('');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_id')->references('id')->on('transaction');
            $table->foreign('medicine_id')->references('id')->on('medicine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_medicine');
    }
}
