<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbryologyRecordIISubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EmbryologyRecordIISubs', function (Blueprint $table) {
            $table->bigInteger('EmbryologyRecordIIsId')->unsigned();
            $table->foreign('EmbryologyRecordIIsId')->references('id')->on('EmbryologyRecordIIs')->onDelete('cascade');
            $table->string('maturity')->nullable();
            $table->string('Day0remarks')->nullable();
            $table->string('icsi')->nullable();
            $table->string('PB')->nullable();
            $table->string('PN')->nullable();
            $table->string('Day1remarks')->nullable();
            $table->string('Day3remarks')->nullable();
            $table->string('Day5remarks')->nullable();
            $table->string('Day6remarks')->nullable();
            $table->string('Dispositionremarks')->nullable();
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
        Schema::dropIfExists('EmbryologyRecordIISubs');
    }
}
