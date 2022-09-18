<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClomidcyleOBUSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ClomidCycleObus', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('ClomidCyclesiD')->unsigned();
            $table->foreign('ClomidCyclesiD')->references('id')->on('ClomidCycles')->onDelete('cascade');
            $table->string('OBUSWeeksSac')->nullable();
            $table->string('FHT')->nullable();
            $table->string('P4')->nullable();
            $table->string('ClomidCycleDate')->nullable();
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
        Schema::dropIfExists('ClomidCycleObus');
    }
}
