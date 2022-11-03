<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOOctyeFreezeThawTransRecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OOcyteFreezeThawTransRecs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();

            $table->date('FreezingDate')->nullable();
            $table->time('FreezingTime')->nullable();
            $table->string('FreezingLocation')->nullable();
            $table->bigInteger('FreezingEmbStaffId')->nullable();

            $table->date('ThawingDate')->nullable();
            $table->time('ThawingTime')->nullable();
            $table->string('ThawingLocation')->nullable();
            $table->bigInteger('ThawingEmbStaffId')->nullable();

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
