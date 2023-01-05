<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OOctyeFreezeThawTransRecSubDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OOctyeFreezeThawTransRecSubDetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('OOcFTTRSubId')->unsigned();
            $table->foreign('OOcFTTRSubId')->references('id')->on('OOcyteFreezeThawTransRecSubs')->onDelete('cascade');
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
        Schema::dropIfExists('OOctyeFreezeThawTransRecSubDetails');
    }
}
