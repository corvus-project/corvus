@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.orders.view'))

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
            <div class="col-sm-5"><b>Customer</b></div>
            <div class="col-sm-7">{{ $order->account->name }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Date</b></div>
            <div class="col-sm-7">{{ $order->order_date->format('d M Y H:i') }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Status</b></div>
            <div class="col-sm-7">{{ $order->order_status->name }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Ref ID</b></div>
            <div class="col-sm-7">{{ $order->ref_id }}</div>
        </div>

        <br />

        <div class="row">
            <div class="col-12"> 
             
            @if(in_array($order->status, $allowed_status))
                <a class="btn btn-primary m-2 float-right" href="{{ route('admin.orders.update', $order->id) }}">
                    <i class="fas fa-sync-alt align-middle"></i> <span class="align-middle">
                        Process Order</span></a>
            @endif
 
            @if($order->status_slug === 'APPROVED')
                <a class="btn btn-info m-2 float-right" href="{{ route('admin.orders.update', $order->id) }}">
                    <i class="fas fa-sync-alt align-middle"></i> <span class="align-middle">
                    Pack the products </span></a>
            @endif            

            @if($order->status_slug === 'PACKED')
                <a class="btn btn-primary m-2 float-right" href="{{ route('admin.orders.update', $order->id) }}">
                    <i class="fas fa-sync-alt align-middle"></i> <span class="align-middle">
                        Ready to ship</span></a>
            @endif  

            @if($order->status_slug === 'READY_TO_SHIP')
                <a class="btn btn-primary m-2 float-right" href="{{ route('admin.orders.update', $order->id) }}">
                    <i class="fas fa-sync-alt align-middle"></i> <span class="align-middle">
                    Shipped</span></a>
            @endif              

            @if($order->status_slug === 'SHIPPED')
                <a class="btn btn-primary m-2 float-right" href="{{ route('admin.orders.update', $order->id) }}">
                    <i class="fas fa-sync-alt align-middle"></i> <span class="align-middle">
                    Completed</span></a>
            @endif              
 

            </div>
        </div>
        <table class="table table-light table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Product Name</th>
                    <th>Product SKU</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Updated</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($orderlines as $orderline)
                <tr>
                    <td>{{ $orderline->product_name }}</td>
                    <td>{{ $orderline->product_sku }}</td>
                    <td>{{ $orderline->amount }}</td>
                    <td>{{ $orderline->quantity }}</td>
                    <td>{{ $orderline->status_value }}</td>
                    <td>{{ $orderline->updated_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop