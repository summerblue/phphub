@extends('layouts.default')

@section('title')
{{ $topic->title }}_@parent 
@stop

@section('content')

<div class="col-md-9 topics-show main-col">

  <!-- Topic Detial -->
  <div class="topic hentry panel panel-default">
    <div class="infos panel-heading">

      <div class="pull-right avatar_large">
        <a href="{{ route('users.show', $topic->user->id) }}">
          <img src="holder.js/52x52"/>
        </a>
      </div>

      <h1 class="panel-title topic-title">{{ $topic->title }}</h1>
      @include('topics.partials.meta')
    </div>

    <div class="body entry-content panel-body">
      {{ $topic->body }}

      @include('topics.partials.ribbon')
    </div>

    @include('topics.partials.topic_operate')
  </div>

  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
      <div class="total">共收到 <b>{{ $replies->getTotal() }}</b> 条回复</div>    
    </div>

    <div class="panel-body">
      @include('topics.partials.replies')  

      <!-- Pager -->
      <div class="pull-right" style="padding-right:20px"> 
        {{ $replies->appends(Request::except('page'))->links(); }}
      </div>
    </div>
  </div>

  <!-- Reply Box -->
  <div class="reply-box form box-block">
    @include('layouts.partials.errors')

    {{ Form::open(['route' => 'replies.store', 'method' => 'post']) }}
      <input type="hidden" name="topic_id" value="{{ $topic->id }}" />
      <div class="form-group">
        {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => "请使用 Markdown 格式书写 ;-)"]) }}
      </div>
      <div class="form-group status-post-submit">
        {{ Form::submit('提交回复', ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) }}
      </div>
      <ul class="helpblock">
        <li>支持 Markdown 格式,<strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code></li>
        <li>支持表情，见<a href="http://www.emoji-cheat-sheet.com" target="_blank" rel="nofollow">Emoji cheat sheet</a></li>
      </ul>
    {{ Form::close() }}
  </div>

</div>

@include('layouts.partials.sidebar')

@stop