@extends('layouts.default')

@section('title')
{{ $user->name }} 的个人资料_@parent 
@stop

@section('content')


<div class="col-md-8 col-md-offset-2 users-show">

  <div class="panel panel-default">

    @include('users.partials.infonav', ['current' => 'basicinfo'])

    <div class="panel-body ">

        <div style="text-align: center;" class="pull-right col-xs-3">
          <a href="/summer_charlie">
            <img src="http://ruby-china.org/avatar/90772cf58eb0f09b4dc41d5f1ca1334c.png?s=240&amp;d=404" class="img-thumbnail avatar">
          </a>
        </div>

        <dl class="dl-horizontal pull-left col-xs-9">
          
          <dt><lable>&nbsp; </lable></dt><dd>第 {{ $user->id }} 位会员</dd>

          <dt><label>Name:</label></dt><dd><strong>{{ $user->name }}</strong></dd>
          
          @if (isset($user->company))
            <dt class="adr"><label>公司:</label></dt><dd><span class="org">{{ $user->company }}</span></dd>  
          @endif
          
          @if (isset($user->twitter_account))
          <dt><label><span>Twitter</span>:</label></dt>
          <dd>
            <a href="https://twitter.com/{{ $user->twitter_account }}" rel="nofollow" class="twitter">{{ '@' . $user->twitter_account }}
            </a>
          </dd>
          @endif
          
          @if (isset($user->personal_website))
          <dt><label>博客:</label></dt>
          <dd>
            <a href="{{ $user->personal_website }}" rel="nofollow" target="_blank" class="url">
              {{ str_limit($user->personal_website, 30) }}
            </a>
          </dd>
          @endif
          
          @if (isset($user->signature))
          <dt><label>签名:</label></dt><dd><span>{{ $user->signature }}</span></dd>
          @endif

          @if (isset($user->description))
          <dt><label>个人简介:</label></dt><dd><span>{{ $user->description }}</span></dd>
          @endif

          <dt>
            <label>Since:</label>
          </dt>
          <dd><span>{{ $user->created_at }}</span></dd>
        </dl>
        <div class="clearfix"></div>
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
