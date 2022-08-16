<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientdoctorslabsubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientdoctorslabssubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientdoctorlabId');
            $table->biginteger('labTestId')->nullable();
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
        Schema::dropIfExists('patientdoctorslabssubs');
    }
}
