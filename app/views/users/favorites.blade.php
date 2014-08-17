@extends('layouts.default')

@section('title')
{{{ $user->name }}} 的收藏列表_@parent 
@stop

@section('content')


<div class="col-md-8 col-md-offset-2 users-show">

  <div class="panel panel-default">

    @include('users.partials.infonav', ['current' => 'topics'])

    <div class="panel-body ">
      
      @if (count($topics))
	      @include('users.partials.topics')
	      <div> {{ $topics->links(); }} </div>
      @else
        <div class="empty-block">还未收藏任何话题~~</div>
      @endif

    </div>

  </div>
</div>

@stop
