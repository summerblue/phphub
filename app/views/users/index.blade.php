@extends('layouts.default')

@section('title')
用户列表_@parent 
@stop

@section('content')

<div class="panel panel-default">
  <div class="panel-heading text-center">TOP 108 活跃会员 (目前已经有 10381 位会员加入了 PHPhub。)</div>


  <div class="panel-body">
    @foreach ($users as $user)
    
      <div class="col-md-1 item">
        <div class="avatar">
          <a href="{{ route('users.show', $user->id) }}">
            <img src="holder.js/48x48" class="img-thumbnail"/>
          </a>
        </div>

        <div class="name">
          <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
        </div>
      </div>
    
    @endforeach
  </div>
  
  

</div>
@stop
