<!DOCTYPE html>
<html lang="en">
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
		<meta name="description" content="PHPhub是 PHP 和 Laravel 的中文社区，在这里我们讨论技术, 分享技术。" />

		<link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//cdn.staticfile.org/font-awesome/4.1.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ cdn('css/main.css') }}">
		<link rel="stylesheet" href="{{ cdn('css/markdown.css') }}">

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

		<script src="//cdn.staticfile.org/jquery/1.11.1/jquery.min.js"></script>
		<script src="//cdn.staticfile.org/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="//cdn.staticfile.org/holder/2.3.1/holder.min.js"></script>
		<script src="//cdn.staticfile.org/moment.js/2.7.0/moment.min.js"></script>
		<script src="//cdn.staticfile.org/moment.js/2.7.0/lang/zh-cn.min.js"></script>

		<script src="{{ cdn('js/emojify.min.js') }}"></script>
		<script src="{{ cdn('js/marked.min.js') }}"></script>
		<script src="{{ cdn('js/main.js') }}"></script>
	    
	    <script>
	    emojify.setConfig({
			    img_dir : '{{ cdn('images/emoji') }}',
			    ignored_tags : {
			        'SCRIPT'  : 1,
			        'TEXTAREA': 1,
			        'A'       : 1,
			        'PRE'     : 1,
			        'CODE'    : 1
			    }
			});
	    </script>
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