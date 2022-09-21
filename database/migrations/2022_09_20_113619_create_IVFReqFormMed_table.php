<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIVFReqFormMedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IVFReqFormMeds', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('IVFRequisistionFormsId')->unsigned();
            $table->foreign('IVFRequisistionFormsId')->references('id')->on('IVFRequisistionForms')->onDelete('cascade');
            $table->bigInteger('MedId')->nullable();           
            $table->string('MedDosage')->nullable();
            $table->bigInteger('MedUnitId')->nullable();
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
        Schema::dropIfExists('IVFReqFormMeds');
    }
}
