<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_item', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('level')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('referencer_id')->nullable();

            $table->string('type')->default('custom_link');
            $table->string('class')->nullable();
            $table->string('target')->nullable();
            $table->integer('position')->nullable();
            $table->tinyInteger('active')->index()->default(0);

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
        Schema::dropIfExists('menu_item');
    }
}
