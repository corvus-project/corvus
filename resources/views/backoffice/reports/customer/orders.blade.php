@extends('adminlte::page')

@section('title', app_name() . ' | ' .  __('labels.reports.customer_order_report') )

@section('content')
<div class="card mt-2">
    <div class="card-body"> 
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.reports.customer_order_report')  }}
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
                <table id="orders" class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                 
                            <th>ID</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Processed Date</th>
                            <th>Status</th>
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
    var table = $('#orders').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 50,
        ajax: "/backoffice/reports/customer/order/data",

        columns: [{
                name: 'order_header_id',
                data: 'order_header_id'
            },
            {
                name: 'order_date',
                data: 'order_date'
            },
            {
                name: 'user_id',
                data: 'customer_name'
            },            
            {
                name: 'processed_date',
                data: 'processed_date'
            },
            {
                name: 'status',
                data: 'order_status_name'
            },
            {
                "className": 'options',
                "data": null,
                "searchable": false, 
                "render": function(data) {
                    var template = "{{ route('backoffice.orders.view', '000') }}"
                    var redirect_url = template.replace('000', data.order_header_id);
                    return `<a class="btn btn-sm btn-info float-right" href="${redirect_url}"><i class="fas fa-eye"></i></a>`;
                }
            }
        ]
    });

    yadcf.init(table, [{
            column_number: 2,
            filter_type: "select",
            data: [{!!$customers_json!!}],
        },
        {
            column_number: 4,
            filter_type: "select",
            data: [{!! $status_json !!}]
        }
    ]);



    $('#products tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        var template = "{{ route('backoffice.orders.view', '000') }}"
        var redirect_url = template.replace('000', data.order_header_id);
        window.location.href = redirect_url
    });
});
</script>
@stop