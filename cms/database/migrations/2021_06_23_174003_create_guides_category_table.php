<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidesCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1)->comment('0: Tắt, 1: Bật');
            $table->text('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('guides_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guides_category_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();

            $table->unique(['guides_category_id','locale']);
            $table->foreign('guides_category_id')->references('id')->on('guides_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guides_category_translation');
        Schema::dropIfExists('guides_categories');
    }
}
