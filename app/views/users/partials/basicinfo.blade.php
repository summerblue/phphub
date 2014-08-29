<div style="text-align: center;">
  <a href="">
    <img src="{{ $user->present()->gravatar(180) }}" class="img-thumbnail users-show-avatar" style="width: 206px;margin: 4px 4px 15px;min-height:190px">
  </a>
</div>

<dl class="dl-horizontal">

  <dt><lable>&nbsp; </lable></dt><dd> {{ lang('User ID:') }} {{ $user->id }}</dd>

  <dt><label>Name:</label></dt><dd><strong>{{{ $user->name }}}</strong></dd>

  @if ($user->real_name)
    <dt class="adr"><label> {{ lang('Real Name') }}:</label></dt><dd><span class="org">{{{ $user->real_name }}}</span></dd>
  @endif

  <dt><label>Github:</label></dt>
  <dd>
    <a href="https://github.com/{{ $user->github_name }}" target="_blank">
      <i class="fa fa-github-alt"></i> {{ $user->github_name }}
    </a>
  </dd>

  @if ($user->company)
    <dt class="adr"><label> {{ lang('Company') }}:</label></dt><dd><span class="org">{{{ $user->company }}}</span></dd>
  @endif

  @if ($user->city)
    <dt class="adr"><label> {{ lang('City') }}:</label></dt><dd><span class="org"><i class="fa fa-map-marker"></i> {{{ $user->city }}}</span></dd>
  @endif

  @if ($user->twitter_account)
  <dt><label><span>Twitter</span>:</label></dt>
  <dd>
    <a href="https://twitter.com/{{ $user->twitter_account }}" rel="nofollow" class="twitter" target="_blank"><i class="fa fa-twitter"></i> {{{ '@' . $user->twitter_account }}}
    </a>
  </dd>
  @endif

  @if ($user->personal_website)
  <dt><label>{{ lang('Blog') }}:</label></dt>
  <dd>
    <a href="http://{{ $user->personal_website }}" rel="nofollow" target="_blank" class="url">
      <i class="fa fa-globe"></i> {{{ str_limit($user->personal_website, 25) }}}
    </a>
  </dd>
  @endif

  @if ($user->signature)
    <dt><label>{{ lang('Signature') }}:</label></dt><dd><span>{{{ $user->signature }}}</span></dd>
  @endif

  <dt>
    <label>Since:</label>
  </dt>
  <dd><span>{{ $user->created_at }}</span></dd>
</dl>
<div class="clearfix"></div>

@if ($currentUser && $currentUser->id == $user->id)
  <a class="btn btn-primary btn-block" href="{{ route('users.edit', $user->id) }}" id="user-edit-button">
    <i class="icon-edit"></i> {{ lang('Edit Profile') }}
  </a>
@endif
