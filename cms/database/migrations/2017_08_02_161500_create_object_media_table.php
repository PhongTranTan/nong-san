<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->index()->nullable(); // product, product_block, ....
            $table->integer('object_id')->unsigned();
            $table->string('path')->nullable();// image_map => code
            $table->smallInteger('position')->default(0);
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
        Schema::dropIfExists('object_media');
    }
}
