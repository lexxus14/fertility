<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbryologyRecordITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EmbryologyRecordIs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();
            $table->string('RecordNo')->nullable();
            $table->integer('IsMssgYes')->nullable();
            $table->integer('IsMssgNo')->nullable();
            $table->integer('IsIVF')->nullable();
            $table->integer('IsICSC')->nullable();
            $table->integer('IsPGTA')->nullable();
            $table->integer('IsPGTAM')->nullable();
            $table->integer('IsBabayGender')->nullable();
            $table->integer('IsOOctye')->nullable();
            $table->date('hCGDate')->nullable();
            $table->time('hCGTime')->nullable();
            $table->double('NoFoll')->nullable();
            $table->string('MaxE2')->nullable();
            $table->string('InfeDruAmount')->nullable();
            $table->integer('CycleNo')->nullable();
            $table->date('CycleDate')->nullable();
            $table->integer('IsLupronYes')->nullable();
            $table->integer('IsLupronNo')->nullable();
            $table->string('G')->nullable();
            $table->string('P')->nullable();
            $table->string('A')->nullable();
            $table->string('E')->nullable();
            $table->string('dx1')->nullable();
            $table->string('dx2')->nullable();
            $table->string('Ethnicity')->nullable();
            $table->string('Town')->nullable();
            $table->date('RetDate')->nullable();
            $table->integer('RetNoOfEggs')->nullable();
            $table->time('RetStartTime')->nullable();
            $table->time('RetFinishTime')->nullable();
            $table->bigInteger('RetAnesthesiologistStaffId')->nullable();
            $table->bigInteger('RetNurseStaffId')->nullable();
            $table->bigInteger('RetEmbStaffId')->nullable();
            $table->bigInteger('RetPhysicianStaffId')->nullable();
            $table->bigInteger('RetWristCheckByStaffId')->nullable();
            $table->string('RetComments')->nullable();
            $table->integer('IsFresh')->nullable();
            $table->integer('IsFrozen')->nullable();
            $table->integer('IsTESE')->nullable();
            $table->integer('IsMESA')->nullable();
            $table->double('PreWashVol')->nullable();
            $table->double('PreWashConc')->nullable();
            $table->double('PreWashMotility')->nullable();
            $table->double('PreWashProg')->nullable();
            $table->string('PreWashTech')->nullable();
            $table->double('PosWashVol')->nullable();
            $table->double('PosWashConc')->nullable();
            $table->double('PosWashMotility')->nullable();
            $table->double('PosWashProg')->nullable();
            $table->string('PosWashTech')->nullable();
            $table->integer('IsPreMetIsolate')->nullable();
            $table->integer('IsPreMetWashOnly')->nullable();
            $table->integer('IsPreMetPentoxifyline')->nullable();
            $table->string('SpermComments')->nullable();
            $table->string('InsInsICSI')->nullable();
            $table->string('InsInsConv')->nullable();
            $table->time('InsInsTime')->nullable();
            $table->bigInteger('InsInsEmbrStaffId')->nullable();
            $table->string('InsInsID')->nullable();
            $table->string('FerRes2PN')->nullable();
            $table->string('FerRes1PN')->nullable();
            $table->string('FerRes3PN')->nullable();
            $table->bigInteger('FerResEmbrStaffId')->nullable();
            $table->time('HvaTime')->nullable();
            $table->string('HvaTech')->nullable();
            $table->string('HvaMII')->nullable();
            $table->string('HvaMI')->nullable();
            $table->string('HvaGV')->nullable();
            $table->string('HvaOther')->nullable();
            $table->double('ICSITotalInj')->nullable();
            $table->bigInteger('ICSIEmbStaffId')->nullable();
            $table->string('ICSIComments')->nullable();
            $table->date('EmbTranDate')->nullable();
            $table->time('EmbTranTime')->nullable();
            $table->bigInteger('EmbTranPhysiStaffId')->nullable();
            $table->bigInteger('EmbTranEmbrStaffId')->nullable();
            $table->bigInteger('EmbTranNurseStaffId')->nullable();
            $table->string('EmbTranID')->nullable();
            $table->string('EmbTranCatheter')->nullable();
            $table->integer('IsEmbTranTenaYes')->nullable();
            $table->integer('IsEmbTranTeanNo')->nullable();
            $table->integer('IsEmbTranBleYes')->nullable();
            $table->integer('IsEmbTranBleNo')->nullable();
            $table->integer('IsEmbTranCramYes')->nullable();
            $table->integer('IsEmbTranCramNo')->nullable();
            $table->double('EmbTranNoAttempts')->nullable();
            $table->integer('IsEmbTranEmbRetYes')->nullable();
            $table->integer('IsEmbTranEmbRetNo')->nullable();
            $table->double('EmbTranNoRet')->nullable();
            $table->string('EmbTranComments')->nullable();
            $table->double('EmbTranNoEmbTran')->nullable();
            $table->integer('IsEmbTranAHYes')->nullable();
            $table->integer('IsEmbTranAHNo')->nullable();
            $table->string('EmbTranDayOfTran')->nullable();
            $table->integer('IsEmbTranACGHYes')->nullable();
            $table->integer('IsEmbTranACGHNo')->nullable();
            $table->string('EmbTranQuaTrans')->nullable();
            $table->string('OocCrvVitri')->nullable();
            $table->double('OocCrvLotNo')->nullable();
            $table->date('OocCrvExpDate')->nullable();
            $table->string('OocCrvDevice')->nullable();
            $table->date('OocCrvDate')->nullable();
            $table->bigInteger('OocCrvEmbStaffId')->nullable();
            $table->string('OocCrvTankCanCan')->nullable();
            $table->double('OocCrvTotalFroOoc')->nullable();
            $table->string('OocCrvComments')->nullable();
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
        Schema::dropIfExists('EmbryologyRecordIs');
    }
}
