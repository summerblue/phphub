@extends('layouts.default')

@section('content')

<div class="panel panel-default list-panel">
  <div class="panel-heading">
    <h3 class="panel-title text-center">社区精华帖</h3>
  </div>
  
  <div class="panel-body">
	@include('topics.partials.topics', ['column' => true])
  </div>

  <div class="panel-footer text-right">
  	<a href="topics?filter=excellent">
  		查看更多精华帖...
  	</a>
  </div>
</div>

<!-- Nodes Listing -->
@include('nodes.partials.list')

@stop