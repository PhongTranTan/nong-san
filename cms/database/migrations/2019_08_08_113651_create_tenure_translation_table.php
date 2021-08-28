<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenureTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenure_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenure_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();

            $table->unique(['tenure_id','locale']);
            $table->foreign('tenure_id')->references('id')->on('tenure')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenure_translation');
    }
}
