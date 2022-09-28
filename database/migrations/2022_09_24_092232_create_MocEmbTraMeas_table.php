<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMocEmbTraMeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MocEmbTraMeas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();
            $table->date('docdate')->nullable();
            $table->integer('IsWalEasy')->nullable();
            $table->integer('IsWalDiff')->nullable();
            $table->integer('IsWalWIntr')->nullable();
            $table->integer('IsWalMeCaNe')->nullable();
            $table->integer('IsWalTenN')->nullable();
            $table->longText('Comments')->nullable();
            $table->string('UtMea')->nullable();
            $table->integer('IsUtPoAnteflex')->nullable();
            $table->integer('IsUtPoAnteverted')->nullable();
            $table->integer('IsUtPoAxial')->nullable();
            $table->integer('IsUtPoRetroverted')->nullable();
            $table->integer('IsCaOr1')->nullable();
            $table->integer('IsCaOr2')->nullable();
            $table->integer('IsCaOr3')->nullable();
            $table->integer('IsCaOr4')->nullable();
            $table->integer('IsCaOr5')->nullable();
            $table->integer('IsCaOr6')->nullable();
            $table->integer('IsCaOr7')->nullable();
            $table->integer('IsCaOr8')->nullable();
            $table->integer('IsCaOr9')->nullable();
            $table->integer('IsCaOr10')->nullable();
            $table->integer('IsCaOr11')->nullable();
            $table->integer('IsCaOr12')->nullable();
            $table->longText('UtPoImage')->nullable();
            $table->longText('UtPoCaOr')->nullable();
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
        Schema::dropIfExists('MocEmbTraMeas');
    }
}
