@extends('layouts.default')

@section('title')
编辑个人资料_@parent 
@stop

@section('content')

<div class="users-show">

  <div class="col-md-3 box" style="padding: 15px 15px;">
    @include('users.partials.basicinfo')
  </div>

  <div class="main-col col-md-9 left-col">

    <div class="panel panel-default">
      
      <div class="panel-body ">

        <div class="alert alert-warning">
          如需修改头像, 请到 <a href="https://github.com/settings/profile" target="_blank">Github 的个人设置</a> 页面修改, 注意头像会有缓存, 估计一个小时内会见效.
        </div>

        @include('layouts.partials.errors')
          
        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) }}

          <div class="form-group">
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => "现在所在的城市"]) }}
          </div>

          <div class="form-group">
            {{ Form::text('company', null, ['class' => 'form-control', 'placeholder' => "你目前的公司"]) }}
          </div>

          <div class="form-group">
            {{ Form::text('twitter_account', null, ['class' => 'form-control', 'placeholder' => "你的 Twitter 帐号, 不需要加前缀 https://twitter.com/"]) }}
          </div>

          <div class="form-group">
            {{ Form::text('personal_website', null, ['class' => 'form-control', 'placeholder' => "你的个人网站, 不需要加前缀 http://"]) }}
          </div>

          <div class="form-group">
            {{ Form::textarea('signature', null, ['class' => 'form-control', 
                                              'rows' => 3, 
                                              'placeholder' => "签名/座右铭"]) }}
          </div>

          <div class="form-group">
            {{ Form::textarea('description', null, ['class' => 'form-control', 
                                              'rows' => 3, 
                                              'placeholder' => "个人简介"]) }}
          </div>

          <div class="form-group status-post-submit">
            {{ Form::submit('发 布', ['class' => 'btn btn-primary', 'id' => 'user-edit-submit']) }}
          </div>

        {{ Form::close() }}

      </div>

    </div>
  </div>


</div>




@stop
