<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOOctyeRetReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OOcyteRetReports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->double('TotalNumberOfEggs')->nullable();
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
        Schema::dropIfExists('OOcyteRetReports');
    }
}
