@extends('layouts.default')

@section('title')
编辑个人资料_@parent
@stop

@section('content')

<div class="users-show">

  <div class="col-md-3 box" style="padding: 15px 15px;">
    @include('users.partials.basicinfo')
  </div>

  <div class="main-col col-md-9 left-col">

    <div class="panel panel-default">

      <div class="panel-body ">

        <div class="alert alert-warning">
          {{ trans('template.avatar_notice') }}
        </div>

        @include('layouts.partials.errors')

        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) }}

          <div class="form-group">
            {{ Form::text('real_name', null, ['class' => 'form-control', 'placeholder' => trans('template.Real Name')]) }}
          </div>

          <div class="form-group">
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => trans('template.City')]) }}
          </div>

          <div class="form-group">
            {{ Form::text('company', null, ['class' => 'form-control', 'placeholder' => trans('template.Company')]) }}
          </div>

          <div class="form-group">
            {{ Form::text('twitter_account', null, ['class' => 'form-control', 'placeholder' => trans('template.twitter_placeholder')]) }}
          </div>

          <div class="form-group">
            {{ Form::text('personal_website', null, ['class' => 'form-control', 'placeholder' => trans('template.personal_website_placebolder')]) }}
          </div>

          <div class="form-group">
            {{ Form::textarea('signature', null, ['class' => 'form-control',
                                              'rows' => 3,
                                              'placeholder' => trans('template.signature_placeholder')]) }}
          </div>

          <div class="form-group">
            {{ Form::textarea('introduction', null, ['class' => 'form-control',
                                              'rows' => 3,
                                              'placeholder' => trans('template.introduction_placeholder')]) }}
          </div>

          <div class="form-group status-post-submit">
            {{ Form::submit(trans('template.Publish'), ['class' => 'btn btn-primary', 'id' => 'user-edit-submit']) }}
          </div>

        {{ Form::close() }}

      </div>

    </div>
  </div>


</div>




@stop
