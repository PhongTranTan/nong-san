<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMutiColumnToProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->text('image_pdf_all')->nullable();
            $table->text('pdf_all')->nullable();
            $table->tinyInteger('show_pdf')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->dropColumn('image_pdf_all');
            $table->dropColumn('pdf_all');
            $table->dropColumn('show_pdf');
        });
    }
}
