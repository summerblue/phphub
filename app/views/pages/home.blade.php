@extends('layouts.default')

@section('content')

<div class="box text-center">

  {{ trans('template.site_intro') }}
</div>

<div class="box text-center">
    {{ trans('template.contributing') }}
</div>

<div class="panel panel-default list-panel">
  <div class="panel-heading">
    <h3 class="panel-title text-center">
      {{ trans('template.Excellent Topics') }} &nbsp;
      <a href="{{ route('feed') }}" style="color: #E5974E; font-size: 14px;" target="_blank">
         <i class="fa fa-rss"></i>
      </a>
    </h3>

  </div>

  <div class="panel-body">
	@include('topics.partials.topics', ['column' => true])
  </div>

  <div class="panel-footer text-right">

  	<a href="topics?filter=excellent">
  		{{ trans('template.More Excellent Topics...') }}...
  	</a>
  </div>
</div>

<!-- Nodes Listing -->
@include('nodes.partials.list')

@stop
