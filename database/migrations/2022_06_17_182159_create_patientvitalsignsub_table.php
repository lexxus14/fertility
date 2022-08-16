<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientvitalsignsubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PatientVitalSignSub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientvitalsignId');
            $table->biginteger('vitalsignId')->nullable();
            $table->string('result')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('PatientVitalSignSub');
    }
}
