@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.reports.warehouses_stock_report'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.reports.warehouses_stock_report')  }}
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
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Warehouse</th>
                            <th>Stock Type</th>
                            <th>Quantity</th>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.4/jquery.dataTables.yadcf.js"></script>

<script>
$(document).ready(function() {
    var table = $('#products').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 50,
        ajax: "/admin/reports/warehouse/stock/data",

        columns: [{
                name: 'sku',
                data: 'product_sku'
            },
            {
                name: 'name',
                data: 'product_name'
            },
            {
                name: 'warehouse_id',
                data: 'warehouse_name'
            },
            {
                name: 'stock_group_id',
                data: 'stock_group_name'
            },
            {
                name: 'quantity',
                data: 'quantity'
            }

        ]
    });

    yadcf.init(table, [{
        column_number: 2,
        filter_type: "select",
        data: [{!!$warehouses_json!!}],
    }, {
        column_number: 3,
        filter_type: "select",
        data: [{!!$stock_groups_json!!}],
    }]);



    $('#products tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        var template = "{{ route('admin.products.view', '000') }}"
        var redirect_url = template.replace('000', data.pid);
        window.location.href = redirect_url
    });
});
</script>
@stop