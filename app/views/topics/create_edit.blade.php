@extends('layouts.default')

@section('title')
创建新话题_@parent
@stop

@section('content')

<div class="topic_create">

  <div class="col-md-8 main-col">

    <div class="reply-box form box-block">

      <div class="alert alert-warning">
          {{ lang('be_nice') }}
      </div>

      @include('layouts.partials.errors')

      @if(isset($topic))
          {{ Form::model($topic, ['route' => ['topics.update', $topic->id], 'method' => 'patch']) }}
      @else
          {{ Form::open(['route' => 'topics.store', 'method' => 'post']) }}
      @endif

        <div class="form-group">
            <select class="selectpicker form-control" name="node_id" >

              <option value="" disabled {{ App::make('Topic')->present()->haveDefaultNode($node, null) ?: 'selected'; }}>{{ lang('Pick a node') }}</option>

              @foreach ($nodes['top'] as $top_node)
                <optgroup label="{{{ $top_node->name }}}">
                  @foreach ($nodes['second'][$top_node->id] as $snode)
                    <option value="{{ $snode->id }}" {{ App::make('Topic')->present()->haveDefaultNode($node, $snode) ? 'selected' : ''; }} >{{ $snode->name }}</option>
                  @endforeach
                </optgroup>
              @endforeach
            </select>
        </div>

        <div class="form-group">
          {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => lang('Please write down a topic')]) }}
        </div>

        @include('topics.partials.composing_help_block')

        <div class="form-group">
          {{ Form::textarea('body', null, ['class' => 'form-control',
                                            'rows' => 20,
                                            'style' => "overflow:hidden",
                                            'id' => 'reply_content',
                                            'placeholder' => lang('Please using markdown.')]) }}
        </div>

        <div class="form-group status-post-submit">
          {{ Form::submit(lang('Publish'), ['class' => 'btn btn-primary', 'id' => 'topic-create-submit']) }}
        </div>

        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

      {{ Form::close() }}

    </div>
  </div>

  <div class="col-md-4 side-bar">

    @if ( $node )

    <div class="panel panel-default corner-radius help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ lang('Current Node') }} : {{{ $node->name }}}</h3>
      </div>
      <div class="panel-body">
        {{ $node->description }}
      </div>
    </div>

    @endif

    <div class="panel panel-default corner-radius help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ lang('This kind of topic is not allowed.') }}</h3>
      </div>
      <div class="panel-body">
        <ul class="list">
          <li>这里放一些关于论坛的基本说明</li>
          <li>请尽量分享技术相关的话题, 谢绝发布社会, 政治等相关新闻</li>
          <li>这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题</li>
          <li>这里绝对不会全文转载任何文章，而只会以链接方式分享</li>
      </div>
    </div>

    <div class="panel panel-default corner-radius help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">{{ lang('We can benefit from it.') }}</h3>
      </div>
      <div class="panel-body">
        <ul class="list">
          <li>分享生活见闻, 分享知识</li>
          <li>接触新技术, 讨论技术解决方案</li>
          <li>为自己的创业项目找合伙人, 遇见志同道合的人</li>
          <li>自发线下聚会, 加强社交</li>
          <li>发现更好工作机会</li>
          <li>甚至是开始另一个神奇的开源项目</li>
        </ul>
      </div>
    </div>

  </div>
</div>

@stop
