<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationTitleToProjecTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_translation', function (Blueprint $table) {
            $table->string('project_price_subtitle')->nullable();
            $table->string('location_title')->nullable();
            $table->string('location_subtitle')->nullable();
            $table->text('location_description')->nullable();
            $table->string('gallery_title')->nullable();
            $table->string('gallery_subtitle')->nullable();
            $table->text('gallery_description')->nullable();
            $table->string('floorplan_title')->nullable();
            $table->string('floorplan_subtitle')->nullable();
            $table->text('floorplan_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
