<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientdoctorsplansubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientdoctorsplansub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientdoctorplanId');
            $table->biginteger('doctorplanId')->nullable();
            $table->string('result')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('patientdoctorsplansub');
    }
}
