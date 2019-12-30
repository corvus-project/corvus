@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('customer::labels.customers.portal'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('customer::labels.customers.management') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="List the Customers"><i class="fas fa-list"></i></a>

                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm m-1"
                        data-toggle="tooltip" title="New Customer"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <table id="customers" class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
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
    var table = $('#customers').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 50,
        ajax: "/admin/customers/data",
        columns: [{
                name: 'id',
                data: 'id'
            },
            {
                name: 'name',
                data: 'name'
            },
            {
                name: 'email',
                data: 'email'
            },
        ]
    });


    $('#customers tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        var template = "{{ route('admin.customers.view', '000') }}"
        var redirect_url = template.replace('000', data.id);
        window.location.href = redirect_url
    });
});
</script>
@stop