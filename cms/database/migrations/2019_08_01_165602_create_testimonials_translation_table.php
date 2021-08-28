<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testimonials_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->unique(['testimonials_id','locale']);
            $table->foreign('testimonials_id')->references('id')->on('testimonials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonials_translation');
    }
}
