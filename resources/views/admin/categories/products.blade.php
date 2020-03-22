@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.categories.products', ['name' => $category->name]))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                {{  __('labels.products.categories.products', ['name' => $category->name]) }}
                </h4>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <table id="products" class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Name</th>
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
        ajax: "/admin/categories/{{$category->id}}/data",
        columns: [
            {
                name: 'sku',
                data: 'product_sku'
            },            
            {
                name: 'name',
                data: 'product_name'
            }
        ]
    });

         
    $('#products tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var template = "{{ route('admin.categories.products.data', '000') }}"
        var redirect_url = template.replace('000', data.pid);
        window.location.href = redirect_url
    } );
});
</script>
@stop