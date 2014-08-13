@extends('layouts.default')

@section('content')

@if ( ! $topics->isEmpty())
	
      <div class="col-md-9">

		<div class="panel panel-default">
			<div class="panel-heading">
	          
	          @if (isset($node))
	          	<div class="pull-left panel-title">当前节点: {{ $node->name }}</div>
	          @endif

			  @include('topics.partials.filter')

	          <div class="clearfix"></div>
	        </div>
			
			<div class="panel-body">
				@include('topics.partials.topics', ['column' => false])
	
		       <!-- Pager -->
		        <div class="pull-right" style="padding-right:20px"> 
				      {{ $topics->appends(Request::except('page'))->links(); }}
				</div>
			</div>

		</div>
        
      </div>

      @include('layouts.partials.sidebar')

@else
	There are no topics
@endif

@stop
