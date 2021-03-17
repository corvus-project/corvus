@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.products.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <!--row-->
        @include('includes.product_box')
        <br />

        <div class="card card-navy card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pricing-tab" data-toggle="pill" href="#pricing" role="tab" aria-controls="pricing" aria-selected="true">Pricing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="stock-tab" data-toggle="pill" href="#stock" role="tab" aria-controls="stock" aria-selected="false">Inventory Stock </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="orders-tab" data-toggle="pill" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Order History</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="categories-tab" data-toggle="pill" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categories</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="tabContent">
                  <div class="tab-pane fade show active" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">

                  <div class="row">
            <div class="col-sm-6">
                <h4>Pricing</h4>
            </div>
            <div class="col-sm-6">
            @if (Auth::user()->hasRoles(['administrator', 'inventory_staff']))
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">

                    <a href="{{ route('backoffice.products.view_pricing', $product->id) }}"
                        class="btn btn-success btn-xs m-1" data-toggle="tooltip" title="List the Pricing History"><i
                            class="fas fa-list"></i></a>

                    <a href="{{ route('backoffice.products.create_pricing', $product->id) }}"
                        class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Create a stock"><i
                            class="fas fa-plus"></i></a>

                </div>
                @endif
            </div>
        </div>

 @if(count($cur_pricelist) < 1)
<div class="alert alert-warning" role="alert">
    The product does not have a price for today!
</div>
 @else
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Price Group</th>
                    <th scope="col">price</th>
                    <th scope="col">Dates</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cur_pricelist as
                $pricing)
                <tr>
                    <td>{{ $pricing->pricing_group->name }}</td>
                    <td>{{ Corvus\Core\Helpers\Currency::format($pricing->price) }}</td>
                    <td>{{ $pricing->from_to }}</td>
                    <td>@if (Auth::user()->hasRoles(['administrator', 'inventory_staff']))
                        <a href="{{ route('backoffice.products.edit_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-info btn-xs ml-1 float-right" data-toggle="tooltip" title="Update pricing"><i
                                class="fas fa-pen"></i></a>
                            @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endif
                  </div>
                  <div class="tab-pane fade" id="stock" role="tabpanel" aria-labelledby="stock-tab">

                  <div class="row">
            <div class="col-sm-6">
                <h4>Stock Groups</h4>
            </div>
            <div class="col-sm-6">
            @if (Auth::user()->hasRoles(['administrator', 'inventory_staff']))
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">

                    <a href="{{ route('backoffice.products.view_stocks', $product->id) }}" class="btn btn-success btn-xs m-1"
                        data-toggle="tooltip" title="List the Stock History"><i class="fas fa-list"></i></a>

                    <a href="{{ route('backoffice.products.create_stock', $product->id) }}"
                        class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Create a stock"><i
                            class="fas fa-plus"></i></a>

                </div>@endif
            </div>
        </div>
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Stock Type</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->stocks()->with('stock_group')->take(10)->orderBy('created_at', 'DESC')->get() as
                $stock)
                <tr>
                    <td>{{ $stock->stock_group->name }}</td>
                    <td>{{ $stock->warehouse->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>            @if (Auth::user()->hasRoles(['administrator', 'inventory_staff']))
                        <a href="{{ route('backoffice.products.edit_stock', [$product->id, $stock->id]) }}"
                            class="btn btn-info btn-xs ml-1 float-right" data-toggle="tooltip" title="Update stock"><i
                                class="fas fa-pen"></i></a>

                        <a href="{{ route('backoffice.products.delete_stock', [$product->id, $stock->id]) }}"
                            class="btn btn-danger btn-xs ml-1 float-right" data-toggle="tooltip" title="Delete stock"><i
                                class="fas fa-trash"></i></a>
@endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

                  </div>
                  <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">

                  <div class="row">
            <div class="col-sm-6">
                <h4>Stock Order History</h4>
            </div>
            <div class="col-sm-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">

                    <a href="{{ route('backoffice.products.view_history', $product->id) }}" class="btn btn-success btn-xs m-1"
                        data-toggle="tooltip" title="List the Stock History"><i class="fas fa-list"></i></a>


                </div>
            </div>
        </div>
        @if(count($orderlines)>0)
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">OrderID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">SKU</th>
                    <th scope="col">price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderlines as $h)
                <tr>
                    <td>{{ $h->order_id }}</td>
                    <td>{{ $h->product_name }}</td>
                    <td>{{ $h->warehouse_name }}</td>
                    <td>{{ $h->product_sku }}</td>
                    <td>{{ $h->price }}</td>
                    <td>{{ $h->quantity }}</td>
                    <td>{{ $h->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-warning" role="alert">
            There is no any orders to display!
    </div>
        @endif
                  </div>
                  <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">

                  <div class="row">
            <div class="col-sm-6">
                <h4>Categories</h4>
            </div>
            <div class="col-sm-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('backoffice.products.view_categories', $product->id) }}"
                        class="btn btn-success btn-xs ml-1" data-toggle="tooltip" title="List the Categories"><i
                            class="fas fa-list"></i></a>
                            @if (Auth::user()->hasRoles(['administrator', 'inventory_staff']))

                    <a href="{{ route('backoffice.products.create_category', $product->id) }}"
                        class="btn btn-primary btn-xs ml-1" data-toggle="tooltip" title="Add Product to a Category"><i
                            class="fas fa-plus"></i></a>
                            @endif
                </div>
            </div>
        </div>

        @if($product->categories()->count() < 1) <div class="alert alert-warning" role="alert">
            There is no any categories to display!
    </div>
    @else
    <table class="table table-light table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Category Name</th>
                <th scope="col">Taxonomy ID</th>
                <th scope="col"></th>
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
                        class="btn btn-danger btn-xs ml-1 float-right" data-toggle="tooltip" title="Delete category"><i
                            class="fas fa-trash"></i></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>



        <br />


        <br />
        <br />
</div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
