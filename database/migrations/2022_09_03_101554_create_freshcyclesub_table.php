<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshcyclesubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormCyclePage2Subs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('FreshFormCyclePage2siD')->unsigned();
            $table->foreign('FreshFormCyclePage2siD')->references('id')->on('FreshFormCyclePage2s')->onDelete('cascade');
            $table->Integer('CycleNo')->nullable();
            $table->date('CycleDate')->nullable();
            $table->string('UltrasoundRT')->nullable();
            $table->string('UltrasoundLT')->nullable();
            $table->string('Lining')->nullable();
            $table->string('Estradiol')->nullable();
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
        Schema::dropIfExists('FreshFormCyclePage2Subs');
    }
}
