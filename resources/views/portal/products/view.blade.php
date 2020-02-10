@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <!--row-->
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-5"><b>SKU</b></div>
                    <div class="col-sm-7">{{ $product->sku }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><b>Name</b></div>
                    <div class="col-sm-7">{{ $product->name }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><b>Description</b></div>
                    <div class="col-sm-7">{{ $product->description }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-5"><b>Price</b></div>
                    <div class="col-sm-7">{{ $price->amount }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-5"><b>Stock Level</b></div>
                    <div class="col-sm-7">{{ $stock->quantity }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-5"><b>Warehouse</b></div>
                    <div class="col-sm-7">{{ $stock->warehouse_name }}</div>
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