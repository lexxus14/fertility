<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImptemptable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ImpTempTable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Field1')->nullable();
            $table->string('Field2')->nullable();
            $table->string('Field3')->nullable();
            $table->string('Field4')->nullable();
            $table->string('Field5')->nullable();
            $table->string('Field6')->nullable();
            $table->string('Field7')->nullable();
            $table->string('Field8')->nullable();
            $table->string('Field9')->nullable();
            $table->string('Field10')->nullable();
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
        Schema::dropIfExists('ImpTempTable');
    }
}
