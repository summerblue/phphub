<ul class="list-group row">

  @foreach ($replies as $reply)
   <li class="list-group-item media" style="margin-top: 0px;">

    <div class="avatar pull-left">
      <a href="{{ route('users.show', [$reply->user_id]) }}">
        <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="holder.js/48x48"/>
      </a>
    </div>

    <div class="infos">

      <div class="media-heading">
        <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}" class="">
            {{ $reply->user->name }}
        </a>
      </div>

      <div class="media-body">
        {{ $reply->body }}
      </div>
      
    </div>

  </li>
  @endforeach

</ul>
