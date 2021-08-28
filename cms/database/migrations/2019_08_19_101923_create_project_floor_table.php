<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFloorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_floor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('floor_category_id')->unsigned()->nullable();
            $table->integer('floor_type_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('project_floor');
    }
}
