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
          <img src="{{ $topic->user->present()->gravatar }}" style="width:65px; height:65px;" class="img-thumbnail avatar" />
        </a>
      </div>

      <h1 class="panel-title topic-title">{{{ $topic->title }}}</h1>

      <div class="votes">

        <a data-method="post" href="{{ route('topics.upvote', $topic->id) }}" title="{{ lang('Up Vote') }}" id="up-vote" class="vote {{ $currentUser && $topic->votes()->ByWhom(Auth::user()->id)->WithType('upvote')->count() ? 'active' :''; }}">
            <li class="fa fa-chevron-up"></li> {{ $topic->vote_count }}
        </a>
         &nbsp;
        <a data-method="post" href="{{ route('topics.downvote', $topic->id) }}" title="{{ lang('Down Vote') }}" id="down-vote" class="vote {{ $currentUser && $topic->votes()->ByWhom(Auth::user()->id)->WithType('downvote')->count() ? 'active' :''; }}">
            <li class="fa fa-chevron-down"></li>
        </a>
      </div>

      @include('topics.partials.meta')
    </div>

    <div class="content-body entry-content panel-body">

      @include('topics.partials.body', array('body' => $topic->body))

      @include('topics.partials.ribbon')
    </div>

    @include('topics.partials.topic_operate')
  </div>

  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
      <div class="total">{{ lang('Total Reply Count') }}: <b>{{ $replies->getTotal() }}</b> </div>
    </div>

    <div class="panel-body">

      @if (count($replies))
        @include('topics.partials.replies')
      @else
         <div class="empty-block">{{ lang('No comments') }}~~</div>
      @endif

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

        @include('topics.partials.composing_help_block')

        <div class="form-group">
            @if ($currentUser)
              {{ Form::textarea('body', null, ['class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => lang('Please using markdown.'),
                                                'style' => "overflow:hidden",
                                                'id' => 'reply_content']) }}
            @else
              {{ Form::textarea('body', null, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => 5, 'placeholder' => lang('User Login Required for commenting.')]) }}
            @endif
        </div>

        <div class="form-group status-post-submit">

            @if ($currentUser)
              {{ Form::submit(lang('Reply'), ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) }}
            @else
              {{ Form::submit(lang('Reply'), ['class' => 'btn btn-primary disabled', 'id' => 'reply-create-submit']) }}
            @endif

            <span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>
        </div>

        <div class="box preview markdown-reply" id="preview-box" style="display:none;"></div>

    {{ Form::close() }}
  </div>

</div>

@include('layouts.partials.sidebar')

@stop
