@extends('layouts.default')

@section('title')
关于我们_@parent 
@stop

@section('content')
	
<?php 
	$body = <<<MARKDOWN

# 关于 PHPHub

PHPHub 是积极向上的 PHP & Laravel 开发者社区. 

在这里没有商业广告, 没有灌水, 没有千篇一律新手问答, 有的是关于新技术的讨论和分享. 

本项目 [源代码在此 at Github](https://github.com/summerblue/phphub), 欢迎贡献代码, Feature Request 和 Bug Report [请到此发表](https://github.com/summerblue/phphub/issues).


## 关于新手问题

这个社区不是用来问新手问题的, 如果你是新手, 请先看 http://www.phptherightway.com/ , 此文档能给你构建一个合理的 PHP 基本知识体系. 

第一次接触 Laravel? 这里是 [官方文档](http://laravel.com/docs/quick), 多看几遍, 你想知道的都在那里面. 

在学习上遇到问题的时候, 请先 Google. 

如果觉得你的问题比较独占, 需要单独提问的话, 请到 http://segmentfault.com/t/php 发表你的问题, 谢谢. 

## 远景 Vision 

### 在这里的我们

* 热爱开源, 尊重开源;
* 热爱技术, 为最新最潮的技术狂热;
* 热爱学习, 热爱互联网;
* 热爱 PHP & Laravel;

### 在这里我们可以 

* 分享生活见闻, 分享知识
* 接触新技术
* 为自己的创业项目找合伙人
* 讨论技术解决方案
* 自发线下聚会
* 遇见志同道合的人
* 发现更好工作机会
* 甚至是开始另一个神奇的开源项目
* ... 

### 在这里我们不可以 

* 这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题 
* 这里绝对不会全文转载任何文章，而只会以链接方式分享 
* 这里感激和崇尚美的事物 
* 这里尊重原创 
* 这里反对中文互联网上的无信息量习惯如“顶”，“沙发”，“前排”，“留名”，“路过” 

## Laravel?

为什么是 Laravel? 为什么不是 CI, Symfony, CakePHP, ThinkPHP ... 

Because Laravel is amazing and It is the future.

http://www.zhihu.com/question/19558755/answer/23062110 

MARKDOWN;

?>

	<div class="panel">

		<div class="panel-body">
			@include('topics.partials.body', array('body' => $body))
		</div>
	</div>

@stop