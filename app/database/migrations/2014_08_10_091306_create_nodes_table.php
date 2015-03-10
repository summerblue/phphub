<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNodesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->nullable()->index();
            $table->smallInteger('parent_node')->nullable()->index();
            $table->text('description')->nullable();
            $table->integer('topic_count')->default(0)->index();
            $table->timestamps();
        });

        $this->initializeNodes();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nodes');
    }

    public function initializeNodes()
    {
        DB::table('nodes')->truncate();
        $node_array = [
            'PHP' => [
                'php' => [
                    'slug' => 'php',
                    'description' => 'PHP（PHP: Hypertext Preprocessor的缩写，中文名：“PHP：超文本预处理器”）是一种通用开源脚本语言。',
                ],
                'Laravel' => [
                    'slug' => 'laravel',
                    'description' => 'Laravel是一套简洁、优雅的PHP Web开发框架(PHP Web Framework)。它可以让你从面条一样杂乱的代码中解脱出来；它可以帮你构建一个完美的网络APP，而且每行代码都可以简洁、富于表达力。',
                ],
                'Composer & Packagist' => [
                    'slug' => 'composer-and-packagist',
                    'description' => 'Composer[1]是PHP中用来管理依赖（dependency）关系的工具。你可以在自己的项目中声明所依赖的外部工具库（libraries），Composer会帮你安装这些依赖的库文件。',
                ],
                '重构' => [
                    'slug' => 'refactoring',
                    'description' => '由于软件发展本身不可能是完美的，因此改进的过程是持续且必然的，重构的方式将作为改善软件设计的一种手段和方式，更加地拥有现实意义。',
                ],
                '设计模式' => [
                    'slug' => 'design-pattern',
                    'description' => '设计模式（Design pattern）是一套被反复使用、多数人知晓的、经过分类编目的、代码设计经验的总结。使用设计模式是为了可重用代码、让代码更容易被他人理解、保证代码可靠性。',
                ],
                'Testing' => [
                    'slug' => 'testing',
                    'description' => '软件测试（英语：software testing），描述一种用来促进鉴定软件的正确性、完整性、安全性和质量的过程。',
                ],
                '部署' => [
                    'slug' => 'deployment',
                    'description' => '',
                ],
                '开源项目' => [
                    'slug' => 'opensource-project',
                    'description' => '',
                ],
            ],
            'Web 开发' => [
                'MySQL' => [
                    'slug' => 'mysql',
                    'description' => 'MySQL是一个关系型数据库管理系统，由瑞典MySQL AB公司开发，目前属于Oracle公司。',
                ],
                'Database' => [
                    'slug' => 'database',
                    'description' => '数据库（Database）是按照数据结构来组织、存储和管理数据的仓库',
                ],
                'Git' => [
                    'slug' => 'git',
                    'description' => 'Git是一个开源的分布式版本控制系统，用以有效、高速的处理从很小到非常大的项目版本管理。',
                ],
                'Linux' => [
                    'slug' => 'linux',
                    'description' => 'Linux是一种自由和开放源码的类Unix操作系统，存在着许多不同的Linux版本，但它们都使用了Linux内核。',
                ],
                'WebServer' => [
                    'slug' => 'web-server',
                    'description' => 'WEB服务器也称为WWW(WORLD WIDE WEB)服务器，主要功能是提供网上信息浏览服务。常见的有 Nginx, Apache..',
                ],
                '算法' => [
                    'slug' => 'algrithm',
                    'description' => '算法（Algorithm）是指解题方案的准确而完整的描述，是一系列解决问题的清晰指令，算法代表着用系统的方法描述解决问题的策略机制。',
                ],
                '运维' => [
                    'slug' => 'operations',
                    'description' => '',
                ],
                '安全' => [
                    'slug' => 'security',
                    'description' => '',
                ],
                '云服务' => [
                    'slug' => 'cloud-service',
                    'description' => '云服务开发这一概念包含几种不同的开发类型 - 软件即服务(SaaS), 平台即服务(PaaS), Web服务, 按需(on—demand)计算',
                ],
            ],
            'Mobile' => [
                'iPhone' => [
                    'slug' => 'iphone-development',
                    'description' => 'iPhone 开发',
                ],
                'Android' => [
                    'slug' => 'android-development',
                    'description' => 'Android 开发',
                ],
            ],
            'Languages' => [
                'JavaScript' => [
                    'slug' => 'javascript',
                    'description' => 'JavaScript是一种基于对象和事件驱动并具有相对安全性的客户端脚本语言。',
                ],
                'Ruby' => [
                    'slug' => 'ruby',
                    'description' => 'Ruby，一种为简单快捷的面向对象编程（面向对象程序设计）而创的脚本语言',
                ],
                'Python' => [
                    'slug' => 'python',
                    'description' => 'Python, 是一种面向对象、直译式计算机程序设计语言',
                ],
                'GoLang' => [
                    'slug' => 'golang',
                    'description' => 'Go语言是谷歌推出的一种全新的编程语言，可以在不损失应用程序性能的情况下降低代码的复杂性。',
                ],
                'Erlang' => [
                    'slug' => 'erlang',
                    'description' => 'Erlang是一种通用的面向并发的编程语言，它由瑞典电信设备制造商爱立信所辖的CS-Lab开发，目的是创造一种可以应对大规模并发活动的编程语言和运行环境。',
                ],
            ],
            '社区' => [
                '公告' => [
                    'slug' => 'announcement',
                    'description' => '',
                ],
                '反馈' => [
                    'slug' => 'feedback',
                    'description' => '对于社区的优化或者 bug report , 可以在此节点下提',
                ],
                '社区开发' => [
                    'slug' => 'community-development',
                    'description' => '构建此社区软件的开发讨论节点',
                ],
                '线下聚会' => [
                    'slug' => 'gathering',
                    'description' => '',
                ],
            ],
            '分享' => [
                '健康' => [
                    'slug' => 'health',
                    'description' => '',
                ],
                '工具' => [
                    'slug' => 'toolings',
                    'description' => '使用工具, 是人类文明的标志',
                ],
                '其他' => [
                    'slug' => 'other-share',
                    'description' => '抱歉, 如果你分享的话题不属于其他节点的话, 只能选择这里咯. ',
                ],
                '书籍' => [
                    'slug' => 'book-share',
                    'description' => '书籍是知识载体, 让我们一起站在巨人的肩膀上. ',
                ],
                '求职' => [
                    'slug' => 'request-a-job',
                    'description' => '介绍下你自己, 让大家帮你找到一份好的工作',
                ],
                '招聘' => [
                    'slug' => 'hire',
                    'description' => '这里有高质量的 PHPer, 记得认真填写你的需求, 薪资待遇是必须写的哦.',
                ],
                '创业' => [
                    'slug' => 'start-up',
                    'description' => '',
                ],
                '移民' => [
                    'slug' => 'immigration',
                    'description' => '',
                ],
            ]
        ];

        $top_nodes = array();
        foreach ($node_array as $key => $value) {
            $top_nodes[] = [
                'name' => $key
            ];
        }
        DB::table('nodes')->insert($top_nodes);

        $nodes = array();
        foreach ($node_array as $key => $value) {
            $top_node = Node::where('name', '=', $key)->first();

            foreach ($value as $snode => $svalue) {
                $nodes[] = [
                    'parent_node' => $top_node->id,
                    'name' => $snode,
                    'slug' => $svalue['slug'],
                    'description' => $svalue['description'],
                ];
            }
        }
        DB::table('nodes')->insert($nodes);
    }
}
