<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiborRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sibor_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('month_sibor')->nullable();
            $table->longText('percent_sibor')->nullable();
            $table->integer('active')->default(0)->nullable();
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sibor_rates');
    }
}
