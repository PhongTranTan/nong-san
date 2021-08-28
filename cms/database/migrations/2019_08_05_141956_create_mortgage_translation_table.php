<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMortgageTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mortgage_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mortgage_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('issurer')->nullable();
            $table->text('benefits')->nullable();

            $table->unique(['mortgage_id','locale']);
            $table->foreign('mortgage_id')->references('id')->on('mortgage')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mortgage_translation');
    }
}
