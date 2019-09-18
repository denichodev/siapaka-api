<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_medicine', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('procurement_id');
            $table->unsignedInteger('medicine_id');
            $table->integer('qty');
            $table->string('qty_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('procurement_id')->references('id')->on('procurement');
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
        Schema::dropIfExists('procurement_medicine');
    }
}
