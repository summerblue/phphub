@extends('layouts.default')

@section('title')
{{ $user->name }} 的话题列表_@parent 
@stop

@section('content')


<div class="col-md-8 col-md-offset-2 users-show">

  <div class="panel panel-default">

    @include('users.partials.infonav', ['current' => 'topics'])

    <div class="panel-body remove-padding-vertically remove-padding-horizontal">
      
      @include('users.partials.topics')
      <div>
        {{ $topics->links(); }}
      </div>

    </div>

  </div>
</div>

@stop
