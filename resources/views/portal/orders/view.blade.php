@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('Order View'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">

                @if(in_array($order->order_status->slug, ['NEW_ORDER', 'PROCESSING']))
                <form autocomplete="off" role="form" action="{{ route('portal.orders.cancel', $order->id) }}" method="post"
                    id="cancel_form">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <button class="float-right delete btn btn-md btn-danger" id="{{$order->id}}"><i class="fas fa-trash"></i> Cancel</button>
                </form>
                @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
$(document).ready(function() {

    $('#cancel_form').on('submit', function(e) {
        var currentForm = this;
        e.preventDefault();

        bootbox.confirm({
            message: "This will cancel your order.",
            buttons: {
                confirm: {
                    label: 'Cancel order',
                    className: 'btn-warning'
                },
                cancel: {
                    label: 'Keep my order',
                    className: 'btn-success'
                }
            },
            callback: function(result) {
                if (result) {
                    currentForm.submit();
                }
            }
        });
    });
});
</script>
@stop