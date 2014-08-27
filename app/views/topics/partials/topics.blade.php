

@if (count($topics))

<ul class="list-group row topic-list">
	@foreach ($topics as $topic)
	 <li class="list-group-item media {{ !$column ?:'col-sm-6'; }}" style="margin-top: 0px;">

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
		  		{{{ $column ? str_limit($topic->title, '30') : str_limit($topic->title, '100') }}}
		  	</a>
		  	@if ($topic->order > 0 && !Input::get('filter') && Route::currentRouteName() != 'home' )
		  		<i class="fa fa-thumb-tack" style="color:#969595;padding-left: 2px;"></i>
		  	@endif
		  </div>
		  <div class="media-body meta">

		  	@if ($topic->vote_count > 0)
		  		<a href="{{ route('topics.show', [$topic->id]) }}" class="remove-padding-left" id="pin-{{ $topic->id }}">
				  	<span class="fa fa-thumbs-o-up"> {{ $topic->vote_count }} </span>
			  	</a>
			  	<span> •  </span>
		  	@endif

		  	<a href="{{ route('nodes.show', [$topic->node->id]) }}" title="{{{ $topic->node->name }}}" {{ $topic->vote_count == 0 || 'class="remove-padding-left"'}}>
		  		{{{ $topic->node->name }}}
			</a>
		  	<span> • </span>
		  	<a href="{{ route('users.show', [$topic->user_id]) }}" title="{{{ $topic->user->name }}}">
		  		{{{ $topic->user->name }}}
			</a>
		  	<span> • </span>
		  	<span class="timeago">{{ $topic->created_at }}</span>
			@if ($topic->reply_count > 0 && count($topic->lastReplyUser))
				<span> • </span>{{ trans('template.Last Reply by') }}
			  	<a href="{{{ URL::route('users.show', [$topic->lastReplyUser->id]) }}}">
	              {{{ $topic->lastReplyUser->name }}}
	            </a>
	            <span> • </span>
			  	<span class="timeago">{{ $topic->updated_at }}</span>
			@endif
		  </div>

		</div>

	</li>
	@endforeach
</ul>

@else
   <div class="empty-block">{{ trans('template.Dont have any data Yet') }}~~</div>
@endif



