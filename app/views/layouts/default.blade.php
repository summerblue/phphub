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
                                           php-china.org

  --------------------------------------------------------
  Laravel: v4.2.8
-->

<!DOCTYPE html>
<html lang="zh">
	<head>

		<meta charset="UTF-8">

		<title>
			@section('title')
PHPHub  - PHP & Laravel的中文社区
			@show
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<meta name="keywords" content="PHP,Laravel,PHP论坛,Laravel论坛,PHP社区,Laravel社区" />
		<meta name="author" content="The PHP China Community." />
		<meta name="description" content="@section('description') PHP China 是 PHP 和 Laravel 的中文社区，致力于推动 Laravel, php-fig 等国外 PHP 新技术, 新理念在中国的发展。 @show" />

        <link rel="stylesheet" href="{{ cdn('assets/css/'.Asset::styles('frontend')) }}">

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

        <script src="{{ cdn('assets/js/'.Asset::scripts('frontend')) }}"></script>

	    @yield('scripts')

        @if (App::environment() == 'production')
		<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-54336572-1', 'auto');
          ga('send', 'pageview');

        </script>
        @endif

	</body>
</html>
