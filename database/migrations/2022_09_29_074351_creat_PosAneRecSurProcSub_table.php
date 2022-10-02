<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatPosAneRecSurProcSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PosAneRecSurProcSub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PostAnesthesiaRecsId')->unsigned();
            $table->foreign('PostAnesthesiaRecsId')->references('id')->on('PostAnesthesiaRecs')->onDelete('cascade');
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
        Schema::dropIfExists('PosAneRecSurProcSub');
    }
}
