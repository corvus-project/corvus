@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <!--row-->
        @include('includes.product_box')
        <br />
 


        <br />
        <div class="row">
            <div class="col-sm-6">
                <h4>Stock Order History</h4>
            </div>
            <div class="col-sm-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
 
                </div>
            </div>
        </div>
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">OrderID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderlines as $h)
                <tr>
                    <td>{{ $h->order_id }}</td>
                    <td>{{ $h->product_name }}</td>
                    <td>{{ $h->warehouse_name }}</td>
                    <td>{{ $h->product_sku }}</td>
                    <td>{{ $h->amount }}</td>
                    <td>{{ $h->quantity }}</td>
                    <td>{{ $h->created_at }}</td>
                    <td>{{ $order_status_list[$h->order->status] }}</td>
                    <td><a href="{{ route('admin.orders.view', $h->order_id) }}" class="btn btn-sm btn-primary">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
  {{ $orderlines->links() }}
</div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop