<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->string('locale')->index();

			$table->unique(['menu_id','locale']);
			$table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_translation');
    }
}
