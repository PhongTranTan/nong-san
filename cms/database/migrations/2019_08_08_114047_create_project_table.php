<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('tenure_id')->unsigned()->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->text('project_grid')->nullable();
            $table->string('project_logo')->nullable();
            $table->string('project_more_url')->nullable();
            $table->longText('project_gallery')->nullable();
            $table->text('project_background_section')->nullable();
            $table->string('project_watermark')->nullable();
            $table->integer('project_watermark_position')->default(0)->nullable();
            $table->integer('project_lastest_launches')->default(0)->nullable();
            $table->integer('project_heavily_discount')->default(0)->nullable();
            $table->integer('project_investor')->default(0)->nullable();
            $table->integer('project_mear_mrt')->default(0)->nullable();
            $table->integer('project_price')->default(0)->nullable();
            $table->text('project_price_table')->nullable();
            $table->text('project_price_images')->nullable();
            $table->integer('active')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('district')->onDelete('cascade');
            $table->foreign('tenure_id')->references('id')->on('tenure')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
