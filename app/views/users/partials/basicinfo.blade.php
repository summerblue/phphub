<div style="text-align: center;" class="pull-right col-md-3">
  <a href="">
    <img src="{{ $user->present()->gravatar(180) }}" class="img-thumbnail users-show-avatar" style="width:120px;height:120px;">
  </a>
</div>

<dl class="dl-horizontal pull-left col-md-9">
  
  <dt><lable>&nbsp; </lable></dt><dd>第 {{ $user->id }} 位会员</dd>

  <dt><label>Name:</label></dt><dd><strong>{{{ $user->name }}}</strong></dd>
  
  @if (isset($user->company))
    <dt class="adr"><label>公司:</label></dt><dd><span class="org">{{{ $user->company }}}</span></dd>  
  @endif
  
  @if (isset($user->twitter_account))
  <dt><label><span>Twitter</span>:</label></dt>
  <dd>
    <a href="https://twitter.com/{{ $user->twitter_account }}" rel="nofollow" class="twitter">{{{ '@' . $user->twitter_account }}}
    </a>
  </dd>
  @endif
  
  @if (isset($user->personal_website))
  <dt><label>博客:</label></dt>
  <dd>
    <a href="{{ $user->personal_website }}" rel="nofollow" target="_blank" class="url">
      {{{ str_limit($user->personal_website, 30) }}}
    </a>
  </dd>
  @endif
  
  @if (isset($user->signature))
    <dt><label>签名:</label></dt><dd><span>{{{ $user->signature }}}</span></dd>
  @endif

  @if (isset($user->description))
    <dt><label>个人简介:</label></dt><dd><span>{{{ $user->description }}}</span></dd>
  @endif

  <dt>
    <label>Since:</label>
  </dt>
  <dd><span>{{ $user->created_at }}</span></dd>
</dl>
<div class="clearfix"></div>