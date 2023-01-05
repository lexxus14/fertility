<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OOctyeFreezeThawTransRecSubs extends Migration
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
            $table->bigInteger('OOcFreThaTraRecId')->unsigned();
            $table->foreign('OOcFreThaTraRecId')->references('id')->on('OOcyteFreezeThawTransRecs')->onDelete('cascade');

            $table->date('FreezingDate')->nullable();
            $table->time('FreezingTime')->nullable();
            $table->string('FreezingLocation')->nullable();
            $table->bigInteger('FreezingEmbStaffId')->nullable();

            $table->date('ThawingDate')->nullable();
            $table->time('ThawingTime')->nullable();
            $table->string('ThawingLocation')->nullable();
            $table->bigInteger('ThawingEmbStaffId')->nullable();

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
