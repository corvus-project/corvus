@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.products.stock_history'))

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
                    <a href="{{ route('backoffice.products.view_stocks', $product->id) }}" class="btn btn-success btn-xs m-1"
                        data-toggle="tooltip" title="List the stock history"><i class="fas fa-list"></i></a>

                    <a href="{{ route('backoffice.products.create_stock', $product->id) }}"
                        class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Create a stock"><i
                            class="fas fa-plus"></i></a>

                    <a href="{{ route('backoffice.products.view', $product->id) }}" class="btn btn-info btn-xs m-1"
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

        <table class="table table-light table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Stock Type</th>
                    <th>Warehouse</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->stock_group->name }}</td>
                    <td>{{ $stock->warehouse->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>
                        <a href="{{ route('backoffice.products.edit_stock', [$product->id, $stock->id]) }}"
                            class="btn btn-info btn-xs m-1 float-right" data-toggle="tooltip" title="Update stock"><i
                                class="fas fa-pen"></i></a>

                        <a href="{{ route('backoffice.products.delete_stock', [$product->id, $stock->id]) }}"
                            class="btn btn-danger btn-xs m-1 float-right" data-toggle="tooltip" title="Delete stock"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $stocks->render() }}
    </div>
</div>
@endsection

@section('scripts')
@parent

@stop
