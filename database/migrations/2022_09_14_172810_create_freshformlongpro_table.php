<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformlongproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormLongPros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->bigInteger('freshphasesiD')->unsigned();
            $table->foreign('freshphasesiD')->references('id')->on('freshphases')->onDelete('cascade');
            $table->string('Office')->nullable();
            $table->string('RetLoc')->nullable();
            $table->string('CrySpermLoc')->nullable();
            $table->string('IVF')->nullable();
            $table->string('OvDonor')->nullable();
            $table->string('IVFwSur')->nullable();
            $table->date('LupronStartDate')->nullable();
            $table->date('CD2')->nullable();
            $table->integer('IsConsent')->nullable();
            $table->integer('CBC')->nullable();
            $table->string('FSH')->nullable();
            $table->string('LongEstradiol')->nullable();
            $table->string('AMH')->nullable();
            $table->string('UterinePosition')->nullable();
            $table->integer('Measurement')->nullable();
            $table->date('LongProcDate')->nullable();
            $table->integer('IsWallace')->nullable();
            $table->string('Protocol')->nullable();
            $table->string('CD1Estradiol')->nullable();
            $table->string('CD1Prolactin')->nullable();
            $table->string('CD9Prolactin')->nullable();
            $table->string('Notes')->nullable();
            $table->date('HcgDate')->nullable();
            $table->time('HCGTime')->nullable();
            $table->date('ERDate')->nullable();
            $table->time('ERTime')->nullable();
            $table->string('BloodType')->nullable();
            $table->date('ETDate')->nullable();
            $table->string('NoEmbryos')->nullable();
            $table->string('NoTrans')->nullable();
            $table->string('NoEggs')->nullable();
            $table->string('NoCryo')->nullable();
            $table->string('BetaNo1')->nullable();
            $table->date('Beta1Date')->nullable();
            $table->string('BetNo2')->nullable();
            $table->date('Beta2Date')->nullable();
            $table->string('P4')->nullable();
            $table->string('ObGyn')->nullable();
            $table->string('TelNo')->nullable();
            $table->string('Add')->nullable();

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
        Schema::dropIfExists('FreshFormLongPros');
    }
}
