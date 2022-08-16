<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStimulatingMedicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StiMeds', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('StimulatingPhasesId');
            $table->date('docdate');
            $table->string('Notes')->nullable();
            $table->string('filelink')->nullable();
            $table->integer('createdbyid')->nullable();
            $table->bigInteger('MedIdAM')->nullable();
            $table->bigInteger('UnitIdAM')->nullable();
            $table->bigInteger('MedIdPM')->nullable();
            $table->bigInteger('UnitIdPM')->nullable();
            $table->string('MedDoseAM')->nullable();
            $table->string('MedDosePM')->nullable();
            $table->date('StimulatingDate')->nullable();
            $table->string('Breakfast')->nullable();
            $table->string('Lunch')->nullable();
            $table->string('Dinner')->nullable();
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
        Schema::dropIfExists('StiMeds');
    }
}
