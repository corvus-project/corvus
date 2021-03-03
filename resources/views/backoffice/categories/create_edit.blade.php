@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.categories.management'))


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{  __('labels.categories.management') }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                            <a href="{{ route('backoffice.categories.create') }}" class="btn btn-success btn-xs m-1"
                                data-toggle="tooltip" title="Create a category"><i class="fas fa-plus"></i></a>
                                <a href="{{ route('backoffice.categories.index') }}" class="btn btn-success btn-xs m-1"
                                data-toggle="tooltip" title="List the categories"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>

                <form autocomplete="off" role="form"
                    action="{{ (isset($category)) ? route('backoffice.categories.update', $category->id) : route('backoffice.categories.store') }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.categories.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                            value="{{{ old('name', isset($category) ? $category->name : null) }}}"> {!!
                        $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->first('breadcrumb', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.categories.breadcrumb') }}</label>
                        <input type="text" class="form-control" id="breadcrumb" name="breadcrumb" autocomplete="off"
                            value="{{{ old('breadcrumb', isset($category) ? $category->breadcrumb : null) }}}"> {!!
                        $errors->first('breadcrumb', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->first('parent_id', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.categories.parent_id') }}</label>
                        <input type="text" class="form-control" id="parent_id" name="parent_id" autocomplete="off"
                            value="{{{ old('parent_id', isset($category) ? $category->parent_id : null) }}}"> {!!
                        $errors->first('parent_id', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->first('taxonomy_id', 'has-warning') !!}">
                        <label for="name">{{ trans('labels.categories.taxonomy_id') }}</label>
                        <input type="text" class="form-control" id="taxonomy_id" name="taxonomy_id" autocomplete="off"
                            value="{{{ old('taxonomy_id', isset($category) ? $category->taxonomy_id : null) }}}"> {!!
                        $errors->first('taxonomy_id', '<span class="help-block">:message</span>') !!}
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