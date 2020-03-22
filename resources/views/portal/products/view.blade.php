@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <!--row-->
        <div class="card">
            <div class="card-body">

                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>SKU</b></div>
                    <div class="col-sm-7  p-2">{{ $product->sku }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Name</b></div>
                    <div class="col-sm-7  p-2">{{ $product->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Description</b></div>
                    <div class="col-sm-7  p-2">{{ $product->description }}</div>
                </div>

                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Price</b></div>
                    <div class="col-sm-7  p-2">{{ (!empty($price)) ? $price->amount : 'No Price defined' }}</div>
                </div>

                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Stock Level</b></div>
                    <div class="col-sm-7  p-2">{{ (!empty($stock)) ? $stock->quantity : 'Stock not defined'}}</div>
                </div>

                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Warehouse</b></div>
                    <div class="col-sm-7  p-2">{{  (!empty($stock)) ? $stock->warehouse_name : 'No Warehouse defined'}}</div>
                </div>                
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