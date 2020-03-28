@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.stock_management'))


@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.products.stock_history') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('admin.products.view_stocks', $product->id) }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="List the stock history"><i class="fas fa-list"></i></a>

                    <a href="{{ route('admin.products.create_stock', $product->id) }}"
                        class="btn btn-primary btn-sm m-1" data-toggle="tooltip" title="Create a stock"><i
                            class="fas fa-plus"></i></a>

                    <a href="{{ route('admin.products.view', $product->id) }}" class="btn btn-info btn-sm m-1"
                        data-toggle="tooltip" title="Back to product"><i class="fas fa-arrow-alt-circle-left"></i></a>
                </div>
            </div>
            <!--col-->
        </div>
        @include('includes.product_box')
        <br />
        <!--row-->
        <div class="row">
            <div class="col-sm-6">
                <h4>Stock History</h4>
            </div>
            <div class="col-sm-6">

            </div>
        </div>

        <form autocomplete="off" role="form"
            action="{{ route('admin.products.delete_stock.destroy', [$stock->product_id, $stock->id]) }}" method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

            <div class="form-group row {!! $errors->first('name', 'has-warning') !!}">
                <label for="name" class="col-sm-3 col-form-label">{{ trans('labels.products.warehouse') }}</label>
                <div class="col-sm-9">
                    {{ Form::select('warehouse_id', $warehouses, (isset($stock) ? $stock->warehouse_id : null), ['class'=>'form-control col-sm-3', 'disabled']) }}
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->first('name', 'has-warning') !!}">
                <label for="name" class="col-sm-3 col-form-label">{{ trans('labels.products.stock_group') }}</label>
                <div class="col-sm-9">
                    {{ Form::select('stock_group_id', $stock_groups, (isset($stock) ? $stock->stock_group_id : null), ['class'=>'form-control col-sm-3', 'disabled']) }}
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->first('quantity', 'has-warning') !!}">
                <label for="quantity" class="col-sm-3 col-form-label">{{ trans('labels.products.quantity') }}</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="quantity" name="quantity" autocomplete="off" readonly
                        value="{{{ old('quantity', isset($stock) ? $stock->quantity : null) }}}"> {!!
                    $errors->first('quantity', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->first('from_date', 'has-warning') !!}">
                <label for="from_date" readonly
                    class="col-sm-3 col-form-label">{{ trans('labels.products.from_date') }}</label>
                <div class="col-sm-3">


                    <input class="form-control" id="from_date" name="from_date" autocomplete="off"
                        value="{{{ old('from_date', isset($stock) ? $stock->format_from_date : null) }}}" readonly> {!!
                    $errors->first('from_date', '<span class="help-block">:message</span>') !!}

                    {!!
                    $errors->first('from_date', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->first('to_date', 'has-warning') !!}">
                <label for="to_date" class="col-sm-3 col-form-label">{{ trans('labels.products.to_date') }}</label>
                <div class="col-sm-3">
                    <input class="form-control" id="to_date" name="to_date" autocomplete="off" readonly="readonly"
                        value="{{{ old('to_date', isset($stock) ? $stock->format_to_date : null) }}}"> {!!
                    $errors->first('to_date', '<span class="help-block">:message</span>') !!}

                </div>
            </div>

            <button type="submit" class="btn btn-danger btn-md mb-4 float-right">
                <i class="fas fa-trash align-middle"></i> <span
                    class="align-middle"><strong>{{__('labels.general.buttons.delete')}}</strong></span>
            </button>
        </form>
    </div>
</div>
@endsection


@section('styles')
<link rel="stylesheet" href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" />
@parent
@stop
@section('scripts')
@parent

<script type="text/javascript" src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js">
</script>

<script type="text/javascript">
$(function() {
    $('#from_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });

    $('#to_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
});
</script>

@stop