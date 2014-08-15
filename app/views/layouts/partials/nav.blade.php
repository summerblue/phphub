
<div role="navigation" class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <a href="/" class="navbar-brand">PHPHub</a>
    </div>
    <div id="top-navbar-collapse" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="topics">社区</a></li>
        <li class="{{ (Request::is('wiki*') ? ' active' : '') }}"><a href="wiki">Wiki</a></li>
        <li class="{{ (Request::is('users*') ? ' active' : '') }}"><a href="users">会员</a></li>
        <li class="{{ (Request::is('about*') ? ' active' : '') }}"><a href="about">关于</a></li>
      </ul>
      <form role="search" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" placeholder="搜索" class="form-control mac-style"/>
        </div>
        <button type="submit" class="btn btn-default btn-circle"><i class="glyphicon glyphicon-search"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right github-login" >
        
        @if (Auth::check())
            <li><a href="{{ url($currentUser->profileUrl) }}"><i class="fa fa-user"></i> {{ $currentUser->name }}</a></li>
            <li><a class="button" href="{{ URL::route('logout') }}"><i class="fa fa-sign-out"></i> 退出</a></li>
        @else
            <a href="{{ URL::route('login') }}" class="btn btn-info" id="login-btn">
              <i class="fa fa-github-alt"></i> 
              登录
            </a>
        @endif

      </ul>
    </div>

  </div>
</div>
