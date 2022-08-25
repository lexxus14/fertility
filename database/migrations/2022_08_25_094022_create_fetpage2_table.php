<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFetpage2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FETPage2s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->date('docdate');
            $table->date('LupronStartDate')->nullable();
            $table->date('CD2Date')->nullable();
            $table->string('UterinePosition')->nullable();
            $table->string('Measurement')->nullable();
            $table->string('HIPPA')->nullable();
            $table->string('CD1Etradiol')->nullable();
            $table->string('CD1PRL')->nullable();
            $table->string('BloodType')->nullable();
            $table->date('FETDate')->nullable();
            $table->string('Embros')->nullable();
            $table->string('Trans')->nullable();
            $table->string('Cryo')->nullable();
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
        Schema::dropIfExists('FETPage2');
    }
}
