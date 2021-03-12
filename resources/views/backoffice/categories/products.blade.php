@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.products.categories.products', ['name' => $category->name]))

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
                            <th>#</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th></th>
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

@section('js')
@parent
<script src="//cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#products').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 50,
        ajax: "/backoffice/categories/{{$category->id}}/data",
        columns: [
            {
              name: 'products.id',
              data: 'products.id'
            },
            {
                name: 'products.sku',
                data: 'products.sku'
            },
            {
                name: 'products.name',
                data: 'products.name'
            },
            {
                "className": 'options',
                "data": null,
                "searchable": false,
                "render": function(data) {
                    var template = "{{ route('backoffice.products.view', '000') }}"
                    var redirect_url = template.replace('000', data.products.id);
                    return `<a class="btn btn-sm btn-info float-right" href="${redirect_url}"><i class="fas fa-eye"></i></a>`;
                },
            }
        ]
    });


});
</script>
@stop
