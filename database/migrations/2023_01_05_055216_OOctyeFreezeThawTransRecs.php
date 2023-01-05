<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OOctyeFreezeThawTransRecs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('OOcyteFreezeThawTransRecs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();

            $table->time('TransferTime')->nullable();
            $table->string('NoOfEmbTrans')->nullable();
            $table->string('NoOfAttempts')->nullable();
            $table->integer('IsAHYes')->nullable();
            $table->integer('IsAHNo')->nullable();
            $table->string('CathLoading')->nullable();
            $table->bigInteger('PhysicianStaffId')->nullable();
            $table->bigInteger('EmbryologistStaffId')->nullable();
            $table->bigInteger('NurseStaffId')->nullable();

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
        Schema::dropIfExists('OOcyteFreezeThawTransRecs');
    }
}
