<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOperativeChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreOperaChecklists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->bigInteger('GivenByStaffid');
            $table->string('filelink')->nullable();
            $table->string('PreoperativeInstruction')->nullable();
            $table->date('PreOperaDate')->nullable();
            $table->time('PreOperaTime')->nullable();
            $table->date('PSurgeryDate')->nullable();
            $table->time('SurgeryTime')->nullable();
            $table->time('ArrivalTime')->nullable();
            $table->string('NPOInstruction')->nullable();
            $table->integer('IsNoJewelry')->nullable();
            $table->integer('IsNoMakeup')->nullable();
            $table->integer('IsNoNailPolish')->nullable();
            $table->longText('Others')->nullable();
            $table->string('NpoStatus')->nullable();
            $table->string('Allergy')->nullable();
            $table->string('HisAndPhy')->nullable();
            $table->string('InfoConforSur')->nullable();
            $table->string('AnesCons')->nullable();
            $table->string('LabReport')->nullable();
            $table->string('PreOpMed')->nullable();
            $table->string('VoidedFreely')->nullable();
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
        Schema::dropIfExists('PreOperaChecklists');
    }
}
