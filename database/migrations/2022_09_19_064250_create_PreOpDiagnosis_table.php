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
            $table->bigInteger('PostOpPostNotesiD')->unsigned();
            $table->foreign('PostOpPostNotesiD')->references('id')->on('PostOpPostNotes')->onDelete('cascade');
            $table->bigInteger('DiagnosisId')->unsigned();
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
