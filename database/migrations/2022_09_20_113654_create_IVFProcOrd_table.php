<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIVFProcOrdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IVFProcOrds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('IVFRequisistionFormsId')->unsigned();
            $table->foreign('IVFRequisistionFormsId')->references('id')->on('IVFRequisistionForms')->onDelete('cascade');
            $table->bigInteger('ProcedureId')->nullable();          
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
        Schema::dropIfExists('IVFProcOrds');
    }
}
