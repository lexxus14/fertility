<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClomidcylenoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ClomidCycleNo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ClomidNo');
            $table->bigInteger('ClomidCyclesiD')->unsigned();
            $table->foreign('ClomidCyclesiD')->references('id')->on('ClomidCycles')->onDelete('cascade');
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
        Schema::dropIfExists('ClomidCycleNo');
    }
}
