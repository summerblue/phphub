<div class="panel-footer operate">
  <div class="pull-right">
    <a data-followed="false" data-id="15887" href="#" onclick="return Topics.follow(this);" rel="twipsy" data-original-title="">
      <i class="glyphicon glyphicon-eye-open"></i> 关注
    </a>
    <a data-id="15887" href="#" onclick="return Topics.favorite(this);" rel="twipsy" data-original-title="收藏">
      <i class="glyphicon glyphicon-bookmark"></i> <span>收藏</span>
    </a>

    @if ($currentUser && $currentUser->can("manage_topics") )

      <a id="topic-recomend-button" href="{{ route('topics.recomend', [$topic->id]) }}" >
        <i class="fa fa-trophy"></i> <span>{{ $topic->is_excellent ? '取消' : '推荐' }}</span>
      </a>

      <a id="topic-wiki-button" href="{{ route('topics.wiki', [$topic->id]) }}" rel="">
        <i class="fa fa-graduation-cap"></i> <span>{{ $topic->is_wiki ? '取消' : 'Wiki' }}</span>
      </a>

      <a id="topic-delete-button" href="{{ route('topics.delete', [$topic->id]) }}" rel="" onclick=" return confirm('确定要删除此话题吗?')">
        <i class="fa fa-trash-o"></i> <span>删除</span>
      </a>

    @endif

  </div>
  <div class="clearfix"></div>
</div>