<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('FileNo')->nullable();
            $table->string('MainContactNo')->nullable();
            $table->string('MainEmail')->nullable();
            $table->string('MainContactPerson')->nullable();
            $table->string('WifeName')->nullable();
            $table->string('WifeLastName')->nullable();
            $table->date('WifeBirthDate')->nullable();
            $table->date('MarriedSince')->nullable();
            $table->string('WifeAddress')->nullable();
            $table->string('WifeEmailAddress')->nullable();
            $table->string('WifeContactNo')->nullable();
            $table->bigInteger('WifeNationalityId')->nullable();
            $table->string('IsIVF')->nullable();
            $table->string('IsHasChildren')->nullable();
            $table->string('IsMiscarriage')->nullable();
            $table->string('HusbandName')->nullable();
            $table->string('HusbandLastName')->nullable();
            $table->date('HusbandBirthDate')->nullable();
            $table->bigInteger('HusbandNationalityId')->nullable();
            $table->string('HusbandAddress')->nullable();
            $table->string('HusbandEmailAddress')->nullable();
            $table->string('HusbandContactNo')->nullable();
            $table->longText('Notes')->nullable();
            $table->string('FileLink')->nullable();
            $table->string('IsPatient')->nullable();
            $table->integer('createdbyid')->nullable();
            $table->integer('LeadSourceId')->nullable();
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
        Schema::dropIfExists('Patients');
    }
}
