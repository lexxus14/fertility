<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClomidcylediagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ClomidCyleDiags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('DiagnosisId')->nullable();;
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
        Schema::dropIfExists('ClomidCyleDiags');
    }
}
