@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('customer::labels.customers.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="List the Customers"><i class="fas fa-list"></i></a>

                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm m-1"
                        data-toggle="tooltip" title="New Customer"><i class="fas fa-plus"></i></a>

                        <a href="{{ route('admin.customers.edit', $user->id) }}" class="btn btn-info btn-sm m-1"
                        data-toggle="tooltip" title="Edit the Customer"><i class="fas fa-pen"></i></a>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->


        <div class="row">
            <div class="col-sm-5"><b>ID</b></div>
            <div class="col-sm-7">{{ $user->id }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Name</b></div>
            <div class="col-sm-7">{{ $user->name }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Email</b></div>
            <div class="col-sm-7">{{ $user->email }}</div>
        </div>
        <br />


        <form autocomplete="off" role="form"
                    action="{{ route('admin.customers.profile.update', $user->id)  }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
 
                    <div class="form-group row {!! $errors->first('pricing_group_id', 'has-warning') !!}">
                        <label for="pricing_group_id" class="col-sm-3 col-form-label">{{ trans('labels.products.pricing_group') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('pricing_group_id', $pricing_groups, (isset($profile) ? $profile->pricing_group_id : null), ['class'=>'form-control col-sm-3']) }}
                            {!! $errors->first('pricing_group_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name" class="col-sm-3 col-form-label">{{ trans('labels.products.name') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('stock_type_id', $stock_types, (isset($profile) ? $profile->stock_type_id : null), ['class'=>'form-control col-sm-3']) }}
                            {!! $errors->first('stock_type_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                        <i class="fas fa-save align-middle"></i> <span
                            class="align-middle"><strong>{{__('labels.general.buttons.save')}}</strong></span>
                    </button>
                </form>


    </div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop