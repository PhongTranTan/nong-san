<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurposeTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purpose_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purpose_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();

            $table->unique(['purpose_id','locale']);
            $table->foreign('purpose_id')->references('id')->on('purpose')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
