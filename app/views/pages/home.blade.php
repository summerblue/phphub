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


<div class="panel panel-default node-panel">
  <div class="panel-heading">
    <h3 class="panel-title text-center">节点导航</h3>
  </div>
  
  <div class="panel-body remove-padding-bottom">
	<dl class="dl-horizontal">
	    @foreach ($nodes['top'] as $index => $top_node)
		    <dt>{{{ $top_node->name }}}</dt>
			<dd>

        <ul class="list-inline">
          @foreach ($nodes['second'][$top_node->id] as $snode)
              <li><a href="{{ route('nodes.show', [$snode->id]) }}">{{ $snode->name }}</a></li>
          @endforeach
        </ul>
				
			</dd>

        @if (count($nodes['top']) != $index +1 )
          <div class="divider"></div>
        @endif
			
	    @endforeach
	</dl>
  </div>

</div>

@stop