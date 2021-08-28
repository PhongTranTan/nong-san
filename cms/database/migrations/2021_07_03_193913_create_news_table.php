<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('images')->nullable();
            $table->boolean('active')->default(1)->comment('0: Tắt, 1: Bật');
            $table->boolean('highlight')->default(1)->comment('0: Tắt, 1: Bật');
            $table->date('publish_date')->nullable();
            $table->integer('news_category_id')->unsigned();
            $table->timestamps();
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade');
        });

        Schema::create('news_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')->unsigned();
            $table->string('locale')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();

            $table->unique(['news_id','locale']);
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_translation');
        Schema::dropIfExists('news');
    }
}
