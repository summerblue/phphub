<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('link');
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
        Schema::drop('links');
    }

    public function initData()
    {
        $links = [
            [
                'title' => 'Ruby China',
                'link' => 'https://ruby-china.org',
            ],
            [
                'title' => 'V2EX',
                'link' => 'http://v2ex.com/',
            ],
            [
                'title' => 'Golang 中国',
                'link' => 'http://golangtc.com/',
            ],
            [
                'title' => 'CNode：Node.js 中文社区',
                'link' => 'http://cnodejs.org/',
            ],
            [
                'title' => 'F2E - 前端技术社区',
                'link' => 'http://f2e.im/',
            ],
            [
                'title' => '知乎',
                'link' => 'http://zhihu.com/',
            ]
        ];
        DB::table('links')->insert($links);
    }
}
