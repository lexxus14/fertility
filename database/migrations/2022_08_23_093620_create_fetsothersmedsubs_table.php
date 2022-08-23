<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFetsothersmedsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fetsothermedsubs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('fetothersId')->unsigned();
            $table->foreign('fetothersId')->references('id')->on('fetothers')->onDelete('cascade');
            $table->bigInteger('MedId')->nullable();
            $table->string('Dose')->nullable();   
            $table->bigInteger('MedUnitId')->nullable();   
            $table->bigInteger('DayShiftId')->nullable(); 
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
        Schema::dropIfExists('fetsothermedsubs');
    }
}
