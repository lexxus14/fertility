<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientdoctorslabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientdoctorslabs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('patientid');
            $table->date('docdate')->nullable();
            $table->string('docdatetime')->nullable();
            $table->string('description')->nullable();
            $table->string('notes')->nullable();
            $table->string('filelink')->nullable();
            $table->integer('createdbyid')->nullable();
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
        Schema::dropIfExists('patientdoctorslabs');
    }
}
