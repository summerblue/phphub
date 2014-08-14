@extends('layouts.default')

@section('content')

<div class="col-md-9 topic-view content">

<div class="topic-content topics hfeed box-block">
  
  <div class="topic hentry panel panel-default">
    <div class="infos panel-heading">
      <div class="pull-right avatar_large">
      	<a href="/tyaccp_guojian" class="avatar"><img alt="5453" src="holder.js/64x64" class="uface"/></a>
      </div>

      <h1 class="panel-title entry-title">{{ $topic->title }}</h1>

      <div class="info leader">
        <a href="{{ route('nodes.show', $topic->node->id) }}" class="node">{{{ $topic->node->name }}}</a>
        • 
        <a href="{{ route('users.show', $topic->user->id) }}">
          {{{ $topic->user->name }}}
        </a>
        •
        于<abbr title="{{ $topic->created_at }}" class="timeago">{{ $topic->created_at }}</abbr>发布
        •

        @if (count($topic->lastReplyUser))
          最后由 
            <a href="{{{ URL::route('users.show', [$topic->lastReplyUser->id]) }}}">
              {{{ $topic->lastReplyUser->name }}}
            </a>
           于 <abbr title="{{ $topic->updated_at }}" class="timeago">{{ $topic->updated_at }}</abbr>回复
          •
        @endif

        {{ $topic->view_count }} 次阅读
      </div>
		<div class="clearfix"></div>
    </div>

    <div class="body entry-content panel-body">
  		{{ $topic->body }}
    </div>

    @if ($topic->is_excellent)
      <div class="ribbon-excellent">
          <i class="fa fa-trophy"></i> 本帖已被设为精华帖！
      </div>
    @endif

    @if ($topic->is_wiki)
      <div class="ribbon-wiki">
          <i class="fa fa-database"></i> 本帖已被设为社区 Wiki！
      </div>
    @endif

  	<div class="tools small panel-footer">

  		<div class="pull-right">
  			<a data-followed="false" data-id="15887" href="#" onclick="return Topics.follow(this);" rel="twipsy" data-original-title="">
  		    <i class="glyphicon glyphicon-eye-open"></i> 关注
  		  </a>
        <a data-id="15887" href="#" onclick="return Topics.favorite(this);" rel="twipsy" data-original-title="收藏">
          <i class="glyphicon glyphicon-bookmark"></i> <span>收藏</span>
        </a>

        @if ($currentUser && $currentUser->can("manage_topics") )

          <a id="topic-recomend-button" href="{{ route('topics.recomend', [$topic->id]) }}" >
            <i class="fa fa-trophy"></i> <span>{{ $topic->is_excellent ? '取消推荐' : '推荐' }}</span>
          </a>

          <a id="topic-wiki-button" href="{{ route('topics.wiki', [$topic->id]) }}" rel="">
            <i class="fa fa-trophy"></i> <span>{{ $topic->is_wiki ? '取消Wiki' : '加入Wiki' }}</span>
          </a>

          <a id="topic-delete-button" href="{{ route('topics.delete', [$topic->id]) }}" rel="" onclick=" return confirm('确定要删除此话题吗?')">
            <i class="fa fa-trash-o"></i> <span>删除</span>
          </a>

        @endif
      
  		</div>
  	  	<div class="clearfix"></div>
  	</div>

  </div>
</div>


<div class="replies panel panel-default">

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
      <li>按“M”键查看更多<a href="#" data-target="#markdown_help_tip_modal" data-toggle="modal" data-keyboard="true" data-backdrop="true">帮助</a>。</li>
    </ul>

  {{ Form::close() }}

</div>
</div>

@include('layouts.partials.sidebar')

@stop