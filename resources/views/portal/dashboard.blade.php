@extends('layouts.backend')

@section('title', app_name() )


@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Lastest Products List<h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th style="width: 25%">#ID</th>
                                    <th style="width: 55%">Name</th>
                                    <th style="width: 20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><a class="btn btn-sm btn-primary btn-flat m-b-10 m-l-5"
                                            href="{{ route('portal.products.view', $product->id) }}">
                                            <i class="fas fa-eye"></i>
                                            View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Lastest Orders<h4>
                </div>
                <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead class="thead-header">
                        <tr>
                            <th style="width:10%">#</th>
                            <th style="width:45%">Customer</th>
                            <th style="width:15%">Status</th>
                            <th style="width:15%">Order At</th>
                            <th style="width:15%"></th>

                        </tr>
                    </thead>
                    <tbody>
                    @if($orders->count() < 1) <div class="alert alert-warning" role="alert">
                        There is no any orderes to display!
                </div>
                @endif
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->status_name }}</td>
                            <td>{{ Carbon\Carbon::parse($order->order_date)->format('d M Y H:i') }}</td>
                            <td><a class="btn btn-sm btn-primary"
                                    href="{{ route('portal.orders.view', $order->order_id) }}">
                                    <i class="fas fa-eye"></i>
                                    View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection