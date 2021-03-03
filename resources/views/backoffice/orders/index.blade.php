@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.orders.all'))
@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.orders.all') }}
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
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Ref ID</th>
                            <th>Status</th>
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
    var table = $('#orders').DataTable({
        "order": [[ 1, "desc" ]],
        processing: true,
        responsive: true,
        serverSide: true,

        pageLength: 50,
        ajax: "orders/data",
        columns: [{
                name: 'order_headers.id',
                data: 'oid'
            },
            {
                name: 'order_date',
                data: 'order_date'
            },            
            {
                name: 'user_id',
                data: 'user_id'
            },  
            {
                name: 'ref_id',
                data: 'ref_id'
            },                       
            {
                name: 'status',
                data: 'status_name'
            }            
        ]
    });

    yadcf.init(table, [{
        column_number: 4,
        filter_type: "select",
        data: [{!!$status_json!!}],
    },{
        column_number: 2,
        filter_type: "select",
        data: [{!!$customer_json!!}],
    }]);
         
    $('#orders tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var template = "{{ route('backoffice.orders.view', '000') }}"
        var redirect_url = template.replace('000', data.oid);
        window.location.href = redirect_url
    } );
});
</script>
@stop