
@if ($topic->is_excellent || $topic->is_wiki)
  <div class="ribbon">
    @if ($topic->is_excellent)
      <div class="ribbon-excellent">
          <i class="fa fa-trophy"></i> {{ trans('template.This topic has been mark as Excenllent Topic.') }}
      </div>
    @endif

    @if ($topic->is_wiki)
      <div class="ribbon-wiki">
          <i class="fa fa-graduation-cap"></i> {{ trans('template.This is a Community Wiki.') }}
      </div>
    @endif
  </div>
@endif
