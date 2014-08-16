@extends('layouts.default')

@section('title')
创建新话题_@parent 
@stop

@section('styles')
    <link rel="stylesheet" href="{{ cdn("styles/bootstrap-select.min.css") }}"/>
@stop

@section('content')

<div class="topic_create">

  <div class="col-md-8">

    <div class="reply-box form box-block">

      <div class="alert alert-warning">
        我们希望 PHPHub 能够成为技术氛围最好的 PHP 社区，而实现这个目标，需要我们所有人的共同努力：友善，公平，尊重知识和事实。
      </div>

      @include('layouts.partials.errors')

      {{ Form::open(['route' => 'topics.store', 'method' => 'post']) }}

        
        <div class="form-group">
            <select class="selectpicker form-control" name="node_id" >
              
              <option value="" disabled {{ App::make('Topic')->present()->haveDefaultNode($node, null) ?: 'selected'; }}>请选择节点</option>

              @foreach ($nodes['top'] as $top_node)
                <optgroup label="{{ $top_node->name }}">
                  @foreach ($nodes['second'][$top_node->id] as $snode)
                    <option value="{{ $snode->id }}" {{ App::make('Topic')->present()->haveDefaultNode($node, $snode) ? 'selected' : ''; }} >{{ $snode->name }}</option>
                  @endforeach
                </optgroup>
              @endforeach
            </select> 
        </div>

        <div class="form-group">
          {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => "请填写标题"]) }}
        </div>

        <div class="form-group">
          {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => 20, 'placeholder' => "请使用 Markdown 格式书写 ;-)"]) }}
        </div>

        <div class="form-group status-post-submit">
          {{ Form::submit('发 布', ['class' => 'btn btn-primary', 'id' => 'topic-create-submit']) }}
        </div>

      {{ Form::close() }}


    </div>
  </div>

  <div class="col-sm-4 side-bar">
    
    @if ( $node )

    <div class="panel panel-default corner-radius box help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">当前节点 : {{ $node->name }}</h3>
      </div>
      <div class="panel-body">
        {{ $node->description }}
      </div>
    </div>

    @endif

    <div class="panel panel-default corner-radius box help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">格式说明</h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
          <li>支持 Markdown 格式,<strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code></li>
          <li>支持表情，见<a href="http://www.emoji-cheat-sheet.com" target="_blank" rel="nofollow">Emoji cheat sheet</a></li>
          <li>@name  会链接到用户页面，并会通知他</li>
          <li>![Alt text here](http://foo.com/bar.jpg) 显示图片</li>
          <li>http://example.org 自动加链接</li>
          <li>在标题中写入城市名称会自动归类到对应的城市节点上. </li>
        </ul>
      </div>
    </div>

    <div class="panel panel-default corner-radius box help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">以下类型的信息会污染我们的社区</h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
          <li>这里放一些关于论坛的基本说明</li>
          <li>请尽量分享技术相关的话题, 谢绝发布社会, 政治等相关新闻</li>
          <li>这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题</li>
          <li>这里绝对不会全文转载任何文章，而只会以链接方式分享</li>
      </div>
    </div>

    <div class="panel panel-default corner-radius box help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">在高质量优秀社区的我们</h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
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

@section('scripts')
    <script src="scripts/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.selectpicker').selectpicker();
        })
    </script>
@stop
