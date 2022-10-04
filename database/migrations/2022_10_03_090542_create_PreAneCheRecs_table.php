<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreAneCheRecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreAneCheRecs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();               
            $table->longText('PreAneSurHis')->nullable(); 
            $table->longText('CurTheraphy')->nullable();                 
            $table->integer('IsSpeRisHypertension')->nullable(); 
            $table->integer('IsSpeRiBronchialAsthma')->nullable(); 
            $table->integer('IsSpeRiCOPD')->nullable(); 
            $table->integer('IsSpeRiObesity')->nullable(); 
            $table->integer('IsSpeRiDiaMellitus')->nullable(); 
            $table->integer('IsSpeRiIscHeaDisease')->nullable(); 
            $table->integer('IsSpeRiAlcHistory')->nullable(); 
            $table->integer('IsSpeRiSmoHistory')->nullable(); 
            $table->longText('Others')->nullable(); 
            $table->integer('AirwayScore')->nullable(); 
            $table->integer('AsaScore')->nullable(); 
            $table->longText('PreMedDruInsNote')->nullable(); 
            $table->longText('AnesthesiaPlan')->nullable(); 
            $table->bigInteger('AnesthetistStaffId')->nullable(); 
            $table->date('AnesthetistDate')->nullable(); 
            $table->time('AnesthetistTime')->nullable(); 
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
        Schema::dropIfExists('PreAneCheRecs');
    }
}
