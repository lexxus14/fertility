<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshphaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshPhases', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('patientid');
            $table->date('docdate');
            $table->string('Months')->nullable();
            $table->string('FreshSched')->nullable();
            $table->string('Notes')->nullable();
            $table->string('filelink')->nullable();            
            $table->integer('createdbyid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FreshPhases');
    }
}
