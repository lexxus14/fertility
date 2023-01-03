<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticHysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DiagHysDiags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('DiagnosisId')->nullable();;
            $table->bigInteger('DiagnHysId')->unsigned();
            $table->foreign('DiagnHysId')->references('id')->on('DiagnosticyHysteroscopy')->onDelete('cascade');
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
        Schema::dropIfExists('DiagHysDiags');
    }
}
