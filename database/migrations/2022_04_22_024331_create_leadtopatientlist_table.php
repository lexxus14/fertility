<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadtopatientlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LeadToPatientList', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('PatientId');
            $table->bigInteger('IsLeadInPatient');
            $table->date('DateInPatient'); 
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
        Schema::dropIfExists('LeadToPatientList');
    }
}
