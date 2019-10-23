<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnverifiedMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unverified_medicine', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('procurement_id');
            $table->string('meds_type_id');
            $table->string('meds_category_id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->string('factory');
            $table->integer('min_stock');
            $table->integer('qty');
            $table->string('qty_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('procurement_id')->references('id')->on('procurement');
            $table->foreign('meds_type_id')->references('id')->on('meds_type');
            $table->foreign('meds_category_id')->references('id')->on('meds_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unverified_medicine');
    }
}
