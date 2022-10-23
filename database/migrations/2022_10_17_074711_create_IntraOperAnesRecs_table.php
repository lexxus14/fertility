<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntraOperAnesRecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IntraOperAnesRecs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('BP')->nullable();
            $table->string('PulseRate')->nullable(); 
            $table->string('RR')->nullable(); 
            $table->string('Temperature')->nullable(); 
            $table->string('Allergy')->nullable(); 
            $table->string('IntraOperativeDiags')->nullable(); 
            $table->string('SurgeryName')->nullable(); 
            $table->bigInteger('SurgeonStaffId')->nullable(); 
            $table->bigInteger('AsstSurgeonStaffId')->nullable(); 
            $table->bigInteger('AnesthetistStaffId')->nullable(); 
            $table->string('TypeOfAnesthesia')->nullable(); 
            $table->time('AnesthesiaStartTime')->nullable(); 
            $table->time('AnesthesiaEndTime')->nullable(); 
            $table->time('SurgeryStartTime')->nullable(); 
            $table->time('SurgeryEndTime')->nullable(); 
            $table->longText('IntOpeAneRecord')->nullable();
            $table->string('Notes')->nullable(); 
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
        Schema::dropIfExists('IntraOperAnesRecs');
    }
}
