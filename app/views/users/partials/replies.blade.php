
<ul class="list-group">
  @foreach ($replies as $index => $reply)
   <li class="list-group-item">

    @if (count($reply->topic))
      <a href="{{ route('topics.show', [$reply->topic_id]) }}" title="{{{ $reply->topic->title }}}" class="remove-padding-left">
          {{{ $reply->topic->title }}}
      </a>
      <span class="meta">
         at <span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>
      </span>
      <div class="reply-body markdown-reply">
{{{ $reply->body }}}
      </div>
    @else
      <div class="deleted text-center">信息已被删除.</div>
    @endif
      
  </li>
  @endforeach
</ul>
