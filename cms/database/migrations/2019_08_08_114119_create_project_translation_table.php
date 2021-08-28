<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('project_address')->nullable();
            $table->string('project_location')->nullable();
            $table->text('project_ticker_text')->nullable();
            $table->text('project_tag')->nullable();
            $table->longText('project_text_grid')->nullable();
            $table->string('project_price_title')->nullable();
            $table->text('project_price_description')->nullable();
            $table->text('project_price_name_detail')->nullable();

            $table->unique(['project_id','locale']);
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_translation');
    }
}
