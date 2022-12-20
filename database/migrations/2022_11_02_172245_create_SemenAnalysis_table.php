<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemenAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SemenAnalysis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();
            $table->time('CollectionTime')->nullable();
            $table->string('AccessionNo')->nullable();
            $table->time('DeliveryTime')->nullable();
            $table->string('DaysOfAbstinence')->nullable();
            $table->bigInteger('PhysicianStaffID')->nullable();
            $table->integer('IsEjaComplete')->nullable();
            $table->integer('IsEjaSpilled')->nullable();
            $table->integer('IsCollHome')->nullable();
            $table->integer('IsCollOffice')->nullable();
            $table->string('Liquefaction')->nullable();
            $table->string('Color')->nullable();
            $table->string('Viscosity')->nullable();
            $table->double('pH')->nullable();
            $table->double('Volume')->nullable();
            $table->double('SpermCount')->nullable();
            $table->double('TotalSpermCount')->nullable();
            $table->string('Cryptozoospermia')->nullable();
            $table->double('ProgMotility')->nullable();
            $table->double('ProgRapid')->nullable();
            $table->double('ProgSlow')->nullable();
            $table->double('ProgNonProg')->nullable();
            $table->double('ProgNonMotile')->nullable();
            $table->double('NonSpermCells')->nullable();
            $table->double('NorForm')->nullable();
            $table->double('AbHead')->nullable();
            $table->double('AbMid')->nullable();
            $table->double('AbTail')->nullable();
            $table->time('TimeAnalyzed')->nullable();
            $table->bigInteger('EmbryologistStaffId')->nullable();
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
        Schema::dropIfExists('SemenAnalysis');
    }
}
