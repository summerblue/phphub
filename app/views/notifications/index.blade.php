@extends('layouts.default')

@section('title')
我的提醒 @parent 
@stop

@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
      我的提醒
    </div>

	@if (count($notifications))

		<div class="panel-body remove-padding-horizontal">

			<ul class="list-group row">
				@foreach ($notifications as $notification)
				 <li class="list-group-item media" style="margin-top: 0px;">

					<div class="avatar pull-left">
						<a href="{{ route('users.show', [$notification->from_user_id]) }}">
							<img class="media-object img-thumbnail avatar" alt="{{{ $notification->fromUser->name }}}" src="{{ $notification->fromUser->present()->gravatar }}"  style="width:48px;height:48px;"/>
						</a>
					</div>

					<div class="infos">

					  <div class="media-heading">

					  	<a href="{{ route('users.show', [$notification->from_user_id]) }}">
							{{{ $notification->fromUser->name }}}
						</a>
						 • 
						@if ($notification->type == 'new_reply')
							回复了你的主题: 
						@elseif ($notification->type == 'attention')
							回复了你关注的主题: 
						@elseif ($notification->type == 'at')
							在话题中提及你: 
						@endif

					  	<a href="{{ route('topics.show', [$notification->topic->id]) }}" title="{{{ $notification->topic->title }}}">
					  		{{{ str_limit($notification->topic->title, '100') }}}
					  	</a>

					  	<span class="meta">
					  		 • 发生在 • <span class="timeago">{{ $notification->created_at }}</span>
					  	</span>
					  </div>
					  <div class="media-body">
					  	{{{ $notification->body }}}
					  </div>
					  
					</div>

				</li>
				@endforeach
			</ul>


		</div>

		<div class="panel-footer text-right remove-padding-horizontal pager-footer">
			<!-- Pager --> 
			{{ $notifications->links(); }}
		</div>

	@else
		<div class="panel-body">
			<div class="empty-block">还未收到提醒!</div>	
		</div>
	@endif

</div>


@stop
