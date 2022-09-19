<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostOpPostNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PostOpPostProcNotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();
            $table->date('docdate')->nullable();
            $table->time('docTime')->nullable();
            $table->string('SurgeonPerformingMD')->nullable();
            $table->string('Anesthesiologist')->nullable();
            $table->string('AnesthesiaUsed')->nullable();
            $table->string('Specimens')->nullable();
            $table->string('Drains')->nullable();
            $table->string('EstBloodLoss')->nullable();
            $table->string('Complications')->nullable();
            $table->integer('IsConStable')->nullable();
            $table->integer('IsConGuarded')->nullable();
            $table->integer('IsConCritical')->nullable();
            $table->string('ConOthers')->nullable();
            $table->longText('Notes')->nullable();

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
        Schema::dropIfExists('PostOpPostProcNotes');
    }
}
