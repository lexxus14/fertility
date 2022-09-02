<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformedsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormMedSubs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('FreshFormId')->unsigned();
            $table->foreign('FreshFormId')->references('id')->on('FreshForms')->onDelete('cascade');
            $table->bigInteger('MedId')->nullable();
            $table->string('Dose')->nullable();   
            $table->bigInteger('MedUnitId')->nullable();   
            $table->bigInteger('DayShiftId')->nullable(); 
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
        Schema::dropIfExists('FreshFormMedSubs');
    }
}
