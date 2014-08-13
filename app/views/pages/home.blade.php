@extends('layouts.default')

@section('content')

<div class="panel panel-default">
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


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">节点导航</h3>
  </div>
  
  <div class="panel-body">
	<dl class="dl-horizontal">
	    @foreach ($nodes['top'] as $top_node)
		    <dt>{{{ $top_node->name }}}</dt>
			<dd>
				@foreach ($nodes['second'][$top_node->id] as $snode)
		          <a href="{{ route('nodes.show', [$snode->id]) }}">{{ $snode->name }}</a>
		        @endforeach
			</dd>
			<div class="divider"></div>
	    @endforeach
	</dl>
  </div>

</div>

@stop