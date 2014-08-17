

@if (count($topics))
  
<ul class="list-group row">
	@foreach ($topics as $topic)
	 <li class="list-group-item media {{ !$column ?:'col-xs-6'; }}" style="margin-top: 0px;">

		<a class="pull-right" href="{{ route('topics.show', [$topic->id]) }}" >
			<span class="badge badge-reply-count"> {{ $topic->reply_count }} </span>
		</a>

		<div class="avatar pull-left">
			<a href="{{ route('users.show', [$topic->user_id]) }}">
				<img class="media-object img-thumbnail avatar" alt="{{{ $topic->user->name }}}" src="{{ $topic->user->present()->gravatar }}"  style="width:48px;height:48px;"/>
			</a>
		</div>

		<div class="infos">

		  <div class="media-heading">
		  	<a href="{{ route('topics.show', [$topic->id]) }}" title="{{{ $topic->title }}}">
		  		{{{ $column ? str_limit($topic->title, '50') : str_limit($topic->title, '100') }}}
		  	</a>
		  </div>
		  <div class="media-body meta">
		  	<a href="{{ route('nodes.show', [$topic->node->id]) }}" title="{{{ $topic->node->name }}}" class="remove-padding-left">
		  		{{{ $topic->node->name }}}
			</a>
		  	<span> • </span>
		  	<a href="{{ route('users.show', [$topic->user_id]) }}" title="{{{ $topic->user->name }}}">
		  		{{{ $topic->user->name }}}
			</a>
		  	<span> • </span>
		  	<span class="timeago">{{ $topic->created_at }}</span>
			@if (count($topic->lastReplyUser))
				<span> • </span>最后回复来自 
			  	<a href="{{{ URL::route('users.show', [$topic->lastReplyUser->id]) }}}">
	              {{{ $topic->lastReplyUser->name }}}
	            </a>
			@endif
		  </div>
		  
		</div>

	</li>
	@endforeach
</ul>

@else
   <div class="empty-block">还未有话题~~</div>
@endif



