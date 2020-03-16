@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('customer::labels.accounts.portal'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Accounts
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    @include('includes.account_submenu')
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <table id="accounts" class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Number</th>
                            <th>Account Group</th>
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
    var table = $('#accounts').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 50,
        ajax: "/admin/accounts/data",
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
            {
                name: 'account_number',
                data: 'account_number'
            },
            {
                name: 'account_group',
                data: 'account_group'
            }
        ]
    });


    $('#accounts tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        var template = "{{ route('admin.accounts.view', '000') }}"
        var redirect_url = template.replace('000', data.id);
        window.location.href = redirect_url
    });
});
</script>
@stop