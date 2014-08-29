@extends('layouts.default')

@section('title')
{{ trans('template.My Notifications') }} @parent
@stop

@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
      {{ trans('template.My Notifications') }}
    </div>

	@if (count($notifications))

		<div class="panel-body remove-padding-horizontal">

			<ul class="list-group row">
				@foreach ($notifications as $notification)
				 <li class="list-group-item media" style="margin-top: 0px;">

					@if (count($notification->topic))
						<div class="avatar pull-left">
							<a href="{{ route('users.show', [$notification->from_user_id]) }}">
								<img class="media-object img-thumbnail avatar" alt="{{{ $notification->fromUser->name }}}" src="{{ $notification->fromUser->present()->gravatar }}"  style="width:32px;height:32px;"/>
							</a>
						</div>

						<div class="infos">

						  <div class="media-heading">

						  	<a href="{{ route('users.show', [$notification->from_user_id]) }}">
								{{{ $notification->fromUser->name }}}
							</a>
							 •
                            {{ $notification->present()->lableUp }}

						  	<a href="{{ route('topics.show', [$notification->topic->id]) }}" title="{{{ $notification->topic->title }}}">
						  		{{{ str_limit($notification->topic->title, '100') }}}
						  	</a>

						  	<span class="meta">
						  		 • {{ trans('template.at') }} • <span class="timeago">{{ $notification->created_at }}</span>
						  	</span>
						  </div>
						  <div class="media-body markdown-reply">
{{ $notification->body }}
						  </div>

						</div>
					@else
				      <div class="deleted text-center">{{ trans('template.Data has been deleted.') }}</div>
				    @endif
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
			<div class="empty-block">{{ trans('template.You dont have any notice yet!') }}</div>
		</div>
	@endif

</div>


@stop
