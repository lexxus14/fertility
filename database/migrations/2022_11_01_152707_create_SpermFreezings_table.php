<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpermFreezingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpermFreezings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('FileNo')->nullable();
            $table->string('FreezingNo')->nullable();
            $table->string('AccnNo')->nullable();
            $table->longText('Notes')->nullable();
            $table->time('CollectionTime')->nullable();
            $table->string('DaysOfAbstinence')->nullable();
            $table->integer('IsEjaculateComplete')->nullable();
            $table->integer('IsEjaculateIncomplete')->nullable();
            $table->integer('IsEjaculateSpilled')->nullable();
            $table->integer('IsCollectedOnSite')->nullable();
            $table->integer('IsCollectedOffSite')->nullable();
            $table->integer('IsFreshEja')->nullable();
            $table->integer('IsMESA')->nullable();
            $table->integer('IsTESE')->nullable();
            $table->integer('IsPESA')->nullable();
            $table->integer('IsReFreeze')->nullable();
            $table->double('Volume')->nullable();
            $table->string('Liquefaction')->nullable();
            $table->string('Color')->nullable();
            $table->string('Viscosity')->nullable();
            $table->double('pH')->nullable();
            $table->integer('OfVialsNo')->nullable();
            $table->string('Tank')->nullable();
            $table->string('Canister')->nullable();
            $table->string('Cane')->nullable();
            $table->double('SpermVolume')->nullable();
            $table->string('Conc')->nullable();
            $table->integer('Motility')->nullable();
            $table->date('DateRecovered')->nullable();
            $table->string('Office')->nullable();
            $table->integer('IsSpecTypeFresh')->nullable();
            $table->integer('IsSpecTESAPESAMESA')->nullable();
            $table->integer('IsSpecPrevFroz')->nullable();
            $table->bigInteger('CompByStaffId')->nullable();
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
        Schema::dropIfExists('SpermFreezings');
    }
}
