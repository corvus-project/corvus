@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.management'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.products.management') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">

            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <table id="products" class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link rel='stylesheet' href='//cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css' type='text/css' media='all' />

@parent
@stop

@section('scripts')
@parent
<script src="//cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#products').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 50,
        ajax: "/portal/products/data",
        columns: [{
                name: 'id',
                data: 'id'
            },
            {
                name: 'sku',
                data: 'sku'
            },            
            {
                name: 'name',
                data: 'name'
            },    
            {
                name: 'stocks.quantity',
                data: 'quantity'
            },            
            {
                name: 'pricings.amount',
                data: 'amount'
            }
        ]
    });

         
    $('#products tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var template = "{{ route('portal.products.view', '000') }}"
        var redirect_url = template.replace('000', data.id);
        window.location.href = redirect_url
    } );
});
</script>
@stop