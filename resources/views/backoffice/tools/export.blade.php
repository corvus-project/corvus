@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.exports.management'))


@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">

            </div>
            <!--col-->
        </div>
        <!--row-->

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Export Products</a>

                <a class="nav-item nav-link" id="nav-price-list-tab" data-toggle="tab" href="#nav-price-list" role="tab"
                    aria-controls="nav-price-list" aria-selected="true">Export Price List</a>

                <a class="nav-item nav-link" id="nav-stock-list-tab" data-toggle="tab" href="#nav-stock-list" role="tab"
                    aria-controls="nav-stock-list" aria-selected="true">Export Stock List</a>

                <a class="nav-item nav-link" id="nav-order-list-tab" data-toggle="tab" href="#nav-order-list" role="tab"
                    aria-controls="nav-order-list" aria-selected="true">Export Orders</a>


            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col">
                        <form autocomplete="off" role="form" action="{{ route('backoffice.tools.exports.product_list') }}"
                            method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />


                            <button type="submit" class="btn btn-primary btn-block mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.export')}}</strong></span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="nav-price-list" role="tabpanel" aria-labelledby="nav-price-list-tab">

                <div class="row">
                    <div class="col">
                        <form autocomplete="off" role="form" action="{{ route('backoffice.tools.exports.price_list') }}"
                            method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                            <div class="form-group row {!! $errors->first('pricing_group_id', 'has-warning') !!}">
                                <label for="pricing_group_id"
                                    class="col-sm-3 col-form-label">{{ trans('labels.products.pricing_group') }}</label>
                                <div class="col-sm-9">
                                    {{ Form::select('pricing_group_id', $pricing_groups, null, ['class'=>'form-control col-sm-3']) }}
                                    {!! $errors->first('pricing_group_id', '<span class="help-block">:message</span>')
                                    !!}
                                </div>
                            </div>

                            <div class="form-group row {!! $errors->first('pricing_group_id', 'has-warning') !!}">
                                <label for="pricing_group_id" class="col-sm-3 col-form-label">Date Availability</label>
                                <div class="col-sm-9">
                                    {{ Form::select('date_selection', ['current_date' => 'Current Date', 'last' => 'Historical Price List'], null, ['class'=>'form-control col-sm-3']) }}
                                    {!! $errors->first('pricing_group_id', '<span class="help-block">:message</span>')
                                    !!}
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.export')}}</strong></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-stock-list" role="tabpanel" aria-labelledby="nav-stock-list-tab">
                <div class="row">
                    <div class="col">
                        <form autocomplete="off" role="form" action="{{ route('backoffice.tools.exports.stock_list') }}"
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
                            <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.export')}}</strong></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="nav-order-list" role="tabpanel" aria-labelledby="nav-order-list-tab">
                <div class="row">
                    <div class="col">
                        <form autocomplete="off" role="form" action="{{ route('backoffice.tools.exports.order_list') }}"
                            method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                            <div class="form-group row {!! $errors->first('pricing_group_id', 'has-warning') !!}">
                                <label for="pricing_group_id" class="col-sm-3 col-form-label">Accounts</label>
                                <div class="col-sm-9">
                                    {{ Form::select('account_id', $accounts, null, ['class'=>'form-control col-sm-3']) }}
                                    {!! $errors->first('account_id', '<span class="help-block">:message</span>')
                                    !!}
                                </div>
                            </div>

                            <div class="form-group row {!! $errors->first('process_date', 'has-warning') !!}">
                                <label for="process_date" class="col-sm-3 col-form-label">Process Date</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="process_date" name="process_date" autocomplete="off"
                                        value=""> {!!
                                    $errors->first('process_date', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group row {!! $errors->first('order_date', 'has-warning') !!}">
                                <label for="order_date" class="col-sm-3 col-form-label">Order Date</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="order_date" name="order_date" autocomplete="off"
                                        value=""> {!!
                                    $errors->first('order_date', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.export')}}</strong></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
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
    $('#process_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });

    $('#order_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
});
</script>

@stop
