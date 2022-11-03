<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOOctyeFreezeThawTransRecSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OOcyteFreezeThawTransRecSubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('OOcytFreThawTransRecsId')->unsigned();
            $table->foreign('OOcytFreThawTransRecsId')->references('id')->on('OOcyteFreezeThawTransRecs')->onDelete('cascade');
            $table->string('StrawNo')->nullable(); 
            $table->string('OoctyeNo')->nullable(); 
            $table->string('Maturation')->nullable(); 
            $table->string('StageGrade')->nullable(); 
            $table->integer('IsThawYes')->nullable(); 
            $table->integer('IsThawNo')->nullable(); 
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
        Schema::dropIfExists('OOcyteFreezeThawTransRecSubs');
    }
}
