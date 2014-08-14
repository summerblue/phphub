<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) 
		{
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->integer('user_id');
			$table->integer('node_id');
			$table->boolean('is_excellent')->default(false);
			$table->boolean('is_wiki')->default(false);
			$table->boolean('is_blocked')->default(false);
			$table->integer('reply_count')->default(0);
			$table->integer('view_count')->default(0);
			$table->integer('favorite_count')->default(0);
			$table->integer('vote_count')->default(0);
			$table->integer('last_reply_user_id')->default(0);
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
		Schema::drop('topics');
	}

}
