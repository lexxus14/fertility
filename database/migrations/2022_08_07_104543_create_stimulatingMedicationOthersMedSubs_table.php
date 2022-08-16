<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStimulatingMedicationOthersMedSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StiMedOthMedSubs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('StimulatingMedicationsid');
            $table->bigInteger('MedId')->nullable();
            $table->bigInteger('UnitId')->nullable();
            $table->string('dose')->nullable();
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
        Schema::dropIfExists('StiMedOthMedSubs');
    }
}
