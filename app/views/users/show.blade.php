@extends('layouts.default')

@section('title')
{{{ $user->name }}} 的个人资料_@parent 
@stop

@section('content')


<div class="col-md-8 col-md-offset-2 users-show">

  <div class="panel panel-default">

    @include('users.partials.infonav', ['current' => 'basicinfo'])

      <div class="panel-body ">
        @include('users.partials.basicinfo')
      </div>

    </div>  

  
  <div class="panel panel-default">

    <ul class="nav nav-tabs user-info-nav" role="tablist">
      <li class="active"><a href="#recent_replies" role="tab" data-toggle="tab">最新评论</a></li>
      <li><a href="#recent_topics" role="tab" data-toggle="tab">最近话题</a></li>
    </ul>
    
    <div class="panel-body remove-padding-vertically remove-padding-horizontal">
      <!-- Tab panes -->
      <div class="tab-content">
      
        <div class="tab-pane active" id="recent_replies">

          @if (count($replies))
            @include('users.partials.replies')
          @else
            <div class="empty-block">还未留下任何评论~~</div>
          @endif
          
        </div>

        <div class="tab-pane" id="recent_topics">
          @if (count($topics))
            @include('users.partials.topics')
          @else
            <div class="empty-block">还未发布任何话题~~</div>
          @endif
        </div>

      </div>
    </div>

  </div>



</div>


@stop
