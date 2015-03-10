<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteStatusesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day')->index();
            $table->integer('register_count')->default(0);
            $table->integer('topic_count')->default(0);
            $table->integer('reply_count')->default(0);
            $table->integer('image_count')->default(0);
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
        Schema::drop('site_statuses');
    }
}
