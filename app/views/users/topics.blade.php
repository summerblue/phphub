@extends('layouts.default')

@section('title')
{{{ $user->name }}} 的话题列表_@parent
@stop

@section('content')


<div class="users-show main-col">

  <div class="panel panel-default">

    @include('users.partials.infonav', ['current' => 'topics'])

    <div class="panel-body remove-padding-vertically remove-padding-horizontal">

      @if (count($topics))
	    @include('users.partials.topics')
	    <div class="pull-right add-padding-vertically">
	        {{ $topics->links(); }}
	    </div>
      @else
        <div class="empty-block">还未发布任何话题~~</div>
      @endif

    </div>

  </div>
</div>

@stop
