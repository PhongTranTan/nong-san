<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_title')->nullable();
            $table->string('url')->nullable();
            $table->text('project_choose')->nullable();
            $table->text('estimate_rental')->nullable();
            $table->text('estimate_capital')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_report');
    }
}
