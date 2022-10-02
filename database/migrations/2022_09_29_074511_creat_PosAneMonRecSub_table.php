<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatPosAneMonRecSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PosAneMonRecSub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PostAnesthesiaRecsId')->unsigned();
            $table->foreign('PostAnesthesiaRecsId')->references('id')->on('PostAnesthesiaRecs')->onDelete('cascade');
            $table->time('MonRecSubdoctime')->nullable();   
            $table->string('BP')->nullable();   
            $table->string('PulseRate')->nullable();   
            $table->string('Sp02')->nullable();   
            $table->string('Fi02')->nullable();   
            $table->string('PainScore')->nullable();   
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
        Schema::dropIfExists('PosAneMonRecSub');
    }
}
