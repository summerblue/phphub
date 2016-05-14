<div class="col-md-3 side-bar">


  <div class="panel panel-default corner-radius">

    @if (isset($node))
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{{ $node->name }}}</h3>
      </div>
    @endif

    <div class="panel-body text-center">
      <div class="btn-group">
        <a href="
          {{ isset($node) ? URL::route('topics.create', ['node_id' => $node->id]) : URL::route('topics.create') ; }}
          " class="btn btn-success btn-lg">
          <i class="glyphicon glyphicon-pencil"> </i> {{ lang('New Topic') }}
        </a>
      </div>
    </div>
  </div>

@if (Route::currentRouteName() == 'topics.index')
  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ lang('App Download') }}</h3>
    </div>
    <div class="panel-body text-center" style="padding: 7px;">
      <a href="https://phphub.org/topics/1531" target="_blank" rel="nofollow" title="">
        <img src="https://dn-phphub.qbox.me/uploads/images/201512/08/1/cziZFHqkm8.png" style="width:240px;">
      </a>
    </div>
  </div>
@endif

  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ lang('Community Notes') }}</h3>
    </div>
    <div class="panel-body">
      <ul class="list">
          <li><a href="{{ route('about') }}">关于 PHPHub</a></li>
          <li><a href="https://phphub.org/topics/776">社区功能引导</a></li>
          <li><a href="https://phphub.org/topics/817">PHPHub 招聘贴发布版规</a></li>
          <li><a href="https://phphub.org/topics/777">社区 维护/驱动 的项目墙</a></li>
      </ul>
    </div>
  </div>

  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ lang('Community Promotion') }}</h3>
    </div>
    <div class="panel-body text-center" style="padding: 7px; padding-top: 2px;">
      <a href="http://www.ucloud.cn/site/seo.html?utm_source=zanzhu&utm_campaign=phphub&utm_medium=display&utm_content=shengji&ytag=phphubshenji" target="_blank" rel="nofollow" title="" style="line-height: 66px;">
        <img src="http://ww1.sinaimg.cn/large/6d86d850jw1f2xfmssojsj20dw03cjs5.jpg" style="width:240px;">
      </a>
  </div>
  </div>

  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ lang('Recomended Resources') }}</h3>
    </div>
    <div class="panel-body">
      <ul class="list">
          <li><a href="http://laravel-china.org/docs/5.1">Laravel LTS 5.1 文档（精校版）</a></li>
          <li><a href="https://cs.phphub.org/">Laravel 5.1 LTS 速查表</a></li>
          <li><a href="https://psr.phphub.org/">PHP-FIG 编程规范中文</a></li>
          <li><a href="http://laravel-china.github.io/php-the-right-way/">PHP The Right Way 中文版</a></li>
          <li><a href="http://www.phpcomposer.com/">Composer 中文文档</a></li>
          <li><a href="https://phphub.org/topics/295">Chrome 插件 PHPHub Notifier</a></li>
          <li><a href="https://itunes.apple.com/us/podcast/the-laravel-podcast/id653204183?mt=2">Laravel 官方播客</a></li>
          <li><a href="https://easywechat.org/">最优雅的微信公众平台 SDK</a></li>
      </ul>
    </div>
  </div>

  @if (isset($links) && count($links))
    <div class="panel panel-default corner-radius">
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ lang('Links') }}</h3>
      </div>
      <div class="panel-body text-center" style="padding-top: 5px;">
        @foreach ($links as $link)
            <a href="{{ $link->link }}" target="_blank" rel="nofollow" title="{{ $link->title }}">
                <img src="{{ $link->cover }}" style="width:150px; margin: 3px 0;">
            </a>
        @endforeach
      </div>
    </div>
  @endif

  @if (isset($nodeTopics) && count($nodeTopics))
    <div class="panel panel-default corner-radius">
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ lang('Same Node Topics') }}</h3>
      </div>
      <div class="panel-body">
        <ul class="list">

          @foreach ($nodeTopics as $nodeTopic)
            <li>
            <a href="{{ route('topics.show', $nodeTopic->id) }}">
              {{{ $nodeTopic->title }}}
            </a>
            </li>
          @endforeach

        </ul>
      </div>
    </div>
  @endif

  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ lang('Tips and Tricks') }}</h3>
    </div>
    <div class="panel-body">
      {{ $siteTip->body }}
    </div>
  </div>

    @if (Route::currentRouteName() == 'topics.index')
  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ lang('Site Status') }}</h3>
    </div>
    <div class="panel-body">
      <ul>
        <li>{{ lang('Total User') }}: {{ $siteStat->user_count }} </li>
        <li>{{ lang('Total Topic') }}: {{ $siteStat->topic_count }} </li>
        <li>{{ lang('Total Reply') }}: {{ $siteStat->reply_count }} </li>
      </ul>
    </div>
  </div>

    @endif
</div>
<div class="clearfix"></div>
