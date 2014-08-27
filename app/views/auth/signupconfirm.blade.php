@extends('layouts.default')

@section('title')
确定创建帐号_@parent
@stop

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">创建新账号</h3>
        </div>
        <div class="panel-body">

            {{ Form::open() }}

                <div class="form-group">
                    <label class="control-label" for="name">头 像</label>
                    <div class="form-group">
                        <img src="{{ $githubUser['image_url'] }}" width="100%" />
                    </div>
                </div>

                <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                    <label class="control-label" for="name">用户名</label>
                    {{ Form::text('name', ($githubUser['name'] ?: ''), ['class' => 'form-control']) }}
                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                </div>

                <div class="form-group {{{ $errors->has('github_name') ? 'has-error' : '' }}}">
                    <label class="control-label" for="github_name">Github Name</label>
                    {{ Form::text('github_name', (isset($githubUser['github_name']) ? $githubUser['github_name'] : $githubUser['name']), ['class' => 'form-control', 'readonly'=>'readonly']) }}
                    {{ $errors->first('github_name', '<span class="help-block">:message</span>') }}
                </div>

                <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                    <label class="control-label" for="email">邮 箱</label>
                    {{ Form::text('email', ($githubUser['email'] ?: ''), ['class' => 'form-control', 'readonly'=>'readonly']) }}
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                </div>

                {{ Form::submit('确 定', ['class' => 'btn btn-lg btn-success btn-block']) }}

            {{ Form::close() }}

        </div>
      </div>
    </div>
  </div>

@stop
