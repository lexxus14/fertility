<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadassessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->integer('staffid')->nullable();
            $table->biginteger('patientid')->nullable();
            $table->integer('reasonid')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('createdbyid')->nullable();
            $table->string('assessmentrate')->nullable();
            $table->string('FileLink')->nullable();           
            $table->string('iscurrent')->nullable();           
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
        Schema::dropIfExists('lead_assessments');
    }
}
