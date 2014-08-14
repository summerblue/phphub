@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">提 示</h3>
        </div>
        <div class="panel-body">

          {{ Form::open(['route'=>'login', 'method'=>'get']) }}

            <fieldset>
              <div class="alert alert-warning">
                很抱歉, 当前用户没有权限继续操作. <br>
                有什么问题请联系管理员.
              </div>
              {{ Form::submit('使用 Github 帐号登录', ['class' => 'btn btn-lg btn-success btn-block', 'id' => 'login-required-submit']) }}
            </fieldset>

          {{ Form::close() }}

        </div>
      </div>
    </div>
  </div>

@stop
