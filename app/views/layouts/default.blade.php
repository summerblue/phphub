<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		
		<title>
			@section('title')
PHPhub - PHP & Laravel的中文社区
			@show
		</title>

		<meta name="keywords" content="PHP,Laravel,PHP论坛,Laravel论坛,PHP社区,Laravel社区" />
		<meta name="author" content="The PHP China Community." />
		<meta name="description" content="PHPhub是 PHP 和 Laravel 的中文社区，在这里我们讨论技术, 分享技术。" />

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	
		<base href="{{ Config::get('app.url') }}">
		
		<link rel="stylesheet" href="css/main.css">

    @yield('styles')

	</head>
	<body>

		<div id="wrap">
			
			@include('layouts.partials.nav')

			<div class="container">

				@include('flash::message')
			
				@yield('content')
				
			</div>
	
		</div>
		
	  <div id="footer" class="footer">
	    <div class="container">
	      <p class="small"><i class="glyphicon glyphicon-heart text-danger"></i> Lovingly Made By The EST Group.</p>
	    </div>
	  </div>

		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X');ga('send','pageview');
		</script>

		<script src="//code.jquery.com/jquery.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/holder/2.3.1/holder.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/lang/zh-cn.min.js"></script>
		<script src="js/main.js"></script>
    @yield('scripts')

	</body>
</html>