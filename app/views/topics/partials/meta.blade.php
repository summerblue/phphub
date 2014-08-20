<div class="meta inline-block" >

  <a href="{{ route('nodes.show', $topic->node->id) }}" class="remove-padding-left">
    {{{ $topic->node->name }}}
  </a>
  • 
  <a href="{{ route('users.show', $topic->user->id) }}">
    {{{ $topic->user->name }}}
  </a>
  •
  于 <abbr title="{{ $topic->created_at }}" class="timeago">{{ $topic->created_at }}</abbr> 发布
  •

  @if (count($topic->lastReplyUser))
    最后由 
      <a href="{{{ URL::route('users.show', [$topic->lastReplyUser->id]) }}}">
        {{{ $topic->lastReplyUser->name }}}
      </a>
     于 <abbr title="{{ $topic->updated_at }}" class="timeago">{{ $topic->updated_at }}</abbr> 回复
    •
  @endif

  {{ $topic->view_count }} 阅读
</div>
<div class="clearfix"></div>