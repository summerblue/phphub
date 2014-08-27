@extends('layouts.default')

@section('title')
{{ trans('template.Community Wiki') }}_@parent
@stop

@section('content')

<div class="{{ count($topics) > 20 ?: 'col-md-6 col-md-offset-3' }} ">

  <div class="panel panel-default">

    <div class="panel-heading">
      <h3 class="panel-title text-center">{{ trans('template.Community Wiki') }}</h3>
    </div>

    <div class="panel-body remove-padding-vertically remove-padding-horizontal">

    @if (count($topics))
      <div class="list-group">
        @foreach ($topics as $topic)
          <a class="list-group-item {{ count($topics) <= 20 ?: 'col-md-6' }}" href="{{ route('topics.show', [$topic->id]) }}" title="{{{ $topic->title }}}">
            {{{ str_limit($topic->title, '100') }}}
          </a>
        @endforeach
      </div>
    @else
      <div class="empty-block">{{ trans('template.Dont have any data Yet') }}~~</div>
    @endif

    </div>

  </div>

</div>


@stop
