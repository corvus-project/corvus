@extends('adminlte::page')
@section('title', config('corvus.app_name') . ' | ' . __('labels.products.categories.create'))

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{  __('labels.products.categories.create') }}
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-sm-7">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">

                        <a href="{{ route('backoffice.products.view_categories', $product->id) }}"
                                class="btn btn-success btn-xs m-1" data-toggle="tooltip"
                                title="List the categories"><i class="fas fa-list"></i></a>

                            <a href="{{ route('backoffice.products.create_category', $product->id) }}"
                                class="btn btn-primary btn-xs m-1" data-toggle="tooltip"
                                title="{{  __('labels.products.categories.create') }}"><i class="fas fa-plus"></i></a>

                            <a href="{{ route('backoffice.products.view', $product->id) }}" class="btn btn-info btn-xs m-1"
                                data-toggle="tooltip" title="Back to product"><i
                                    class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                </div>

                @include('includes.product_box')
                <br />

                @include('includes.partials.messages')
                <form autocomplete="off" role="form"
                    action="{{ route('backoffice.products.create_category.store', $product->id) }}" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group row {!! $errors->first('category_id', 'has-warning') !!}">
                        <label for="name"
                            class="col-sm-3 col-form-label">{{ trans('labels.products.categories.all') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('category_id', $categories, null, ['class'=>'form-control col-sm-5 categories']) }}
                            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
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

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
@parent
@stop
@section('scripts')
@parent

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js">
</script>

<script type="text/javascript">
$(function() {
    $('.categories').select2({
        placeholder: 'Select an category'
    });
});
</script>

@stop
