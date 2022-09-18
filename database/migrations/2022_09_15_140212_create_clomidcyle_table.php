<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClomidcyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ClomidCycles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->date('LMPDAte')->nullable();
            $table->string('AMH')->nullable();
            $table->string('FSH')->nullable();
            $table->string('E2')->nullable();
            $table->date('DateStartClomid')->nullable();
            $table->string('Clomidmg')->nullable();
            $table->string('ClomidXDays')->nullable();
            $table->integer('IsHCGInj')->nullable();
            $table->integer('IsIntercourseIUI')->nullable();
            $table->date('ClomidConsendDate')->nullable();
            $table->date('HCGDate')->nullable();
            $table->time('HCGTime')->nullable();
            $table->string('BetaHCG1')->nullable();
            $table->date('Beta1HCGDate')->nullable();
            $table->string('BetaHCG2')->nullable();
            $table->string('BetaHCG2Date')->nullable();
            $table->string('Notes')->nullable();
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
        Schema::dropIfExists('ClomidCycles');
    }
}
