# PHPhub 开发环境部署

**Table of Contents**  由 [DocToc](http://doctoc.herokuapp.com/) 生成

- [PHPhub 开发环境部署](#user-content-phphub-%E5%BC%80%E5%8F%91%E7%8E%AF%E5%A2%83%E9%83%A8%E7%BD%B2)
- [项目代码和文件夹结构](#user-content-%E9%A1%B9%E7%9B%AE%E4%BB%A3%E7%A0%81%E5%92%8C%E6%96%87%E4%BB%B6%E5%A4%B9%E7%BB%93%E6%9E%84)
	- [克隆源代码](#user-content-%E5%85%8B%E9%9A%86%E6%BA%90%E4%BB%A3%E7%A0%81)
- [虚拟机](#user-content-%E8%99%9A%E6%8B%9F%E6%9C%BA)
	- [安装 virtualbox 和 vagrant](#user-content-%E5%AE%89%E8%A3%85-virtualbox-%E5%92%8C-vagrant)
	- [加入 homestead box](#user-content-%E5%8A%A0%E5%85%A5-homestead-box)
	- [命令行下下载速度太慢的话可以利用工具下载以下链接加速.](#user-content-%E5%91%BD%E4%BB%A4%E8%A1%8C%E4%B8%8B%E4%B8%8B%E8%BD%BD%E9%80%9F%E5%BA%A6%E5%A4%AA%E6%85%A2%E7%9A%84%E8%AF%9D%E5%8F%AF%E4%BB%A5%E5%88%A9%E7%94%A8%E5%B7%A5%E5%85%B7%E4%B8%8B%E8%BD%BD%E4%BB%A5%E4%B8%8B%E9%93%BE%E6%8E%A5%E5%8A%A0%E9%80%9F)
	- [克隆 homestead 项目](#user-content-%E5%85%8B%E9%9A%86-homestead-%E9%A1%B9%E7%9B%AE)
	- [修改 homestead 的配置](#user-content-%E4%BF%AE%E6%94%B9-homestead-%E7%9A%84%E9%85%8D%E7%BD%AE)
	- [配置 hosts 文件](#user-content-%E9%85%8D%E7%BD%AE-hosts-%E6%96%87%E4%BB%B6)
	- [初始化 homestead 虚拟机](#user-content-%E5%88%9D%E5%A7%8B%E5%8C%96-homestead-%E8%99%9A%E6%8B%9F%E6%9C%BA)
	- [其他配置](#user-content-%E5%85%B6%E4%BB%96%E9%85%8D%E7%BD%AE)
	- [关于虚拟机里面的软件使用](#user-content-%E5%85%B3%E4%BA%8E%E8%99%9A%E6%8B%9F%E6%9C%BA%E9%87%8C%E9%9D%A2%E7%9A%84%E8%BD%AF%E4%BB%B6%E4%BD%BF%E7%94%A8)
		- [PHP](#user-content-php)
		- [MYSQL](#user-content-mysql)
- [设置数据库连接](#user-content-%E8%AE%BE%E7%BD%AE%E6%95%B0%E6%8D%AE%E5%BA%93%E8%BF%9E%E6%8E%A5)
- [安装 phphub](#user-content-%E5%AE%89%E8%A3%85-phphub)
	- [安装依赖包](#user-content-%E5%AE%89%E8%A3%85%E4%BE%9D%E8%B5%96%E5%8C%85)
	- [处理数据库](#user-content-%E5%A4%84%E7%90%86%E6%95%B0%E6%8D%AE%E5%BA%93)
	- [codeception 与 BDD](#user-content-codeception-%E4%B8%8E-bdd)
- [assets management](#user-content-assets-management)
	- [安装 gulp](#user-content-%E5%AE%89%E8%A3%85-gulp)
- [基本的开发知识](#user-content-%E5%9F%BA%E6%9C%AC%E7%9A%84%E5%BC%80%E5%8F%91%E7%9F%A5%E8%AF%86)
	- [使用了以下的 package](#user-content-%E4%BD%BF%E7%94%A8%E4%BA%86%E4%BB%A5%E4%B8%8B%E7%9A%84-package)
	- [规划 blade 模版结构](#user-content-%E8%A7%84%E5%88%92-blade-%E6%A8%A1%E7%89%88%E7%BB%93%E6%9E%84)
- [Git 版本控制](#user-content-git-%E7%89%88%E6%9C%AC%E6%8E%A7%E5%88%B6)
	- [关于 .gitignore 文件里去除 composer.lock 的原因](#user-content-%E5%85%B3%E4%BA%8E-gitignore-%E6%96%87%E4%BB%B6%E9%87%8C%E5%8E%BB%E9%99%A4-composerlock-%E7%9A%84%E5%8E%9F%E5%9B%A0)
		

## 项目代码和文件夹结构

### 克隆源代码

创建一个新文件夹, 此文件夹用来存放 phphub 开发相关的代码和虚拟机配置

	mkdir phphub.org
	cd phphub.org

在 `phphub.org` 文件夹下: 

	git clone https://github.com/summerblue/phphub

## 虚拟机

本项目使用 [Laravel Homestead](http://laravel.com/docs/homestead) , 利用 [VirtualBox](https://www.virtualbox.org/wiki/Downloads) 和 [Vagrant](http://www.vagrantup.com/downloads.html) 来统一开发环境. 

### 安装 virtualbox 和 vagrant

在这里下载 [VirtualBox](https://www.virtualbox.org/wiki/Downloads) , [Vagrant](http://www.vagrantup.com/downloads.html)

### 加入 homestead box

执行以下命令添加 box

	vagrant box add laravel/homestead

### 命令行下下载速度太慢的话可以利用工具下载以下链接加速. 

> https://vagrantcloud.com/laravel/homestead/version/8/provider/virtualbox.box 

下载后执行以下命令, 注意修改 `/path/to/virtualbox.box` 为正确的 path.

	vagrant box add laravel/homestead /path/to/virtualbox.box 

### 克隆 homestead 项目

在文件夹 `phphub.org` 下克隆 homestead 项目到本地

	git clone https://github.com/laravel/homestead.git Homestead
	
### 修改 homestead 的配置

根据你的情况修改 Homestead 项目里面文件 Homestead.yaml , 类似以下

	---
	ip: "192.168.10.10"
	memory: 2048
	cpus: 1

	authorize: /Users/charliejade/.ssh/id_rsa.pub

	keys:
	    - /Users/charliejade/.ssh/id_rsa

	folders:
	    - map: /Users/charliejade/Projects/phphub.org/phphub
	      to: /home/vagrant/phphub

	sites:
	    - map: phphub.app
	      to: /home/vagrant/phphub/public

	variables:
	    - key: APP_ENV
	      value: local


### 配置 hosts 文件

	sudo vi /etc/hosts 
	
添加以下一行
	
	127.0.0.1    phphub.app

### 初始化 homestead 虚拟机

	cd Homestead
	vagrant up 

以上配置正确的话会有类似以下输出

	➜  Homestead git:(master) ✗ vagrant up
	Bringing machine 'default' up with 'virtualbox' provider...
	==> default: Importing base box 'laravel/homestead'...
	==> default: Matching MAC address for NAT networking...
	==> default: Setting the name of the VM: Homestead_default_1407410586606_38332
	==> ... etc....
	==> default: php5-fpm stop/waiting
	==> default: php5-fpm start/running, process 1945
	
测试是否能成功连接, 虚拟机里的 `~/phphub` 文件夹里的文件和本地的文件是一致的. 

	vagrant ssh 
	cd ~
	cd phphub
	ll
	
浏览器访问 [http://phphub.app:8000/](http://phphub.app:8000/) .

至此, 成功安装.

### 其他配置

这时  `phphub.org` 的文件夹结构如下: 

	➜ ls
	Homestead  phphub

可以在 dotfile 里面增加 alias 进行快速连接 vm

	alias vm="ssh vagrant@127.0.0.1 -p 2222"
	
这样以后直接使用 `vm` 就可进入 虚拟机了. 
	
### 关于虚拟机里面的软件使用

#### PHP

`vm` 进入虚拟机以后, 查看 php 版本

	vagrant@homestead:~$ php -v
	PHP 5.5.15RC1 (cli) (built: Jul 15 2014 11:14:55)
	Copyright (c) 1997-2014 The PHP Group
	Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
	    with Zend OPcache v7.0.4-dev, Copyright (c) 1999-2014, by Zend Technologies
	    with Xdebug v2.2.5, Copyright (c) 2002-2014, by Derick Rethans

#### MYSQL 

查看版本

	vagrant@homestead:~$ mysql --version
	mysql  Ver 14.14 Distrib 5.5.38, for debian-linux-gnu (x86_64) using readline 6.3

vm 下命令行链接, 密码为 `secret`

	mysql -uhomestead -p 

默认提供 homestead 数据库

	mysql> show databases;
	+--------------------+
	| Database           |
	+--------------------+
	| information_schema |
	| homestead          |
	| mysql              |
	| performance_schema |
	+--------------------+
	4 rows in set (0.00 sec)
	
顺便创建数据库 `phphub` 

	mysql> create database phphub;
	Query OK, 1 row affected (0.00 sec)


## 设置数据库连接

利用 laravel 4.1 有一个很贴心的功能, 允许自定义设置项目环境变量, 具体功能见 [这里](http://laravel.com/docs/configuration#protecting-sensitive-configuration) .

在 `app/config/database.php` 文件里使用环境变量来控制数据库连接信息

	'mysql' => array(
		'driver'    => 'mysql',
		'host'      => getenv('DB_HOST'),
		'database'  => getenv('DB_NAME'),
		'username'  => getenv('DB_USERNAME'),
		'password'  => getenv('DB_PASSWORD'),
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix'    => '',
	),

在项目的根文件下创建文件 `.env.local.php` 文件, 参照根目录下文件 `env.example.php`: 

	<?php

	return [
		'DB_HOST'     => 'localhost',
		'DB_NAME'     => 'phphub',
		'DB_USERNAME' => 'homestead',
		'DB_PASSWORD' => 'secret',
	];


本机连接 vm 里面的 mysql 方法是: 

	host: 127.0.0.1
	port: 33060
	user: homestead
	pass: secret

关于 vm 里面其他服务的 port 信息请见 [文档](http://laravel.com/docs/homestead#ports) 


## 安装 phphub


### 安装依赖包

vm 到虚拟机下

	cd ~/phphub
	composer install --prefer-dist

> 注: ` --prefer-dist` 会加快下载速度. 

### 处理数据库

vm 下执行以下命令

	cd ~/phphub
	php artisan migrate --seed 


### codeception 与 BDD 

创建  `.env.testing.php` 文件, 内容和  `.env.local.php`  一样.

在根目录下直接运行, 可以见 `codecept` 的用法
	
	vendor/bin/codecept
	
运行测试

	vendor/bin/codecept run
	

## assets management 

我们使用 Gulp 自动化的工具来做 scss 编译, 文件合并 etc... , [项目地址](http://gulpjs.com/)

### 安装 gulp 

Homestead 里已经安装了 nodejs , npm, gulp.

这里我们只需要做些配置就行.

进入 vm

	vm
	cd ~/phphub
	npm install
	
在 vm 项目文件夹中运行 `gulp` 命令, 开始运行自动化脚本
	
	vagrant@homestead:~/phphub$ gulp
	[05:13:11] Using gulpfile ~/phphub/Gulpfile.js
	[05:13:11] Starting 'watch'...
	[05:13:11] Finished 'watch' after 8.76 ms
	[05:13:11] Starting 'default'...
	[05:13:11] Finished 'default' after 6.37 μs
	
> 注意: `/public/css` 和 `public/js` 文件夹为自动生成的文件, 请修改 `app/assets/` 下的文件. 


## 基本的开发知识


### 使用了以下的 `package` 

* [generator](https://github.com/JeffreyWay/Laravel-4-Generators) 快速构架代码的工具;
* [codeception](http://codeception.com/) 用于 BDD (behavior-driven development) 测试, 快速入门在这 [Quick Start](http://codeception.com/quickstart) ;
* [clockwork](https://github.com/itsgoingd/clockwork) 集成在 chrome 的 debuger 里面, 方便调试, 尤其是 sql 的可视化;
* [laracasts/TestDummy ](https://github.com/laracasts/testdummy) 生成假数据, 在写测试的时候很方便;
* [faker](https://github.com/fzaninotto/Faker) 假数据生成, 这是在 `seed` 数据的时候使用;
* ...

### 规划 blade 模版结构

模版文件放置于 `app\view` 文件夹下, 结构大致如下: 

	➜  tree
	.
	├── auth
	│   ├── loginrequired.blade.php
	│   └── signupconfirm.blade.php
	├── emails
	│   └── auth
	│       └── reminder.blade.php
	├── layouts
	│   ├── default.blade.php
	│   └── partials
	│       ├── errors.blade.php
	│       ├── nav.blade.php
	│       └── sidebar.blade.php
	├── pages
	│   ├── about.blade.php
	│   ├── home.blade.php
	│   ├── partials
	│   └── wiki.blade.php
	├── topics
	│   ├── create.blade.php
	│   ├── edit.blade.php
	│   ├── index.blade.php
	│   ├── partials
	│   │   ├── filter.blade.php
	│   │   ├── replies.blade.php
	│   │   └── topics.blade.php
	│   └── show.blade.php
	└── users
	    └── index.blade.php

* `layouts` 放页面框架的模版文件;
* 二级目录下 `partials` 放页面的块模版文件, 利用好 `partials` 可以让模版文件更加简洁;


## Git 版本控制

### 关于 .gitignore 文件里去除 `composer.lock` 的原因

> 跟踪 `composer.lock` 的好处是当你执行 `composer update` 的时候, 有些 `package` 会更新, 有时候这个更新会威胁到项目的稳定性, 这个时候如果有这个文件来跟踪刚刚到底更新了哪些 `package`, 之前可用的 `package` 是哪个版本的话, 会很有帮助. 

同时可以发现文件 `.env.local.php` 并不会被加入到 git 的版本控制里面. 


## License

Copyright (c) 2014 PHPHub.org

Released under the MIT license:

> [www.opensource.org/licenses/MIT](http://www.opensource.org/licenses/MIT)