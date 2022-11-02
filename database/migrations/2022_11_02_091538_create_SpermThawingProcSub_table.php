<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpermThawingProcSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpermThawingProcSubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('SpermThawingsId')->unsigned();
            $table->foreign('SpermThawingsId')->references('id')->on('SpermThawings')->onDelete('cascade');
            $table->integer('NoOfVials')->nullable();
            $table->date('DateRecovered')->nullable();
            $table->string('Office')->nullable();
            $table->integer('IsFresh')->nullable();
            $table->integer('IsTESEPESAMESA')->nullable();
            $table->integer('IsPrevFroz')->nullable();
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
        Schema::dropIfExists('SpermThawingProcSubs');
    }
}
