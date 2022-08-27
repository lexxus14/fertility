<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFetpage2diagnosissubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FETPage2DiagnosisSubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('FETPage2sId')->unsigned();
            $table->foreign('FETPage2sId')->references('id')->on('FETPage2s')->onDelete('cascade');
            $table->bigInteger('DiagnosisID');
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
        Schema::dropIfExists('FETPage2DiagnosisSubs');
    }
}
