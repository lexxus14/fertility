<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnostichysteroscopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DiagnosticyHysteroscopy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();
            $table->date('docdate')->nullable();
            $table->longText('DiagHsyNote')->nullable();
            $table->string('LtOvary')->nullable();
            $table->string('RtOvary')->nullable();
            $table->string('EndoStripe')->nullable();
            $table->string('Fibroids')->nullable();
            $table->string('Polyps')->nullable();
            $table->string('FreeFluid')->nullable();
            $table->string('Hydrosalpinx')->nullable();
            $table->longText('Comments')->nullable();
            $table->integer('IsVFok')->nullable();
            $table->longText('NoWhy')->nullable();
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
        Schema::dropIfExists('DiagnosticyHysteroscopy');
    }
}
