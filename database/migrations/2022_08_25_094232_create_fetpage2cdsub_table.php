<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFetpage2cdsubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FETPage2CDSubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('FETPage2sId')->unsigned();
            $table->foreign('FETPage2sId')->references('id')->on('FETPage2s')->onDelete('cascade');
            $table->bigInteger('CDNo')->nullable();
            $table->date('CDDate')->nullable();
            $table->string('RT')->nullable();
            $table->string('LT')->nullable();
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
        Schema::dropIfExists('FETPage2CDSubs');
    }
}
