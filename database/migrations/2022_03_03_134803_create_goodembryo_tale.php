<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodembryoTale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_embryos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Date')->nullable();
            $table->bigInteger('PatientId')->nullable();
            $table->bigInteger('DoctorId')->nullable();
            $table->bigInteger('NurseId')->nullable();
            $table->string('GoodEmbryo')->nullable();
            $table->string('Notes')->nullable();
            $table->string('FileLink')->nullable();
            $table->integer('createdbyid')->nullable();
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
        Schema::dropIfExists('good_embryos');
    }
}
