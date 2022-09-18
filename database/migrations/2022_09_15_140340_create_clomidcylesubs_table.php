<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClomidcylesubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ClomidCycleSubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('CycleNo')->nullable();;
            $table->bigInteger('ClomidCyclesiD')->unsigned();
            $table->foreign('ClomidCyclesiD')->references('id')->on('ClomidCycles')->onDelete('cascade');
            $table->date('CycleDate')->nullable();
            $table->string('RT')->nullable();
            $table->string('LT')->nullable();
            $table->string('Lining')->nullable();
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
        Schema::dropIfExists('ClomidCycleSubs');
    }
}
