@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.products.categories.all'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.products.categories.all') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('backoffice.products.view_categories', $product->id) }}"
                        class="btn btn-success btn-xs m-1" data-toggle="tooltip" title="List the categories"><i
                            class="fas fa-list"></i></a>
                            @if (Auth::user()->hasRoles(['administrator', 'inventory_staff']))
                    <a href="{{ route('backoffice.products.create_category', $product->id) }}"
                        class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Add Product to a Category"><i
                            class="fas fa-plus"></i></a>
@endif
                    <a href="{{ route('backoffice.products.view', $product->id) }}" class="btn btn-info btn-xs m-1"
                        data-toggle="tooltip" title="Back to product"><i class="fas fa-arrow-alt-circle-left"></i></a>

                </div>
            </div>
            <!--col-->
        </div>
        @include('includes.product_box')
        <br />


        @if($product->categories()->count() < 1) <div class="alert alert-warning" role="alert">
            There is no any categories to display!
    </div>
    @else


    <table class="table table-light table-bordered table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>Category Name</th>
                <th>Taxonomy ID</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->categories()->take(10)->get() as
            $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->taxonomy_id }}</td>
                <td>

                    <a href="{{ route('backoffice.products.delete_category', [$product->id, $category->id]) }}"
                        class="btn btn-danger btn-xs m-1 float-right" data-toggle="tooltip" title="Delete category"><i
                            class="fas fa-trash"></i></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

@section('scripts')
@parent

@stop