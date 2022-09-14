<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformcycleferdiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormCycleFerDias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('FreshFormCyclePage2siD')->unsigned();
            $table->foreign('FreshFormCyclePage2siD')->references('id')->on('FreshFormCyclePage2s')->onDelete('cascade');
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
        Schema::dropIfExists('FreshFormCycleFerDias');
    }
}
