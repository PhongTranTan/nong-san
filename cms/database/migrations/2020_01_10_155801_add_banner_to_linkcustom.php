<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerToLinkcustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('link_report', function (Blueprint $table) {
            $table->text('banner_images')->nullable();
            $table->text('banner_title')->nullable();
            $table->longText('banner_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_report', function (Blueprint $table) {
            //
        });
    }
}
