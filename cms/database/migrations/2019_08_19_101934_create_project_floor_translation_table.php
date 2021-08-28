<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFloorTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_floor_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_floor_id')->unsigned()->nullable();
            $table->string('locale')->nullable();
            $table->text('content')->nullable();
            $table->text('unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_floor_translation');
    }
}
