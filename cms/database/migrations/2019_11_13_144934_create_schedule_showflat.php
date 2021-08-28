<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleShowflat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_showflat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->integer('type')->default(0);
            $table->string('budget')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->string('property')->nullable();
            $table->text('project_id')->nullable();
            $table->text('message')->nullable();
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
