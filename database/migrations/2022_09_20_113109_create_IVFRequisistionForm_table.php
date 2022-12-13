<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIVFRequisistionFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IVFRequisistionForms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();
            $table->date('docdate')->nullable();
            $table->bigInteger('PhysicianId')->nullable();
            $table->integer('IsFemalePartner')->nullable();
            $table->string('BaselineFSH')->nullable();
            $table->string('UTLining')->nullable();
            $table->string('AMH')->nullable();
            $table->string('OocyteSoureValid')->nullable();
            $table->integer('IsMalePartner')->nullable();
            $table->integer('IsFresh')->nullable();
            $table->integer('IsFrozen')->nullable();
            $table->integer('IsTESE')->nullable();
            $table->integer('IsICSI')->nullable();
            $table->integer('IsAssHatching')->nullable();
            $table->integer('IsEmbBxFSH')->nullable();
            $table->integer('IsEmbBxAcgh')->nullable();
            $table->string('SpermSourceValid')->nullable();
            $table->string('Dx')->nullable();
            $table->string('G')->nullable();
            $table->string('P')->nullable();
            $table->string('T')->nullable();
            $table->string('A')->nullable();
            $table->string('L')->nullable();
            $table->string('Protocol')->nullable();
            $table->string('Cycle')->nullable(); 
            $table->string('PeakE2')->nullable();
            $table->string('StimDays')->nullable();
            $table->date('CycleStartDate')->nullable();
            $table->string('NoFollHcgInjDays')->nullable();
            $table->string('PatientCoastedDays')->nullable();
            $table->integer('IsPGTA')->nullable();
            $table->integer('IsGenderSel')->nullable();
            $table->integer('IsPGTM')->nullable();
            $table->date('HcgDate')->nullable();
            $table->time('HcgTime')->nullable();
            $table->date('ErDate')->nullable();
            $table->time('ErTime')->nullable();
            $table->integer('IsBryoTransYes')->nullable();
            $table->integer('IsBryoTransNo')->nullable();
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
        Schema::dropIfExists('IVFRequisistionForms');
    }
}
