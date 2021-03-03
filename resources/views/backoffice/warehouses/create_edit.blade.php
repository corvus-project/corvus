@extends('adminlte::page')

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
                            <a href="{{ route('backoffice.warehouses.create') }}" class="btn btn-primary btn-xs m-1"
                                data-toggle="tooltip" title="Create a warehouse"><i class="fas fa-plus"></i></a>
                                <a href="{{ route('backoffice.warehouses.index') }}" class="btn btn-success btn-xs m-1"
                                data-toggle="tooltip" title="List the warehouses"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>


                @include('includes.partials.messages')

                <form autocomplete="off" role="form"
                    action="{{ (isset($warehouse)) ? route('backoffice.warehouses.update', $warehouse->id) : route('backoffice.warehouses.store') }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.warehouses.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                            value="{{{ old('name', isset($warehouse) ? $warehouse->name : null) }}}"> {!!
                        $errors->first('name', '<span class="help-block">:message</span>') !!}
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