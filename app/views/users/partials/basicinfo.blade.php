<div style="text-align: center;">
  <a href="">
    <img src="{{ $user->present()->gravatar(180) }}" class="img-thumbnail users-show-avatar" style="width:190px;margin:3px 12px 23px;min-height:190px">
  </a>
</div>

<dl class="dl-horizontal">
  
  <dt><lable>&nbsp; </lable></dt><dd>第 {{ $user->id }} 位会员</dd>

  <dt><label>Name:</label></dt><dd><strong>{{{ $user->name }}}</strong></dd>
  
  <dt><label>Github:</label></dt>
  <dd>
    <a href="https://github.com/{{ $user->name }}" target="_blank">
      <i class="fa fa-github-alt"></i> {{ $user->name }}
    </a>
  </dd>
  
  @if ($user->company)
    <dt class="adr"><label>公司:</label></dt><dd><span class="org">{{{ $user->company }}}</span></dd>  
  @endif

  @if ($user->city)
    <dt class="adr"><label>城市:</label></dt><dd><span class="org"><i class="fa fa-map-marker"></i> {{{ $user->city }}}</span></dd>  
  @endif
  
  @if ($user->twitter_account)
  <dt><label><span>Twitter</span>:</label></dt>
  <dd>
    <a href="https://twitter.com/{{ $user->twitter_account }}" rel="nofollow" class="twitter" target="_blank"><i class="fa fa-twitter"></i> {{{ '@' . $user->twitter_account }}}
    </a>
  </dd>
  @endif
  
  @if ($user->personal_website)
  <dt><label>博客:</label></dt>
  <dd>
    <a href="http://{{ $user->personal_website }}" rel="nofollow" target="_blank" class="url">
      <i class="fa fa-globe"></i> {{{ str_limit($user->personal_website, 25) }}}
    </a>
  </dd>
  @endif
  
  @if ($user->signature)
    <dt><label>签名:</label></dt><dd><span>{{{ $user->signature }}}</span></dd>
  @endif

  <dt>
    <label>Since:</label>
  </dt>
  <dd><span>{{ $user->created_at }}</span></dd>
</dl>
<div class="clearfix"></div>

@if ($currentUser && $currentUser->id == $user->id)
  <a class="btn btn-primary btn-block" href="{{ route('users.edit', $user->id) }}">
    <i class="icon-edit"></i> 编辑个人资料
  </a>
@endif