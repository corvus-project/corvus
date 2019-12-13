@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.pricing_management'))

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{  __('labels.products.pricing_management') }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">

                            <a href="{{ route('admin.products.create_pricing', $product->id) }}"
                                class="btn btn-success btn-sm m-1" data-toggle="tooltip" title="Create a pricing"><i
                                    class="fas fa-plus"></i></a>


                            <a href="{{ route('admin.products.view_pricing', $product->id) }}"
                                class="btn btn-success btn-sm m-1" data-toggle="tooltip"
                                title="List the pricing history"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>

                <form autocomplete="off" role="form"
                    action="{{ (isset($pricing)) ? route('admin.products.edit_pricing.update', [$pricing->product_id, $pricing->id]) : route('admin.products.create_pricing.store', $product->id) }}"
                    method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
 
                    <div class="form-group row {!! $errors->first('pricing_group_id', 'has-warning') !!}">
                        <label for="pricing_group_id" class="col-sm-3 col-form-label">{{ trans('labels.products.pricing_group') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('pricing_group_id', $pricing_groups, (isset($pricing) ? $pricing->pricing_group_id : null), ['class'=>'form-control col-sm-3']) }}
                            {!! $errors->first('pricing_group_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('quantity', 'has-warning') !!}">
                        <label for="quantity"
                            class="col-sm-3 col-form-label">{{ trans('labels.products.amount') }}</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="amount" name="amount" autocomplete="off"
                                value="{{{ old('amount', isset($pricing) ? $pricing->amount : null) }}}"> {!!
                            $errors->first('amount', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('from_date', 'has-warning') !!}">
                        <label for="from_date"
                            class="col-sm-3 col-form-label">{{ trans('labels.products.from_date') }}</label>
                        <div class="col-sm-3">


                            <input class="form-control" id="from_date" name="from_date" autocomplete="off"
                                value="{{{ old('from_date', isset($pricing) ? $pricing->from_date->format('Y-m-d') : null) }}}"> {!!
                            $errors->first('from_date', '<span class="help-block">:message</span>') !!}

                            {!!
                            $errors->first('from_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('to_date', 'has-warning') !!}">
                        <label for="to_date"
                            class="col-sm-3 col-form-label">{{ trans('labels.products.to_date') }}</label>
                        <div class="col-sm-3">
                            <input class="form-control" id="to_date" name="to_date" autocomplete="off"
                                value="{{{ old('to_date', isset($pricing) ? $pricing->to_date->format('Y-m-d') : null) }}}"> {!!
                            $errors->first('to_date', '<span class="help-block">:message</span>') !!}

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