
@if ($topic->is_excellent || $topic->is_wiki)
  <div class="ribbon">
    @if ($topic->is_excellent)
      <div class="ribbon-excellent">
          <i class="fa fa-trophy"></i> 本帖已被设为精华帖！
      </div>
    @endif

    @if ($topic->is_wiki)
      <div class="ribbon-wiki">
          <i class="fa fa-graduation-cap"></i> 本帖已被设为社区 Wiki！
      </div>
    @endif  
  </div>
@endif