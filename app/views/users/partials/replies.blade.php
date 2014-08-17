
<ul class="list-group">
  @foreach ($replies as $index => $reply)
   <li class="list-group-item">
      <a href="{{ route('topics.show', [$reply->topic_id]) }}" title="{{{ $reply->topic->title }}}" class="remove-padding-left">
          {{{ $reply->topic->title }}}
      </a>
      <span class="meta">
         at <span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>
      </span>
      <div class="reply-body">
        {{{ $reply->body }}}
      </div>
  </li>
  @endforeach
</ul>
