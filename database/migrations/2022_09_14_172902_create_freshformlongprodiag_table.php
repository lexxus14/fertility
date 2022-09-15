<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformlongprodiagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormLongProDiags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('FreshFormLongProsiD')->unsigned();
            $table->foreign('FreshFormLongProsiD')->references('id')->on('FreshFormLongPros')->onDelete('cascade');
            $table->bigInteger('FertilityDiagnosisId')->unsigned();
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
        Schema::dropIfExists('FreshFormLongProDiags');
    }
}
