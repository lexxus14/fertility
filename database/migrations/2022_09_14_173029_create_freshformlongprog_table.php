<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshformlongprogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FreshFormLongProgs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('FreshFormLongProsiD')->unsigned();
            $table->foreign('FreshFormLongProsiD')->references('id')->on('FreshFormLongPros')->onDelete('cascade');
            $table->integer('OBUSNo')->nullable();
            $table->string('OBUS')->nullable();
            $table->string('Progesterone')->nullable();
            $table->string('NoSACS')->nullable();
            $table->string('NoFHT')->nullable();
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
        Schema::dropIfExists('FreshFormLongProgs');
    }
}
