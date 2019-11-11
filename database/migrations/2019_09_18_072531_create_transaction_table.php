<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->unsignedInteger('staff_id');
            $table->string('customer_id');
            $table->unsignedInteger('doctor_id')->nullable();
            $table->dateTime('date');
            $table->boolean('taken')->default(false);
            $table->decimal('subtotal', 8, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('pay_amt', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('staff_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('doctor_id')->references('id')->on('doctor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
