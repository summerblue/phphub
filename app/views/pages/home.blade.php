@extends('layouts.default')

@section('content')

<div class="box text-center">
  功能正在完善中，欢迎 <i class="fa fa-github" style="font-size:15px"></i> <a href="https://github.com/summerblue/phphub">贡献代码</a> 或 <a href="https://github.com/summerblue/phphub/issues">提交 Issue</a>。
</div>

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