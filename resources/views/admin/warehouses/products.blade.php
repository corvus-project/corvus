@extends('layouts.backend')

@section('title', app_name() . ' | ' . 'Warehouse Products: '. $warehouse->name )

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Warehouse Products: {{ $warehouse->name }}
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
                            <th>PID</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Stock Type</th>
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
        ajax: "/admin/warehouses/{{$warehouse->id}}/products/data",
        columns: [{
                name: 'pid',
                data: 'pid'
            },
            {
                name: 'sku',
                data: 'product_sku'
            },            
            {
                name: 'product_name',
                data: 'product_name'
            },            
            {
                name: 'quantity',
                data: 'quantity'
            },            
            {
                name: 'stock_type_name',
                data: 'stock_type_name'
            }
        ]
    });

         
    $('#products tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var template = "{{ route('admin.products.view', '000') }}"
        var redirect_url = template.replace('000', data.pid);
        window.location.href = redirect_url
    } );
});
</script>
@stop