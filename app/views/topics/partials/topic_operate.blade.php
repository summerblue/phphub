<div class="panel-footer operate">
  <div class="pull-right">

    @if ($currentUser && Attention::isUserAttentedTopic($currentUser, $topic))
      <a href="{{ route('attentions.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-eye-open" style="color:#ce8a81"></i> <span>取消</span>
      </a>
    @else
      <a href="{{ route('attentions.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-eye-open"></i> <span>关注</span>
      </a>
    @endif

    @if ($currentUser && Favorite::isUserFavoritedTopic($currentUser, $topic))
      <a href="{{ route('favorites.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-bookmark" style="color:#ce8a81"></i> <span>取消</span>
      </a>
    @else
      <a href="{{ route('favorites.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-bookmark"></i> <span>收藏</span>
      </a>
    @endif

    @if ($currentUser && $currentUser->can("manage_topics") )
      <a id="topic-recomend-button" href="{{ route('topics.recomend', [$topic->id]) }}" class="admin {{ $topic->is_excellent ? 'active' :'';}}" title="设为推荐话题">
        <i class="fa fa-trophy"></i>
      </a>

      <a id="topic-wiki-button" href="{{ route('topics.wiki', [$topic->id]) }}" class="admin {{ $topic->is_wiki ? 'active' : '' }}" title="加入到社区 Wiki">
        <i class="fa fa-graduation-cap"></i>
      </a>

      <a id="topic-wiki-button" href="{{ route('topics.pin', [$topic->id]) }}" class="admin {{ $topic->order > 0 ? 'active' : '' }}" title="置顶此话题">
        <i class="fa fa-thumb-tack"></i>
      </a>

      <a id="topic-delete-button" href="{{ route('topics.delete', [$topic->id]) }}" onclick=" return confirm('确定要删除此话题吗?')" title="删除此话题" class="admin">
        <i class="fa fa-trash-o"></i>
      </a>
    @endif

    @if ( $currentUser && ($currentUser->can("manage_topics") || $currentUser->id == $topic->user_id) )
      <a id="topic-delete-button" href="{{ route('topics.edit', [$topic->id]) }}" title="编辑" class="admin">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    @endif

  </div>
  <div class="clearfix"></div>
</div>