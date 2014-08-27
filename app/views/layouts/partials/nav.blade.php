
<div role="navigation" class="navbar navbar-default navbar-static-top topnav">
  <div class="container">
    <div class="navbar-header">
      <button type="button" data-toggle="collapse" data-target="#top-navbar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a href="/" class="navbar-brand">PHPHub</a>
    </div>
    <div id="top-navbar-collapse" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{ route('topics.index') }}">{{ trans('template.Topics') }}</a></li>
        <li class="{{ (Request::is('wiki*') ? ' active' : '') }}"><a href="{{ route('wiki') }}">{{ trans('template.Wiki') }}</a></li>
        <li class="{{ (Request::is('users*') ? ' active' : '') }}"><a href="{{ route('users.index') }}">{{ trans('template.Users') }}</a></li>
        <li class="{{ (Request::is('about*') ? ' active' : '') }}"><a href="{{ route('about') }}">{{ trans('template.About') }}</a></li>
      </ul>

      {{ Form::open(['route'=>'search', 'method'=>'get', 'class'=>'navbar-form navbar-left']) }}
        <div class="form-group">
          {{ Form::text('q', null, ['class' => 'form-control mac-style', 'placeholder' => trans('template.Search')]) }}
        </div>
        <button type="submit" class="btn btn-default btn-circle"><i class="fa fa-search"></i></button>
      {{ Form::close() }}

      <ul class="nav navbar-nav navbar-right github-login" >
        @if (Auth::check())
            <li>
                <a href="{{ route('notifications.index') }}" class="text-warning">
                    <span class="badge badge-{{ $currentUser->notification_count > 0 ? 'important' : 'fade'; }}">
                        {{ $currentUser->notification_count }}
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.show', $currentUser->id) }}">
                    <i class="fa fa-user"></i> {{{ $currentUser->name }}}
                </a>
            </li>
            <li>
                <a class="button" href="{{ URL::route('logout') }}">
                    <i class="fa fa-sign-out"></i> {{ trans('template.Logout') }}
                </a>
            </li>
        @else
            <a href="{{ URL::route('login') }}" class="btn btn-info" id="login-btn">
              <i class="fa fa-github-alt"></i>
              {{ trans('template.Login') }}
            </a>
        @endif

      </ul>
    </div>

  </div>
</div>
