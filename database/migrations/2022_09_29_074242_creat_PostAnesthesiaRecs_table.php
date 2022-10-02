<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatPostAnesthesiaRecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PostAnesthesiaRecs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientid');
            $table->bigInteger('createdbyid');
            $table->string('filelink')->nullable();
            $table->date('docdate')->nullable();
            $table->time('doctime')->nullable();
            $table->bigInteger('AnesthetestStaffId')->nullable();
            $table->bigInteger('SurgeonStaffId')->nullable();
            $table->integer('IsTypAneGA')->nullable();
            $table->integer('IsTypAneMAC')->nullable();
            $table->integer('IsTypAneRegAne')->nullable();
            $table->integer('IsTypAneOthers')->nullable();
            $table->longText('DruInRec')->nullable();
            $table->integer('IsCriDisCon')->nullable();
            $table->integer('IsCriDisAct')->nullable();
            $table->integer('IsCriDisBre')->nullable();
            $table->integer('IsCriDisCir')->nullable();
            $table->integer('IsCriDisOxySat')->nullable();
            $table->string('TotalScore')->nullable();
            $table->longText('DisInsAndRem')->nullable();
            $table->bigInteger('RecNurStaffId')->nullable();
            $table->date('DisDate')->nullable();
            $table->time('DisTime')->nullable();
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
        Schema::dropIfExists('PostAnesthesiaRecs');
    }
}
