@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.warehouses.management'))


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{  __('labels.warehouses.management') }}</h4>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                            <a href="{{ route('admin.warehouses.create') }}" class="btn btn-success btn-sm m-1"
                                data-toggle="tooltip" title="Create a group"><i class="fas fa-plus"></i></a>
                            <a href="{{ route('admin.warehouses.index') }}" class="btn btn-success btn-sm m-1"
                                data-toggle="tooltip" title="List the warehouses"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>

                <form autocomplete="off" role="form" action="{{ route('admin.warehouses.destroy', $warehouse->id) }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.warehouses.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                            value="{{{ old('name', isset($warehouse) ? $warehouse->name : null) }}}" readonly> {!!
                        $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group">

                        <p>{{ trans_choice('labels.warehouses.stocks_count_definitions', $warehouse->stocks()->count()) }}</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                    <i class="fas fa-trash align-middle"></i> <span
                            class="align-middle"><strong>{{__('labels.general.buttons.delete')}}</strong></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection