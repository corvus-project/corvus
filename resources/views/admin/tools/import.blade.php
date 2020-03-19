@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.imports.management'))


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
                    aria-controls="nav-home" aria-selected="true">Import Products</a>

                <a class="nav-item nav-link" id="nav-price-list-tab" data-toggle="tab" href="#nav-price-list" role="tab"
                    aria-controls="nav-price-list" aria-selected="true">Import Price List</a>

                <a class="nav-item nav-link" id="nav-stock-list-tab" data-toggle="tab" href="#nav-stock-list" role="tab"
                    aria-controls="nav-stock-list" aria-selected="true">Import Stock List</a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col">
                        <h3>Import Product List</h3>
                        <form autocomplete="off" role="form" action="{{ route('admin.tools.import.csv_file')  }}"
                            method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" name="model" value="product" />

                            <div class="form-group row {!! $errors->first('csv_file', 'has-warning') !!}">
                                <label for="csv_file" class="col-sm-3 col-form-label">CSV file to import</label>
                                <div class="col-sm-9">

                                    <input type="file" class="form-control" id="csv_file" name="csv_file"
                                        autocomplete="off">
                                    {!!
                                    $errors->first('csv_file', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.import')}}</strong></span>
                            </button>
                        </form>
                        <p>
                            <b>Example:</b>
                            <code>
                                <i>sku, name, description</i>
                            </code>
                        </p>                          
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-price-list" role="tabpanel" aria-labelledby="nav-price-list">
                <div class="row">
                    <div class="col">

                        <h3>Import Price List</h3>
                        <form autocomplete="off" role="form" action="{{ route('admin.tools.import.csv_file')  }}"
                            method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" name="model" value="pricelist" />

                            <div class="form-group row {!! $errors->first('csv_file', 'has-warning') !!}">
                                <label for="csv_file" class="col-sm-3 col-form-label">CSV file to import</label>
                                <div class="col-sm-9">

                                    <input type="file" class="form-control" id="csv_file" name="csv_file"
                                        autocomplete="off">
                                    {!!
                                    $errors->first('csv_file', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group row {!! $errors->first('pricing_group_id', 'has-warning') !!}">
                                <label for="pricing_group_id"
                                    class="col-sm-3 col-form-label">{{ trans('labels.products.pricing_group') }}</label>
                                <div class="col-sm-9">
                                    {{ Form::select('pricing_group_id', $pricing_groups, null, ['class'=>'form-control col-sm-3']) }}
                                    {!! $errors->first('pricing_group_id', '<span class="help-block">:message</span>')
                                    !!}
                                </div>
                            </div>

                            <div class="form-group row {!! $errors->first('to_date', 'has-warning') !!}">
                                <label for="to_date"
                                    class="col-sm-3 col-form-label">{{ trans('labels.products.to_date') }}</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="to_date" name="to_date" autocomplete="off"
                                        value="{{{ old('to_date', isset($pricing) ? $pricing->format_to_date : null) }}}">
                                    {!!
                                    $errors->first('to_date', '<span class="help-block">:message</span>') !!}

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.import')}}</strong></span>
                            </button>
                        </form>

                        <p>
                            <b>Example:</b>
                            <code>
                                <i>sku, amount</i>
                            </code>
                        </p>                        
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-stock-list" role="tabpanel" aria-labelledby="nav-stock-list">
                <div class="row">
                    <div class="col">

                        <h3>Import Stock List</h3>
                        <form autocomplete="off" role="form" action="{{ route('admin.tools.import.csv_file')  }}"
                            method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" name="model" value="stocklist" />

                            <div class="form-group row {!! $errors->first('csv_file', 'has-warning') !!}">
                                <label for="csv_file" class="col-sm-3 col-form-label">CSV file to import</label>
                                <div class="col-sm-9">

                                    <input type="file" class="form-control" id="csv_file" name="csv_file"
                                        autocomplete="off">
                                    {!!
                                    $errors->first('csv_file', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                                <i class="fas fa-file-export align-middle"></i> <span
                                    class="align-middle"><strong>{{__('labels.general.buttons.import')}}</strong></span>
                            </button>
                        </form>

                        <p>
                            <b>Example:</b>
                            <code>
                                <i>sku, quantity, warehouse_code, stock_type_code</i>
                            </code>
                        </p>
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
    $('#to_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
});
</script>

@stop