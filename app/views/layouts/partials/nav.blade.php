<div role="navigation" class="navbar navbar-default navbar-static-top topnav">
  <div class="container">
    <div class="navbar-header">

      <a href="/" class="navbar-brand">PHPHub</a>
    </div>
    <div id="top-navbar-collapse" class="navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{ route('topics.index') }}">{{ lang('Topics') }}</a></li>
        <li class="{{ (Request::is('wiki*') ? ' active' : '') }}"><a href="{{ route('wiki') }}">{{ lang('Wiki') }}</a></li>
        <li class="{{ (Request::is('users*') ? ' active' : '') }}"><a href="{{ route('users.index') }}">{{ lang('Users') }}</a></li>
        <li class="{{ (Request::is('about*') ? ' active' : '') }}"><a href="{{ route('about') }}">{{ lang('About') }}</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right github-login" >
        {{ Form::open(['route'=>'search', 'method'=>'get', 'class'=>'navbar-form navbar-left']) }}
          <div class="form-group">
          {{ Form::text('q', null, ['class' => 'form-control search-input mac-style', 'placeholder' => lang('Search')]) }}
          </div>
        {{ Form::close() }}

        @if (Auth::check())
            <li>
                <a href="{{ route('notifications.index') }}" class="text-warning">
                    <span class="badge badge-{{ $currentUser->notification_count > 0 ? 'important' : 'fade'; }}" id="notification-count">
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
                <a class="button" href="{{ URL::route('logout') }}" onclick=" return confirm('{{ lang('Are you sure want to logout?') }}')">
                    <i class="fa fa-sign-out"></i> {{ lang('Logout') }}
                </a>
            </li>
        @else
            <a href="{{ URL::route('login') }}" class="btn btn-info" id="login-btn">
              <i class="fa fa-github-alt"></i>
              {{ lang('Login') }}
            </a>
        @endif

      </ul>
    </div>

  </div>
</div>
