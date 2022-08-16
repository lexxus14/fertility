<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadreminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('patientid')->nullable();
            $table->date('date_reminder')->nullable();
            $table->string('time_reminder')->nullable();
            $table->integer('reasonid')->nullable();
            $table->integer('staffid')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('is_read')->nullable();
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
        Schema::dropIfExists('lead_reminders');
    }
}
