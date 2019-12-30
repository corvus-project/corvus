@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('customer::labels.customers.management'))

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{  __('customer::labels.customers.management') }}
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-sm-7">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                            <a href="{{ route('admin.customers.index') }}" class="btn btn-success btn-sm m-1"
                                data-toggle="tooltip" title="List the Customers"><i class="fas fa-list"></i></a>

                            <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm m-1"
                                data-toggle="tooltip" title="New Customer"><i class="fas fa-plus"></i></a>

                            @if(!empty($user))
                            <a href="{{ route('admin.customers.view', $user->id) }}" class="btn btn-info btn-sm m-1"
                                data-toggle="tooltip" title="Back to customer"><i
                                    class="fas fa-arrow-alt-circle-left"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <form autocomplete="off" role="form"
                    action="{{ (isset($user)) ? route('admin.customers.edit', [$user->id]) : route('admin.customers.store') }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group row {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name"
                            class="col-sm-3 col-form-label">{{ trans('customer::labels.customers.name') }}</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                                value="{{{ old('name', isset($user) ? $user->name : null) }}}"> {!!
                            $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('email', 'has-warning') !!}">
                        <label for="email"
                            class="col-sm-3 col-form-label">{{ trans('customer::labels.customers.email') }}</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                                value="{{{ old('email', isset($user) ? $user->email : null) }}}"> {!!
                            $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('password', 'has-warning') !!}">
                        <label for="password"
                            class="col-sm-3 col-form-label">{{ trans('customer::labels.customers.password') }}</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="password" name="password" />
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('password_confirmation', 'has-warning') !!}">
                        <label for="password_confirmation"
                            class="col-sm-3 col-form-label">{{ trans('customer::labels.customers.password_confirmation') }}</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" />
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
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