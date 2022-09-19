<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOpProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreOpProcedures', function (Blueprint $table) {
            $table->bigInteger('PostOpPostNotesiD')->unsigned();
            $table->foreign('PostOpPostNotesiD')->references('id')->on('PostOpPostNotes')->onDelete('cascade');
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
        Schema::dropIfExists('PreOpProcedures');
    }
}
