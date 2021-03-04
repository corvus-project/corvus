@extends('adminlte::page')

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
                            <th>#</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Warehouse</th>
                            <th>Stock Type</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel='stylesheet' href='//cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css' type='text/css' media='all' />

@parent
@stop

@section('js')
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
        ajax: "/backoffice/reports/warehouse/stock/data",

        columns: [
            {
                name: 'pid',
                data: 'pid'
            },
            {
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
            },
            {
                "className": 'options',
                "data": null,
                "searchable": false, 
                "render": function(data) {
                    var template = "{{ route('backoffice.products.view', '000') }}"
                    var redirect_url = template.replace('000', data.pid);
                    return `<a class="btn btn-sm btn-info float-right" href="${redirect_url}"><i class="fas fa-eye"></i></a>`;
                },
            }
        ]
    });

    yadcf.init(table, [{
        column_number: 3,
        filter_type: "select",
        data: [{!!$warehouses_json!!}],
    }, {
        column_number: 4,
        filter_type: "select",
        data: [{!!$stock_groups_json!!}],
    }]);

 
});
</script>
@stop