@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.products.stock_management'))


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{  __('labels.products.stock_management') }}
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-sm-7">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                            <a href="{{ route('backoffice.products.view_stocks', $product->id) }}"
                                class="btn btn-success btn-xs m-1" data-toggle="tooltip"
                                title="List the stock history"><i class="fas fa-list"></i></a>

                            <a href="{{ route('backoffice.products.create_stock', $product->id) }}"
                                class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Create a stock"><i
                                    class="fas fa-plus"></i></a>

                            <a href="{{ route('backoffice.products.view', $product->id) }}" class="btn btn-info btn-xs m-1"
                                data-toggle="tooltip" title="Back to product"><i
                                    class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                    </div>
                </div>
                @include('includes.product_box') 
                <br />

                <form autocomplete="off" role="form"
                    action="{{ (isset($stock)) ? route('backoffice.products.edit_stock.update', [$stock->product_id, $stock->id]) : route('backoffice.products.create_stock.store', $product->id) }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group row {!! $errors->first('warehouse_id', 'has-warning') !!}">
                        <label for="warehouse_id"
                            class="col-sm-3 col-form-label">{{ trans('labels.products.warehouse') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('warehouse_id', $warehouses, (isset($stock) ? $stock->warehouse_id : null), ['class'=>'form-control col-sm-3']) }}
                            {!! $errors->first('warehouse_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('name', 'has-warning') !!}">
                        <label for="name" class="col-sm-3 col-form-label">Stock Type</label>
                        <div class="col-sm-9">
                            {{ Form::select('stock_group_id', $stock_groups, (isset($stock) ? $stock->stock_group_id : null), ['class'=>'form-control col-sm-3']) }}
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('quantity', 'has-warning') !!}">
                        <label for="quantity"
                            class="col-sm-3 col-form-label">{{ trans('labels.products.quantity') }}</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="quantity" name="quantity" autocomplete="off"
                                value="{{{ old('quantity', isset($stock) ? $stock->quantity : null) }}}"> {!!
                            $errors->first('quantity', '<span class="help-block">:message</span>') !!}
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

 
 