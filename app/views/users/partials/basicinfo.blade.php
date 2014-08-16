<div class="panel panel-default">

<div class="panel-heading">
  <h3 class="panel-title text-center">基本信息</h3>
</div>

<div class="panel-body ">

    <div style="text-align: center;" class="pull-right col-xs-3">
      <a href="/summer_charlie">
        <img src="http://ruby-china.org/avatar/90772cf58eb0f09b4dc41d5f1ca1334c.png?s=240&amp;d=404" class="img-thumbnail avatar">
      </a>
    </div>

    <dl class="dl-horizontal pull-left col-xs-9">
      <dt> 
        <lable>&nbsp; </lable>
      </dt>
      <dd>第 {{ $user->id }} 位会员</dd>
      <dt>
        <label>Name:</label>
      </dt>
      <dd><strong>{{ $user->name }}</strong></dd>
      <dt class="adr">
        <label>公司:</label>
      </dt>
      <dd><span class="org">{{ $user->company }}</span></dd>
      <dt>
        <label><span>Twitter</span>:</label>
      </dt>
      <dd><span><a href="https://twitter.com/{{ $user->twitter_account }}" rel="nofollow" class="twitter">{{ '@' . $user->twitter_account }}</a></span></dd>
      <dt>
        <label>博客:</label>
      </dt>
      <dd><span>
        <a href="{{ $user->personal_website }}" rel="nofollow" target="_blank" class="url">
          {{ str_limit($user->personal_website, 30) }}
        </a></span></dd>
      <dt>
        <label>签名:</label>
      </dt>
      <dd><span>{{ $user->signature }}</span></dd>
      <dt>
        <label>个人简介:</label>
      </dt>
      <dd><span>{{ $user->description }}</span></dd>
      <dt>
        <label>Since:</label>
      </dt>
      <dd><span>{{ $user->created_at }}</span></dd>
    </dl>
    <div class="clearfix"></div>
  </div>

</div>  