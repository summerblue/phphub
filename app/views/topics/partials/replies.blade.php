<ul class="list-group row">

  @foreach ($replies as $index => $reply)
   <li class="list-group-item media" style="margin-top: 0px;">

    <div class="avatar pull-left">
      <a href="{{ route('users.show', [$reply->user_id]) }}">
        <img class="media-object img-thumbnail avatar" alt="{{{ $reply->user->name }}}" src="{{ $reply->user->present()->gravatar }}"  style="width:48px;height:48px;"/>
      </a>
    </div>

    <div class="infos">

      <div class="media-heading meta">
        <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{{ $reply->user->name }}}" class="remove-padding-left">
            {{{ $reply->user->name }}}
        </a>
        
        <a class="reply-floor" href="#reply{{ $index+1 }}">{{ $index +1 }}楼</a> · <abbr class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</abbr>
        

        <span class="operate pull-right">
            <a class="fa fa-reply" data-floor="1" data-login="dfang" href="javascript:void(0)" onclick="replyOne('{{{ $reply->user->name }}}');"></a>
        </span>
      
      </div>

      <div class="media-body markdown-reply">
{{{ $reply->body }}}
      </div>
      
    </div>

  </li>
  @endforeach

</ul>
