<!--
______                            _              _                                     _
| ___ \                          | |            | |                                   | |
| |_/ /___ __      __ ___  _ __  | |__   _   _  | |      __ _  _ __  __ _ __   __ ___ | |
|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | | | |     / _` || '__|/ _` |\ \ / // _ \| |
| |  | (_) |\ V  V /|  __/| |    | |_) || |_| | | |____| (_| || |  | (_| | \ V /|  __/| |
\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \_____/ \__,_||_|   \__,_|  \_/  \___||_|
                                          __/ |
                                         |___/
  ========================================================
                                           phphub.org

  --------------------------------------------------------
  Laravel: v4.2.8
-->

<!DOCTYPE html>
<html lang="zh">
	<head>

		<meta charset="UTF-8">

		<title>
			@section('title')
PHPhub - PHP & Laravel的中文社区
			@show
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<meta name="keywords" content="PHP,Laravel,PHP论坛,Laravel论坛,PHP社区,Laravel社区" />
		<meta name="author" content="The PHP China Community." />
		<meta name="description" content="@section('description') PHPhub是 PHP 和 Laravel 的中文社区，在这里我们讨论技术, 分享技术。 @show" />

		<link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//cdn.staticfile.org/font-awesome/4.1.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ cdn('css/main.css') }}">
        <link rel="stylesheet" href="{{ cdn('css/markdown.css') }}">
		<link rel="stylesheet" href="{{ cdn('css/nprogress.css') }}">
        <link rel="stylesheet" href="{{ cdn('css/prism.css') }}">

        <link rel="shortcut icon" href="{{ cdn('favicon.ico') }}"/>

        <script>
            Config = {
                'cdnDomain': '{{ getCdnDomain() }}',
            };
        </script>

	    @yield('styles')

	</head>
	<body id="body">

		<div id="wrap">

			@include('layouts.partials.nav')

			<div class="container">

				@include('flash::message')

				@yield('content')

			</div>

		</div>

	  <div id="footer" class="footer">
	    <div class="container small">
	      <p class="pull-left">
	      	<i class="fa fa-heart-o"></i> Lovingly Made By The EST Group. <br>
			&nbsp;<i class="fa fa-lightbulb-o"></i> Inspire by v2ex & ruby-china.
	      </p>

	      <p class="pull-right">
	      	<i class="fa fa-cloud"></i> Power by <a href="https://www.linode.com/?r=3cfb2c09c29cf2b6e6c87cc1f71ffdc2f9ea5722" target="_blank">Linode <i class="fa fa-external-link"></i></a>.
	      </p>
	    </div>
	  </div>

		<script src="//cdn.staticfile.org/jquery/1.11.1/jquery.min.js"></script>
		<script src="//cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="//cdn.staticfile.org/holder/2.3.1/holder.min.js"></script>
		<script src="//cdn.staticfile.org/moment.js/2.7.0/moment.min.js"></script>
        @if (Lang::locale() == 'zh-CN')
            <script src="//cdn.staticfile.org/moment.js/2.7.0/lang/zh-cn.min.js"></script>
        @endif

		<script src="{{ cdn('js/emojify.min.js') }}"></script>
		<script src="{{ cdn('js/marked.min.js') }}"></script>
        <script src="{{ cdn('js/jquery.scrollUp.js') }}"></script>
        <script src="{{ cdn('js/jquery.pjax.js') }}"></script>
		<script src="{{ cdn('js/nprogress.js') }}"></script>

        <script src="{{ cdn('js/jquery.autosize.min.js') }}"></script>
        <script src="{{ cdn('js/prism.js') }}"></script>
        <script src="{{ cdn('js/main.js') }}"></script>

	    @yield('scripts')

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-53903425-1', 'auto');
		  ga('send', 'pageview');
		</script>

	</body>
</html>
