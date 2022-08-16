<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaledoctorconsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maledoctorconsultations', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('patientid');
            $table->date('docdate');
            $table->string('Notes')->nullable();
            $table->string('filelink')->nullable();
            $table->integer('createdbyid')->nullable();
            $table->integer('SocHisSingle')->nullable();
            $table->integer('SocHisMarried')->nullable();
            $table->integer('SocHisDivorced')->nullable();
            $table->integer('SocHisWidow')->nullable();
            $table->integer('SocHisNoOfChildren')->nullable();
            $table->integer('SocHisWorkingStatusYes')->nullable();
            $table->integer('SocHisWorkingStatusNo')->nullable();
            $table->string('SocHisWorkingSpecify')->nullable();
            $table->integer('SocHisAlcoholIntakeYes')->nullable();
            $table->integer('SocHisAlcoholIntakeNo')->nullable();
            $table->integer('SocHisSmokingYes')->nullable();
            $table->integer('SocHisSmokingNo')->nullable();
            $table->integer('SocHisSubsAbuseYes')->nullable();
            $table->integer('SocHisSubsAbuseNo')->nullable();
            $table->integer('FamHisMedConDiaMille')->nullable();
            $table->integer('FamHisMedConHigbBlood')->nullable();
            $table->integer('FamHisMedConCancer')->nullable();
            $table->string('FamHisMedConOthers')->nullable();
            $table->integer('MedHisSemAnaYes')->nullable();
            $table->integer('MedHisSemAnaNo')->nullable();
            $table->integer('MedHisRetroEjaYes')->nullable();
            $table->integer('MedHisRetroEjaNo')->nullable();
            $table->integer('MedHisExpRadHarChemYes')->nullable();
            $table->integer('MedHisExpRadHarChemNo')->nullable();
            $table->string('MedHisExpRadHarChemSpecify')->nullable();
            $table->integer('MedHisChroMedConYes')->nullable();
            $table->integer('MedHisChroMedConNo')->nullable();
            $table->string('MedHisChroMedConSpecify')->nullable();
            $table->string('MedHisCurMed')->nullable();
            $table->integer('MedHisOvCouHerMedYes')->nullable();
            $table->integer('MedHisOvCouHerMedNo')->nullable();
            $table->string('MedHisOvCouHerMedSpecify')->nullable();
            $table->integer('MedHisAllerFoodNonKnown')->nullable();
            $table->integer('MedHisAllerFoodYes')->nullable();
            $table->string('MedHisAllerFoodSpecify')->nullable();
            $table->integer('MedHisAllerMedNonKnown')->nullable();
            $table->integer('MedHisAllerMedYes')->nullable();
            $table->string('MedHisAllerMedSpecify')->nullable();
            $table->integer('SexHisChlamydi')->nullable();
            $table->integer('SexHisGonorrhea')->nullable();
            $table->integer('SexHisSyphilis')->nullable();
            $table->integer('SexHisGenWartsHPV')->nullable();
            $table->integer('SexHisHepatitis')->nullable();
            $table->integer('SexHisHerpes')->nullable();
            $table->integer('SexHisHIVAIDS')->nullable();
            $table->integer('SexHisPIV')->nullable();
            $table->string('SexHisOthers')->nullable();
            $table->string('SurHisTypeSurgery')->nullable();
            $table->string('SurHisWhen')->nullable();
            $table->string('SurHisComplication')->nullable();

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
        Schema::dropIfExists('maledoctorconsultations');
    }
}
