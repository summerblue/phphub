@extends('layouts.default')

@section('title')
社区 Wiki_@parent 
@stop

@section('content')

<div class="{{ count($topics) > 20 ?: 'col-md-6 col-md-offset-3' }} ">

  <div class="panel panel-default">

    <div class="panel-heading">
      <h3 class="panel-title text-center">社区 Wiki</h3>
    </div>
    
    <div class="panel-body remove-padding-vertically remove-padding-horizontal">

      <div class="list-group">
        @foreach ($topics as $topic)
          <a class="list-group-item {{ count($topics) <= 20 ?: 'col-md-6' }}" href="{{ route('topics.show', [$topic->id]) }}" title="{{{ $topic->title }}}">
            {{{ str_limit($topic->title, '100') }}}
          </a>
        @endforeach
      </div>

    </div>

  </div>  

</div>


@stop