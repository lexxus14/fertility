<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOpeChkLstVitalSignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PreOpeChkLstVitalSigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PreOperaChecklistsId')->unsigned();
            $table->foreign('PreOperaChecklistsId')->references('id')->on('PreOperaChecklists')->onDelete('cascade');
            $table->bigInteger('VitalSignId')->unsigned();
            $table->string('VitalSignRes')->nullable();
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
        Schema::dropIfExists('PreOpeChkLstVitalSigns');
    }
}
