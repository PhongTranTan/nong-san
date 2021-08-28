<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(1);
            $table->text('images')->nullable();
            $table->timestamps();
        });

        Schema::create('product_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_type_id');
            $table->string('locale', 10);
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->unique(['product_type_id', 'locale'], 'product_type_translations_unique_id_locale');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_type_translations');
        Schema::dropIfExists('product_types');
    }
}
