<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOperaChkLstProc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreOperaChkLstProcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PreOperaChecklistsId')->unsigned();
            $table->foreign('PreOperaChecklistsId')->references('id')->on('PreOperaChecklists')->onDelete('cascade');
            $table->bigInteger('ProcedureId')->unsigned();
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
        Schema::dropIfExists('PreOperaChkLstProcs');
    }
}
