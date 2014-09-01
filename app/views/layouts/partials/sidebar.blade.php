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
            <h3 class="panel-title">{{ lang('Learning Resources') }}</h3>
          </div>
          <div class="panel-body">
            <ul class="list">
                <li><a href="http://wulijun.github.io/php-the-right-way/">PHP The Right Way 中文版</a></li>
                <li><a href="http://laravel-china.org/">Laravel4.2 文档</a></li>
                <li><a href="https://github.com/PizzaLiu/PHP-FIG">PHP-FIG 编程规范中文</a></li>
                <li><a href="http://www.phpcomposer.com/">Composer 中文文档</a></li>
            </ul>
          </div>
        </div>
    @endif


  @if (isset($links) && count($links))
    <div class="panel panel-default corner-radius">
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ lang('Links') }}</h3>
      </div>
      <div class="panel-body">
        <ul class="list">

          @foreach ($links as $link)
            <li>
            <a href="{{ $link->link }}">
              {{{ $link->title }}}
            </a>
            </li>
          @endforeach

        </ul>
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

</div>
<div class="clearfix"></div>
