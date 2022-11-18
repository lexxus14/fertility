<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbryologyRecordIITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EmbryologyRecordIIs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable(); 
            $table->date('docdate')->nullable();
            $table->string('Notes')->nullable();
            $table->string('RecordNo')->nullable();
            $table->string('CycleNo')->nullable();
            $table->date('Day0Date')->nullable();
            $table->time('Day0Time')->nullable();
            $table->bigInteger('Day0EmbryologistStaffId')->nullable();
            $table->date('Day1Date')->nullable();
            $table->time('Day1Time')->nullable();
            $table->bigInteger('Day1EmbryologistStaffId')->nullable();
            $table->date('Day3Date')->nullable();
            $table->time('Day3Time')->nullable();
            $table->bigInteger('Day3EmbryologistStaffId')->nullable();
            $table->time('Day3AhTime')->nullable();
            $table->string('Day3AhTech')->nullable();
            $table->date('Day5Date')->nullable();
            $table->time('Day5Time')->nullable();
            $table->bigInteger('Day5EmbryologistStaffId')->nullable();
            $table->time('Day5AhTime')->nullable();
            $table->string('Day5AhTech')->nullable();
            $table->date('Day6Date')->nullable();
            $table->time('Day6Time')->nullable();
            $table->bigInteger('Day6EmbryologistStaffId')->nullable();
            $table->time('Day6AhTime')->nullable();
            $table->string('Day6AhTech')->nullable();
            $table->string('Day1PtCall')->nullable();
            $table->string('Day1Initial')->nullable();
            $table->string('Day3PtCall')->nullable();
            $table->string('Day3Initial')->nullable();
            $table->string('Day5PtCall')->nullable();
            $table->string('Day5Initial')->nullable();
            $table->string('Day6PtCall')->nullable();
            $table->string('Day6Initial')->nullable();
            $table->string('AspLotNo')->nullable();
            $table->date('AspExpDate')->nullable();
            $table->string('ProteinSSSLot')->nullable();
            $table->Date('ProteinSSSExpDate')->nullable();
            $table->string('AspOthers')->nullable();
            $table->string('GlobalLotNo')->nullable();
            $table->date('GlobalExpDate')->nullable();
            $table->string('mHTFLotNo')->nullable();
            $table->date('mHTFExpDate')->nullable();
            $table->string('GlobalOther')->nullable();
            $table->string('HyluronidaseLogNo')->nullable();
            $table->date('HyluronidaseExpDate')->nullable();
            $table->string('OilLotNo')->nullable();
            $table->date('OilExpDate')->nullable();
            $table->string('GlobalOthers')->nullable();

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
        Schema::dropIfExists('EmbryologyRecordIIs');
    }
}
