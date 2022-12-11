<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFemaledoctorsconsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('femaledoctorsconsultation', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('patientid');
            $table->date('docdate');
            $table->integer('IsSingle')->nullable();
            $table->integer('IsMarried')->nullable();
            $table->integer('IsDivorced')->nullable();
            $table->integer('IsWidow')->nullable();
            $table->integer('NoOfChildren')->nullable();
            $table->integer('WorkStatusYes')->nullable();
            $table->integer('WorkStatusNo')->nullable();
            $table->string('WorkStatusSpecify')->nullable();
            $table->integer('AlcoholIntakeYes')->nullable();
            $table->integer('AlcoholIntakeNo')->nullable();
            $table->string('AlcoholIntakeSpecify')->nullable();
            $table->integer('SmokingYes')->nullable();
            $table->integer('SmokingNo')->nullable();
            $table->string('SmokingSpecify')->nullable();
            $table->integer('SubstanceYes')->nullable();
            $table->integer('SubstanceNo')->nullable();
            $table->string('SubstanceSpecify')->nullable();
            $table->date('LastMenstualPeriod')->nullable();
            $table->string('LastMenstualPeriodSpecify')->nullable();
            $table->integer('PregnantYes')->nullable();
            $table->integer('PregnantNo')->nullable();
            $table->string('PregnantSpecify')->nullable();
            $table->integer('BreastFeedingYes')->nullable();
            $table->integer('BreastFeedingNo')->nullable();
            $table->integer('AgeStartPeriod')->nullable();
            $table->integer('PeriodAbsent')->nullable();
            $table->integer('PeriodRegular')->nullable();
            $table->integer('PeriodLight')->nullable();
            $table->integer('PeriodHeavy')->nullable();
            $table->integer('PeriodSpottingBefore')->nullable();
            $table->integer('PeriodSpottingBetween')->nullable();
            $table->integer('PeriodIrregular')->nullable();
            $table->string('PeriodIrregularSpecify')->nullable();
            $table->integer('SevereCrampingYes')->nullable();
            $table->integer('SevereCrampingNo')->nullable();
            $table->string('SevereCrampingSpecify')->nullable();
            $table->integer('PainScaleScore')->nullable();
            $table->string('PreHisConceivedYear')->nullable();
            $table->string('PreHisLongConceived')->nullable();
            $table->string('PreHisNorDelCSecMisc')->nullable();
            $table->string('PreHisFerTreaUsed')->nullable();
            $table->integer('SexHisCountOvuKitYes')->nullable();
            $table->integer('SexHisCountOvuKitNo')->nullable();
            $table->integer('SexHisPainInterYes')->nullable();
            $table->integer('SexHisPainInterNo')->nullable();
            $table->integer('SexHisUseContraceptiveYes')->nullable();
            $table->integer('SexHisUseContraceptiveNo')->nullable();
            $table->string('SexHisUseContraceptiveSpecify')->nullable();
            $table->integer('SexHisChlamydia')->nullable();
            $table->integer('SexHisGonorrhea')->nullable();
            $table->integer('SexHisSyphilis')->nullable();
            $table->integer('SexHisGenitalWartsHPV')->nullable();
            $table->integer('SexHisHepatitis')->nullable();
            $table->integer('SexHisHerpes')->nullable();
            $table->integer('SexHisHIVAIDS')->nullable();
            $table->integer('SexHisPID')->nullable();
            $table->integer('SexHisUTI')->nullable();
            $table->string('SexHiTransmittedDeasesSpecify')->nullable();
            $table->integer('MedHisChroMedConYes')->nullable();
            $table->integer('MedHisChroMedConNo')->nullable();
            $table->string('MedHisChroMedConSpecify')->nullable();
            $table->integer('InMedicationYes')->nullable();
            $table->integer('InMedicationNo')->nullable();
            $table->string('InMedicationSpecify')->nullable();
            $table->integer('IntakeAspirinYes')->nullable();
            $table->integer('IntakeAspirinNo')->nullable();
            $table->string('IntakeAspirinSpecify')->nullable();
            $table->integer('FoodAllergyYes')->nullable();
            $table->integer('FoodAllergyNo')->nullable();
            $table->string('FoodAllergySpecify')->nullable();
            $table->integer('MedAllergyYes')->nullable();
            $table->integer('MedAllergyNo')->nullable();
            $table->string('MedAllergySpecify')->nullable();
            $table->string('SurHisSurgery')->nullable();
            $table->date('SurHisSurgeryDate')->nullable();
            $table->string('SurHisComplication')->nullable();
            $table->integer('SurHisProbAnesthesiaYes')->nullable();
            $table->integer('SurHisProbAnesthesiaNo')->nullable();
            $table->string('SurHisProbAnesthesiaSpecify')->nullable();
            $table->integer('FamHisFamMedConDiabetesMellitus')->nullable();
            $table->integer('FamHisFamMedConHighBlood')->nullable();
            $table->integer('FamHisFamMedConCancer')->nullable();
            $table->string('FamHisFamMedConHighOthers')->nullable();
            $table->integer('PriorFerTreatYes')->nullable();
            $table->integer('PriorFerTreatNo')->nullable();
            $table->integer('PriorFerTreatCioNatInter')->nullable();
            $table->integer('PriorFerTreatCioInse')->nullable();
            $table->integer('PriorFerTreatVitFer')->nullable();
            $table->integer('PriorFerTreatInjMedNatInt')->nullable();
            $table->integer('PriorFerTreatInjMedIns')->nullable();
            $table->integer('PriorFerTreatFroEmbrTran')->nullable();
            $table->integer('PriorFerTreatHSG')->nullable();
            $table->string('PriorFerTreatOthers')->nullable();
            $table->string('Notes')->nullable();
            $table->string('filelink')->nullable();
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
        Schema::dropIfExists('femaledoctorsconsultation');
    }
}
