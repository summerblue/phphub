<div class="panel-footer operate">

  <div class="pull-left" style="font-size:15px;">
    <a class="" href="http://service.weibo.com/share/share.php?url={{ urlencode(Request::url()) }}&type=3&pic=&title={{{ $topic->title }}}" target="_blank" title="{{ trans('template.Share on Weibo') }}">
      <i class="fa fa-weibo"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{{ $topic->title }}}&via=phphub.org" class=""  target="_blank" title="{{ trans('template.Share on Twitter') }}">
      <i class="fa fa-twitter"></i>
    </a>
    <a href="http://www.facebook.com/sharer.php?u={{ urlencode(Request::url()) }}" class=""  target="_blank" title="{{ trans('template.Share on Facebook') }}">
      <i class="fa fa-facebook"></i>
    </a>
    <a href="https://plus.google.com/share?url={{ urlencode(Request::url()) }}" class=""  target="_blank" title="{{ trans('template.Share on Google Plus') }}">
      <i class="fa fa-google-plus"></i>
    </a>
  </div>


  <div class="pull-right">

    @if ($currentUser && Attention::isUserAttentedTopic($currentUser, $topic))
      <a id="topic-attent-cancel-button" href="{{ route('attentions.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-eye-open" style="color:#ce8a81"></i> <span>{{ trans('template.Cancel') }}</span>
      </a>
    @else
      <a id="topic-attent-button" href="{{ route('attentions.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-eye-open"></i> <span>{{ trans('template.Attent') }}</span>
      </a>
    @endif

    @if ($currentUser && Favorite::isUserFavoritedTopic($currentUser, $topic))
      <a id="topic-favorite-cancel-button" href="{{ route('favorites.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-bookmark" style="color:#ce8a81"></i> <span>{{ trans('template.Cancel') }}</span>
      </a>
    @else
      <a id="topic-favorite-button" href="{{ route('favorites.createOrDelete', $topic->id) }}">
        <i class="glyphicon glyphicon-bookmark"></i> <span>{{ trans('template.Favorite') }}</span>
      </a>
    @endif

    @if ($currentUser && $currentUser->can("manage_topics") )
      <a id="topic-recomend-button" href="{{ route('topics.recomend', [$topic->id]) }}" class="admin {{ $topic->is_excellent ? 'active' :'';}}" title="{{ trans('template.Mark as Excellent') }}">
        <i class="fa fa-trophy"></i>
      </a>

      <a id="topic-wiki-button" href="{{ route('topics.wiki', [$topic->id]) }}" class="admin {{ $topic->is_wiki ? 'active' : '' }}" title="{{ trans('template.Mark as Community Wiki') }}">
        <i class="fa fa-graduation-cap"></i>
      </a>

      <a id="topic-pin-button" href="{{ route('topics.pin', [$topic->id]) }}" class="admin {{ $topic->order > 0 ? 'active' : '' }}" title="{{ trans('template.Pin it on Top') }}">
        <i class="fa fa-thumb-tack"></i>
      </a>

      <a id="topic-delete-button" href="{{ route('topics.delete', [$topic->id]) }}" onclick=" return confirm('{{ trans('template.Are you sure want to delete is topic?') }}')" title="{{ trans('template.Delete') }}" class="admin">
        <i class="fa fa-trash-o"></i>
      </a>
    @endif

    @if ( $currentUser && ($currentUser->can("manage_topics") || $currentUser->id == $topic->user_id) )
      <a id="topic-edit-button" href="{{ route('topics.edit', [$topic->id]) }}" title="{{ trans('template.Edit') }}" class="admin">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    @endif

  </div>
  <div class="clearfix"></div>
</div>
