@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.users.management'))

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-5">

                    </div>
                    <div class="col-sm-7">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                            @include('includes.user_submenu')
                        </div>
                    </div>
                </div>

                <form autocomplete="off" role="form"
                    action="{{ (isset($user)) ? route('admin.users.edit', [$user->id]) : route('admin.users.store') }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group row {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name" class="col-sm-3 col-form-label">{{ trans('labels.users.name') }}</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                                value="{{{ old('name', isset($user) ? $user->name : null) }}}"> {!!
                            $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('email', 'has-warning') !!}">
                        <label for="email" class="col-sm-3 col-form-label">{{ trans('labels.accounts.email') }}</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                                value="{{{ old('email', isset($user) ? $user->email : null) }}}"> {!!
                            $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('password', 'has-warning') !!}">
                        <label for="password"
                            class="col-sm-3 col-form-label">{{ trans('labels.accounts.password') }}</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="password" name="password" />
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('password_confirmation', 'has-warning') !!}">
                        <label for="password_confirmation"
                            class="col-sm-3 col-form-label">{{ trans('labels.accounts.password_confirmation') }}</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" />
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('role_id', 'has-warning') !!}">
                        <label for="role_id"
                            class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            {{ Form::select('role_id', $roles, (isset($user) ? $user->roles : null), ['class'=>'form-control col-sm-3']) }}
                            {!! $errors->first('role_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
  
                    <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                        <i class="fas fa-save align-middle"></i> <span
                            class="align-middle"><strong>{{__('labels.general.buttons.save')}}</strong></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection