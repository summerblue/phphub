
<ul class="nav nav-tabs user-info-nav" role="tablist">
  <li class="{{ $user->present()->userinfoNavActive('users.show') }}">
  	<a href="{{ route('users.show', $user->id) }}" >个人信息</a>
  </li>
  <li class="{{ $user->present()->userinfoNavActive('users.replies') }}">
  	<a href="{{ route('users.replies', $user->id) }}" >评论</a>
  </li>
  <li class="{{ $user->present()->userinfoNavActive('users.topics') }}">
  	<a href="{{ route('users.topics', $user->id) }}" >话题</a>
  </li>
  <li class="{{ $user->present()->userinfoNavActive('users.favorites') }}">
  	<a href="{{ route('users.favorites', $user->id) }}" >收藏</a>
  </li>
</ul>