@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.pricing_groups.management'))


@section('content')

@include('includes.partials.messages')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{  __('labels.pricing_groups.management') }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                            <a href="{{ route('backoffice.pricing_groups.create') }}" class="btn btn-success btn-xs m-1"
                                data-toggle="tooltip" title="Create a group"><i class="fas fa-plus"></i></a>
                                <a href="{{ route('backoffice.pricing_groups.index') }}" class="btn btn-success btn-xs m-1"
                                data-toggle="tooltip" title="List the pricing groups"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>

                <form autocomplete="off" role="form"
                    action="{{ (isset($group)) ? route('backoffice.pricing_groups.update', $group->id) : route('backoffice.pricing_groups.store') }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.pricing_groups.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                            value="{{{ old('name', isset($group) ? $group->name : null) }}}"> {!!
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