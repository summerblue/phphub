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
          <a href="member.html">
            <img alt="2880" src="holder.js/48x48" class="uface"/>
          </a>
        </div>

        <div class="name">
          <a href="member.html">{{ $user->name }}</a>
        </div>
      </div>
    
    @endforeach
  </div>
  
  

</div>
@stop
