<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientbookedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PatientBooked', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('patientid');
            $table->bigInteger('staffid');
            $table->bigInteger('bookstatusid');
            $table->date('docdate')->nullable();
            $table->string('bookedtime')->nullable();
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
        Schema::dropIfExists('PatientBooked');
    }
}
