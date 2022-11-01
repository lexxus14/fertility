<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntOpAneRecTotalDoseDrugsTable extends Migration
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Preoperative Checklist";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IntOpeAneRecTotalDoseDrugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('IntraOperaAnesRecId')->unsigned();
            $table->foreign('IntraOperaAnesRecId')->references('id')->on('IntraOperAnesRecs')->onDelete('cascade');
            $table->bigInteger('MedId')->nullable();
            $table->string('UnitId')->nullable();
            $table->string('Dose')->nullable();
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
        Schema::dropIfExists('IntOpeAneRecTotalDoseDrugs');
    }
}
