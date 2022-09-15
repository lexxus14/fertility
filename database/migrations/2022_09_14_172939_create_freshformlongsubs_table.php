<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformlongsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormLongProSubs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('FreshFormLongProsiD')->unsigned();
            $table->foreign('FreshFormLongProsiD')->references('id')->on('FreshFormLongPros')->onDelete('cascade');
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
        Schema::dropIfExists('FreshFormLongProSubs');
    }
}
