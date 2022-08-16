<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricelistsubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_subs', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('pricelistid');
            $table->integer('medicineid')->nullable();
            $table->decimal('qty', 5, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
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
        Schema::dropIfExists('price_list_subs');
    }
}
