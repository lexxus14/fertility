<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIVFEmbryoTransDataSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IVFEmbryoTransDataSheet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->longText('Notes')->nullable();
            $table->string('EggsRetrieved')->nullable();
            $table->date('EggsRetrievedDate')->nullable();
            $table->string('EggsFertilized')->nullable();
            $table->date('EggsFertilizedDate')->nullable();
            $table->string('EmbryosTransd')->nullable();
            $table->date('EmbryosTransdDate')->nullable();
            $table->integer('IsDay3')->nullable();
            $table->integer('IsDay5')->nullable();
            $table->string('EmbryosDis')->nullable();
            $table->integer('IsICSI')->nullable();
            $table->string('ICSIPatientInitials')->nullable();
            $table->integer('IsAssistedHatch')->nullable();
            $table->string('AssistedHatchPatientInitials')->nullable();
            $table->date('EmbryosTransDate')->nullable();
            $table->integer('IsVerifiedCorrectName')->nullable();
            $table->string('VerifiedCorrectNamePatientInitials')->nullable();
            $table->bigInteger('NurseStaffId')->nullable();
            $table->bigInteger('EmbryologistStaffId')->nullable();
            $table->bigInteger('MDStaffId')->nullable();
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
        Schema::dropIfExists('IVFEmbryoTransDataSheet');
    }
}
