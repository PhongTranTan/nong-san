<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1)->comment('0: Tắt, 1: Bật');
            $table->text('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('news_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_category_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();

            $table->unique(['news_category_id','locale']);
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_category_translations');
        Schema::dropIfExists('news_categories');
    }
}
