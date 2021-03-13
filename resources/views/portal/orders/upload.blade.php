@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.imports.management'))


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


        <div class="row">
            <div class="col">
                <h3>Upload your order</h3>
                <br/>
                <form autocomplete="off" role="form" action="{{ route('portal.orders.save_file')  }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group row {!! $errors->first('order_file', 'has-warning') !!}">
                        <label for="order_file" class="col-sm-3 col-form-label">Order file</label>
                        <div class="col-sm-9">

                            <input type="file" class="form-control" id="order_file" name="order_file" autocomplete="off">
                            {!!
                            $errors->first('order_file', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row {!! $errors->first('ref_id', 'has-warning') !!}">
                        <label for="ref_id" class="col-sm-3 col-form-label">Rereference Id</label>
                        <div class="col-sm-9">

                            <input type="text" class="form-control" id="ref_id" name="ref_id" autocomplete="off">
                            {!!
                            $errors->first('ref_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                        <i class="fas fa-upload align-middle"></i> <span class="align-middle"><strong>Upload</strong></span>
                    </button>
                </form>

                <p>
                            <b>Example:</b>
                            <code>
                                <i>sku, quantity</i>
                            </code>
                        </p>
            </div>
        </div>
    </div>
</div>

@endsection


@section('styles')

@parent
@stop
@section('scripts')
@parent



@stop
