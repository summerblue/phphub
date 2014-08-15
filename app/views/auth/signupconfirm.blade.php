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

            <fieldset>
              <div class="form-group">
                <img src="{{ $githubUser['image_url'] }}" width="100%" />
              </div>
              <div class="form-group"><b>Name: </b>
                @if(isset($githubUser['name']))
                    {{ $githubUser['name'] }}
                @endif
              </div>
              <div class="form-group"><b>Email: </b>
                @if(isset($githubUser['email']))
                    {{ $githubUser['email'] }}
                @endif
              </div>

              {{ Form::submit('确 定', ['class' => 'btn btn-lg btn-success btn-block']) }}
            </fieldset>

          {{ Form::close() }}

        </div>
      </div>
    </div>
  </div>

@stop
