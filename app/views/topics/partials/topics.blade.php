<ul class="list-group row">

	@foreach ($topics as $topic)
	 <li class="list-group-item media {{ !$column ?:'col-xs-6'; }}" style="margin-top: 0px;">

		<span class="badge" style="margin: 15px 20px;"> {{ $topic->reply_count }} </span>

		<div class="avatar pull-left">
			<a href="{{ route('users.show', [$topic->user_id]) }}">
				<img class="media-object img-thumbnail" alt="{{ $topic->user->name }}" src="holder.js/48x48"/>
			</a>
		</div>

		<div class="infos">

		  <div class="media-heading">
		  	<a href="{{ route('topics.show', [$topic->id]) }}" title="{{ $topic->title }}">
		  		{{ $column ? str_limit($topic->title, '50') : str_limit($topic->title, '100') }}
		  	</a>
		  </div>

		  <div class="media-body">
		  	<a href="{{ route('nodes.show', [$topic->node->id]) }}" title="{{ $topic->node->name }}" class="">
		  		{{ $topic->node->name }}
			</a>
		  	<span> • </span>
		  	<a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}" class="">
		  		{{ $topic->user->name }}
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

