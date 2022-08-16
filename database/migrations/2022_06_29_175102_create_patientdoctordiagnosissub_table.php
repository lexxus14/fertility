<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientdoctordiagnosissubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientdoctordiagnosissub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientdoctordiagnosisId');
            $table->biginteger('doctordiagnosisId')->nullable();
            $table->string('result')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('patientdoctordiagnosissub');
    }
}
