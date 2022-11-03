<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIUITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IUIs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();
            $table->string('AccessionNo')->nullable();
            $table->integer('IsComplete')->nullable();
            $table->integer('IsSpilled')->nullable();
            $table->integer('IsHome')->nullable();
            $table->integer('IsOffice')->nullable();
            $table->string('DaysOfAbstinence')->nullable();
            $table->bigInteger('PhysicianStaffId')->nullable();
            $table->time('CollectionTime')->nullable();
            $table->time('DeliveryTime')->nullable();
            $table->double('Liquefaction')->nullable();
            $table->string('Color')->nullable();
            $table->string('Viscosity')->nullable();
            $table->double('Volume')->nullable();
            $table->double('SpermConcentration')->nullable();
            $table->double('TotalSpermCount')->nullable();
            $table->double('pH')->nullable();
            $table->double('ProgRapid')->nullable();
            $table->double('ProgSlow')->nullable();
            $table->double('ProgNonProg')->nullable();
            $table->double('ProgNonMotile')->nullable();
            $table->double('NorForms')->nullable();
            $table->double('AbHead')->nullable();
            $table->double('AbMidpiece')->nullable();
            $table->double('AbTail')->nullable();
            $table->double('AfPreVolume')->nullable();
            $table->double('AfPreSpermConcentration')->nullable();
            $table->double('AfPreTotalSpermCount')->nullable();
            $table->double('AfPreProgRapid')->nullable();
            $table->double('AfPreProgSlow')->nullable();
            $table->double('AfPreProgNonProg')->nullable();
            $table->double('AfPreProgNonMotile')->nullable();
            $table->double('AfPreNorForms')->nullable();
            $table->double('AfPreAbHead')->nullable();
            $table->double('AfPreAbMidpiece')->nullable();
            $table->double('AfPreAbTail')->nullable();
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
        Schema::dropIfExists('IUIs');
    }
}
