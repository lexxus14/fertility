<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformcyclepage2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormCyclePage2s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->date('docdate')->nullable();
            $table->bigInteger('createdbyid');
            $table->string('Notes')->nullable();
            $table->bigInteger('freshphasesiD')->unsigned();
            $table->foreign('freshphasesiD')->references('id')->on('freshphases')->onDelete('cascade');
            $table->string('ICSI')->nullable();
            $table->string('EggFreezing')->nullable();
            $table->string('CD2')->nullable();
            $table->Integer('IsConsent')->nullable();
            $table->string('Protocol')->nullable();
            $table->string('FSH')->nullable();
            $table->string('Estradiol')->nullable();
            $table->string('AMH')->nullable();
            $table->string('IsCBC')->nullable();
            $table->date('CBCDate')->nullable();
            $table->string('UterinePosition')->nullable();
            $table->string('Measurement')->nullable();
            $table->integer('WallaceYesNo')->nullable();
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
        Schema::dropIfExists('FreshFormCyclePage2s');
    }
}
