<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('github_id');
			$table->string('github_url');
			$table->string('email')->nullable();
			$table->string('name')->nullable();
			$table->string('remember_token')->nullable();
			$table->boolean('is_banned')->default(false);
			$table->string('image_url')->nullable();
			$table->integer('topic_count')->default(0);
			$table->integer('reply_count')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
