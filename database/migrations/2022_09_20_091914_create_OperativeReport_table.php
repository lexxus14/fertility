<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperativeReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OperativeReports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();
            $table->date('docdate')->nullable();
            $table->string('PreOpDiagnosis')->nullable();
            $table->string('PostOpDiagnosis')->nullable();
            $table->string('Procedure')->nullable();
            $table->string('SurgeonId')->nullable();
            $table->longText('OperativeNote')->nullable();
            $table->string('Anesthesia')->nullable();
            $table->string('NumOfOocytes')->nullable();
            $table->string('RetrievalTime')->nullable();
            $table->longText('AddNotes')->nullable();
            $table->longText('Complication')->nullable();
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
        Schema::dropIfExists('OperativeReports');
    }
}
