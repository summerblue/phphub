@extends('layouts.default')

@section('title')
用户列表_@parent 
@stop

@section('content')

<div class="panel panel-default">
  <div class="panel-heading text-center">TOP 108 活跃会员 (目前已经有 10381 位会员加入了 PHPhub。)</div>


  <div class="panel-body">
    @foreach ($users as $user)
    
      <div class="col-md-1 remove-padding-right">
        <div class="avatar">
          <a href="{{ route('users.show', $user->id) }}">
            <img src="{{ $user->present()->gravatar }}" class="img-thumbnail avatar"  style="width:48px;height:48px;margin-bottom: 20px;"/>
          </a>
        </div>

      </div>
    
    @endforeach
  </div>
  
  

</div>
@stop
