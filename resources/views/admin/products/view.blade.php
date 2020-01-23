@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.products.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">

            </div>
            <!--col-->
        </div>
        <!--row-->


        <div class="row">
            <div class="col-sm-5"><b>SKU</b></div>
            <div class="col-sm-7">{{ $product->sku }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Name</b></div>
            <div class="col-sm-7">{{ $product->name }}</div>
        </div>
        <div class="row">
            <div class="col-sm-5"><b>Description</b></div>
            <div class="col-sm-7">{{ $product->description }}</div>
        </div>
        <br />

        <div class="row">
            <div class="col-sm-6">
                <h4>Pricing History</h4>
            </div>
            <div class="col-sm-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.products.view_pricing', $product->id) }}"
                        class="btn btn-success btn-sm m-1" data-toggle="tooltip" title="List the Pricing History"><i
                            class="fas fa-list"></i></a>
                </div>
            </div>
        </div>
        <table class="table table-light table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Price Group</th>
                    <th>Amount</th>
                    <th>Dates</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->pricing()->with('pricing_group')->take(10)->orderBy('created_at', 'DESC')->get() as
                $pricing)
                <tr>
                    <td>{{ $pricing->pricing_group->name }}</td>
                    <td>{{ $pricing->amount }}</td>
                    <td>{{ $pricing->from_to }}</td>
                    <td>
                    <a href="{{ route('admin.products.edit_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-info btn-sm m-1 float-right" data-toggle="tooltip" title="Update pricing"><i
                                class="fas fa-pen"></i></a>

                        <a href="{{ route('admin.products.delete_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-danger btn-sm m-1 float-right" data-toggle="tooltip"
                            title="Delete pricing"><i class="fas fa-trash"></i></a>                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <br />
        <div class="row">
            <div class="col-sm-6">
                <h4>Stock History</h4>
            </div>
            <div class="col-sm-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.products.view_stocks', $product->id) }}"
                        class="btn btn-success btn-sm m-1" data-toggle="tooltip" title="List the Stock History"><i
                            class="fas fa-list"></i></a>
                </div>
            </div>
        </div>        
        <table class="table table-light table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Stock Type</th>
                    <th>Warehouse</th>                    
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->stocks()->with('stock_type')->take(10)->orderBy('created_at', 'DESC')->get() as
                $stock)
                <tr>
                    <td>{{ $stock->stock_type->name }}</td>
                    <td>{{ $stock->warehouse->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>
                    <a href="{{ route('admin.products.edit_stock', [$product->id, $stock->id]) }}" class="btn btn-info btn-sm m-1 float-right"
                        data-toggle="tooltip" title="Update stock"><i class="fas fa-pen"></i></a>
                    
                        <a href="{{ route('admin.products.delete_stock', [$product->id, $stock->id]) }}" class="btn btn-danger btn-sm m-1 float-right"
                        data-toggle="tooltip" title="Delete stock"><i class="fas fa-trash"></i></a>
                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <br />
        <div class="row">
            <div class="col-sm-6">
                <h4>Categories</h4>
            </div>
            <div class="col-sm-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.products.view_categories', $product->id) }}"
                        class="btn btn-success btn-sm m-1" data-toggle="tooltip" title="List the Categories"><i
                            class="fas fa-list"></i></a>
                </div>
            </div>
        </div>        
        <table class="table table-light table-hover">
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
                        <a href="{{ route('admin.products.delete_category', [$product->id, $category->id]) }}" class="btn btn-danger btn-sm m-1 float-right"
                        data-toggle="tooltip" title="Delete category"><i class="fas fa-trash"></i></a>
                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop