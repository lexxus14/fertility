<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreAnePreopDiagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreAnePreopDiags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PreAneCheRecsId')->unsigned();
            $table->foreign('PreAneCheRecsId')->references('id')->on('PreAneCheRecs')->onDelete('cascade');
            $table->bigInteger('DiagnosisId')->nullable();   
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
        Schema::dropIfExists('PreAnePreopDiags');
    }
}
