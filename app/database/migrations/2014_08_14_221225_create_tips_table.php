<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->timestamps();
        });

        $this->initData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tips');
    }

    public function initData()
    {
        $tips = [
            ['body' => '<a href="http://laracasts.com/" target="_blank">Laracasts</a> 上面有很不错的 Laravel 开发技巧的视频，通通看完你可以学到很多东西'],
            ['body' => '<a href="http://packalyst.com/" target="_blank">Packalyst</a> 上可以了解更多 Laravel 的 package.'],
            ['body' => '<a href="http://userscape.com/laracon/2014/" target="_blank">Laracon 2014</a> 这里是 Laracon NYC 2014 的现场录像'],
            ['body' => '<a href="http://cheats.jesse-obrien.ca/" target="_blank">Laravel Cheat Sheet</a> 这里是 Laravel 的 Cheat Sheet.'],
            ['body' => 'laravel.com/docs 没事多读读文档, 每一次都可以收获不少.'],
            ['body' => 'Laravel 在 HHVM 运行单元测试 100% 通过.'],
            ['body' => 'Learn something about everything and everything about something.'],
            ['body' => 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.'],
            ['body' => 'phptherightway.com 上可以更新的 PHP 知识.'],
            ['body' => '<a href="http://www.buzzsprout.com/11908" target="_blank">Laravel.io 博客</a> - 听 Laravel 社区的几个领导者谈论技术.'],
            ['body' => 'Model::remember(5)->get(); 可以缓存 Model 五分钟'],
            ['body' => '使用 CoffeeScript 和 Sass 来写 JavaScript 和 CSS 提高开发效率'],
        ];
        DB::table('tips')->insert($tips);
    }
}
