<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAccountsTable.
 */
class CreateCustomerTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function(Blueprint $table) {
            $table->increments('id');
            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->text('bio')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->text('company_bio')->nullable();

            $table->string('password')->nullable();

            $table->unsignedInteger('city_id')->nullable();

            $table->dateTime('last_logon')->nullable();

            $table->tinyInteger('active')->default(0);

            $table->string('active_code', 50)->index()->unique()->nullable();

            $table->rememberToken();

            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('city')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer');
	}
}
