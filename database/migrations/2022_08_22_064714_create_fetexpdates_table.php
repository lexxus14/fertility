<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFetexpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fetexpdates', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->date('docdate');  
            $table->string('CycleNo')->nullable();
            $table->string('CycleDate')->nullable(); 
            $table->bigInteger('FETPhaseID')->unsigned();
            $table->foreign('FETPhaseID')->references('id')->on('fetphases')->onDelete('cascade');
            $table->string('Notes')->nullable();
            $table->string('filelink')->nullable();            
            $table->integer('createdbyid')->nullable();
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
        Schema::dropIfExists('fetexpdates');
    }
}
