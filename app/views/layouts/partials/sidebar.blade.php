<div class="col-sm-3 side-bar">
  <div class="panel panel-default corner-radius box">

    @if (isset($node))
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ $node->name }}</h3>
      </div>
    @endif

    <div class="panel-body text-center">
      <div class="btn-group">
        <a href="{{ URL::route('topics.create') }}" class="btn btn-success btn-lg">
          <i class="glyphicon glyphicon-pencil"> </i> 发 布 新 帖
        </a>
      </div>
    </div>
  </div>
  <div class="panel panel-default corner-radius box">
    <div class="panel-heading text-center">
      <h3 class="panel-title">置顶话题</h3>
    </div>
    <div class="panel-body">
      <ul class="list-unstyled little-topic-list">

        @foreach ($excellentTopics as $excellentTopic)
          <li>
          <a href="{{ route('users.show', $excellentTopic->user->id) }}">
            <img src="holder.js/16x16" />
          </a>
          <a href="{{ route('topics.show', $excellentTopic->id) }}">{{{ str_limit($excellentTopic->title, 20) }}}</a>
          </li>
        @endforeach

      </ul>
    </div>
  </div>
  <div class="panel panel-default corner-radius box">
    <div class="panel-heading text-center">
      <h3 class="panel-title">小贴士</h3>
    </div>
    <div class="panel-body">laracasts.com 上面有很不错的 Laravel 开发技巧的视频，通通看完你可以学到很多东西</div>
  </div>
  <div class="panel panel-default corner-radius box">
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