<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGuidesCategoryIdToGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guides', function (Blueprint $table) {
            $table->integer('guides_category_id')->nullable()->unsigned();
            $table->foreign('guides_category_id')->nullable()->references('id')->on('guides_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guides', function (Blueprint $table) {
            $table->dropForeign(['guides_category_id']);
            $table->dropColumn('guides_category_id');
        });
    }
}
