@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">登 录</h3>
        </div>
        <div class="panel-body">

          {{ Form::open(['route'=>'login', 'method'=>'get']) }}

            <fieldset>
              <div class="alert alert-warning">
                需要登录后才能继续操作. <br>
                当前只允许通过 Github 帐号登录. 
              </div>
              {{ Form::submit('使用 Github 帐号登录', ['class' => 'btn btn-lg btn-success btn-block', 'id' => 'login-required-submit']) }}
            </fieldset>

          {{ Form::close() }}

        </div>
      </div>
    </div>
  </div>

@stop
