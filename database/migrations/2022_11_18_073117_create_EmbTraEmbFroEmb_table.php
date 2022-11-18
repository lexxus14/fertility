<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbTraEmbFroEmbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EmbTraEmbFroEmbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();
            $table->string('FrozenEmb')->nullable();
            $table->date('FrozenDate')->nullable();
            $table->string('ThaEmby')->nullable();
            $table->date('EmbyDate')->nullable();
            $table->string('EmbyRem')->nullable();
            $table->string('EmbyTran')->nullable();
            $table->date('TranDate')->nullable();
            $table->integer('IsAssHatchYes')->nullable();
            $table->integer('IsAssHatchNo')->nullable();
            $table->string('PatientInit')->nullable();
            $table->string('ET3')->nullable();
            $table->string('ET5')->nullable();
            $table->bigInteger('EmbryologistStaffId')->nullable();
            $table->bigInteger('MDStaffId')->nullable();
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
        Schema::dropIfExists('EmbTraEmbFroEmbs');
    }
}
