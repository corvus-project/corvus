@extends('layouts.backend')

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
                <table id="products" class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Processed Date</th>
                            <th>Status</th>
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
        ajax: "/admin/reports/customer/order/data",

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
                name: 'order_amount',
                data: 'order_amount'
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
        var template = "{{ route('admin.orders.view', '000') }}"
        var redirect_url = template.replace('000', data.order_header_id);
        window.location.href = redirect_url
    });
});
</script>
@stop