<div class="col-sm-3 side-bar">


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
          <i class="glyphicon glyphicon-pencil"> </i> 发 布 新 帖
        </a>
      </div>
    </div>
  </div>

  @if (isset($links) && count($links))
    <div class="panel panel-default corner-radius">
      <div class="panel-heading text-center">
        <h3 class="panel-title">友情社区</h3>
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
        <h3 class="panel-title">节点下其他话题</h3>
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
      <h3 class="panel-title">小贴士</h3>
    </div>
    <div class="panel-body">
      {{ $siteTip->body }}
    </div>
  </div>


  <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title">统计信息</h3>
    </div>
    <div class="panel-body">
      <ul>
        <li>社区会员: {{ $siteStat->user_count }} 人</li>
        <li>话题数: {{ $siteStat->topic_count }} 个</li>
        <li>评论数: {{ $siteStat->reply_count }} 条</li>
      </ul>
    </div>
  </div>

</div>
<div class="clearfix"></div>