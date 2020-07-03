@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <!--row-->
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">

                            <a href="{{ route('portal.cart.add', $product->id) }}" class="btn btn-warning btn-md m-1"
                                data-toggle="tooltip" title="Add to Cart"><i class="fas fa-cart-plus"></i></a>

                        </div>

                    </div>
                </div>


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
                    <div class="col-sm-7  p-2">
                        {{ (!empty($price)) ? $price->amount . ' (The price is available between ' . $price->from_date .' ~ '. $price->to_date .')' : 'No Price defined' }}
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Stock Level</b></div>
                    <div class="col-sm-7  p-2">{{ (!empty($stock)) ? $stock->quantity : 'Stock not defined'}}</div>
                </div>

                <div class="row border-bottom">
                    <div class="col-sm-5 bg-light p-2"><b>Warehouse</b></div>
                    <div class="col-sm-7  p-2">{{  (!empty($stock)) ? $stock->warehouse_name : 'No Warehouse defined'}}
                    </div>
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