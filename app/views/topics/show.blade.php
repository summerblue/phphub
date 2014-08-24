@extends('layouts.default')

@section('title')
{{{ $topic->title }}}_@parent
@stop

@section('description')
{{{ $topic->excerpt }}}
@stop

@section('content')

<div class="col-md-9 topics-show main-col">

  <!-- Topic Detial -->
  <div class="topic panel panel-default">
    <div class="infos panel-heading">

      <div class="pull-right avatar_large">
        <a href="{{ route('users.show', $topic->user->id) }}">
          <img src="{{ $topic->user->present()->gravatar }}" style="width:52px; height:52px;" class="img-thumbnail avatar" />
        </a>
      </div>

      <h1 class="panel-title topic-title">{{{ $topic->title }}}</h1>

      <div class="votes">
        <a href="{{ route('topics.upvote', $topic->id) }}" class="vote {{ $currentUser && $topic->votes()->ByWhom(Auth::user()->id)->WithType('upvote')->count() ? 'active' :''; }}">
          <li class="fa fa-chevron-up"></li> {{ $topic->vote_count }}
        </a> &nbsp;
        <a href="{{ route('topics.downvote', $topic->id) }}" class="vote {{ $currentUser && $topic->votes()->ByWhom(Auth::user()->id)->WithType('downvote')->count() ? 'active' :''; }}">
          <li class="fa fa-chevron-down"></li>
        </a>
      </div>

      @include('topics.partials.meta')
    </div>

    <div class="body entry-content panel-body">

      @include('topics.partials.body', array('body' => $topic->body))

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

      @if (count($replies))
        @include('topics.partials.replies')
      @else
         <div class="empty-block">还未有人评论~~</div>
      @endif

      <!-- Pager -->
      <div class="pull-right" style="padding-right:20px">
        {{ $replies->appends(Request::except('page'))->links(); }}
      </div>
    </div>
  </div>

  <!-- Reply Box -->
  <div class="reply-box form box-block">

    <ul class="list-inline editor-tool">
      <li class="active" id="edit-btn"><a href="javascript:void(0)" onclick="showEditor();" >编辑</a></li>
      <li id="preview-btn"><a href="javascript:void(0)" onclick="preview();" >预览</a></li>
    </ul>

    @include('layouts.partials.errors')

    <div class="preview display-none markdown-reply box">
没有内容..
    </div>

    {{ Form::open(['route' => 'replies.store', 'method' => 'post']) }}
      <input type="hidden" name="topic_id" value="{{ $topic->id }}" />
      <div class="form-group">

        @if ($currentUser)
          {{ Form::textarea('body', null, ['class' => 'form-control',
                                            'rows' => 5,
                                            'placeholder' => "请使用 Markdown 格式书写 ;-)",
                                            'style' => "overflow:hidden",
                                            'id' => 'reply_content']) }}
        @else
          {{ Form::textarea('body', null, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => 5, 'placeholder' => "登录用户才能发表评论."]) }}
        @endif

      </div>
      <div class="form-group status-post-submit">

        @if ($currentUser)
          {{ Form::submit('提交回复', ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) }}
        @else
          {{ Form::submit('提交回复', ['class' => 'btn btn-primary disabled', 'id' => 'reply-create-submit']) }}
        @endif

      </div>

        <ul class="helpblock list">
          <li>请注意单词拼写，以及中英文排版，<a href="https://github.com/sparanoid/chinese-copywriting-guidelines">参考此页</a></li>
          <li>支持 Markdown 格式,<strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code></li>
          <li>支持表情，见 <a href="http://www.emoji-cheat-sheet.com" target="_blank" rel="nofollow">Emoji cheat sheet</a></li>
          <li>@name 会链接到用户页面，并会通知他</li>
        </ul>
        <br>
        <br>
    {{ Form::close() }}
  </div>

</div>

@include('layouts.partials.sidebar')

@stop


@section('styles')
    <link rel="stylesheet" href="{{ cdn('css/prism.css') }}">
@stop

@section('scripts')
    <script src="{{ cdn('js/jquery.autosize.min.js') }}"></script>
    <script src="{{ cdn('js/prism.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('textarea').autosize();
        });
    </script>
@stop
