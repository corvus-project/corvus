@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.products.management'))


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Profile</h4>
            </div>
            <div class="card-body">
 
                <form autocomplete="off" role="form" action="{{ route('user.profile.save') }}" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.profile.name') }} {{ old('name')  }}</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                            value="{{{ old('name', isset($user) ? $user->name : null) }}}"> {!!
                        $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->first('email', 'has-warning') !!}">
                        <label for="email">{{ trans('labels.profile.email') }} {{ old('email')  }}</label>
                        <input type="text" class="form-control" id="email" name="email" autocomplete="off"
                            value="{{{ old('email', isset($user) ? $user->email : null) }}}"> {!!
                        $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->first('password', 'has-warning') !!}">
                        <label for="password">{{ trans('labels.profile.password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" /> {!!
                        $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->first('password_confirmation', 'has-warning') !!}">
                        <label for="password_confirmation">{{ trans('labels.profile.password_confirmation') }}</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" /> {!! $errors->first('password_confirmation', '<span
                            class="help-block">:message</span>') !!}
                    </div>


                    <button type="submit" class="btn btn-primary btn-sm mb-4 float-right">
                        <i data-feather="save" class="align-middle"></i> <span
                            class="align-middle"><strong>{{__('labels.general.buttons.save')}}</strong></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection