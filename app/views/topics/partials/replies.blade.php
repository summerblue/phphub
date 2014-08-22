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
        <span> •  </span>
        <abbr class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</abbr>
        <span> •  </span>
        <a name="reply{{ $reply->id }}" class="anchor" href="#reply{{ $reply->id }}" aria-hidden="true">#{{ $reply->id }}</a>

        <span class="operate pull-right">
          <a href="{{ route('replies.vote', $reply->id) }}" title="赞一个">
            <i class="fa fa-thumbs-o-up" style="font-size:14px;"></i>
            {{ $reply->vote_count }}
          </a>
          <span> •  </span>
          
          @if ($currentUser && ($currentUser->can("manage_topics") || $currentUser->id == $reply->user_id) )
            <a id="topic-delete-button" href="{{ route('replies.delete', [$reply->id]) }}" onclick=" return confirm('确定要删除此话题吗?')">
              <i class="fa fa-trash-o"></i> 
            </a>
            <span> •  </span>
          @endif
          <a class="fa fa-reply" href="javascript:void(0)" onclick="replyOne('{{{ $reply->user->name }}}');" title="回复 {{{ $reply->user->name }}}"></a>
        </span>
      
      </div>

      <div class="media-body markdown-reply">
{{{ $reply->body }}}
      </div>
      
    </div>

  </li>
  @endforeach

</ul>
