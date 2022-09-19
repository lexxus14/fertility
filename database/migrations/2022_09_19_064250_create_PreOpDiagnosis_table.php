<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOpDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreOpDiagnosis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PostOpPostProcNotesId')->unsigned();
            $table->foreign('PostOpPostProcNotesId')->references('id')->on('PostOpPostProcNotes')->onDelete('cascade');
            $table->bigInteger('PreDiagnosisId')->unsigned();
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
        Schema::dropIfExists('PreOpDiagnosis');
    }
}
