<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformbcpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormBCPs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->date('docdate');  
            $table->bigInteger('FreshPhaseID')->unsigned();
            $table->foreign('FreshPhaseID')->references('id')->on('FreshPhases')->onDelete('cascade');                     
            $table->string('Notes')->nullable();
            $table->string('filelink')->nullable();            
            $table->integer('createdbyid')->nullable();
            $table->string('CycleNo')->nullable();
            $table->string('CycleDate')->nullable();     
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
        Schema::dropIfExists('FreshFormBCPs');
    }
}
