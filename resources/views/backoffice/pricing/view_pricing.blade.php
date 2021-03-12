@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.products.pricing_history'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.products.pricing_history') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">

                    <a href="{{ route('backoffice.products.view_pricing', $product->id) }}"
                        class="btn btn-success btn-xs m-1" data-toggle="tooltip" title="List the pricing history"><i
                            class="fas fa-list"></i></a>


                    <a href="{{ route('backoffice.products.create_pricing', $product->id) }}"
                        class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Create a stock"><i
                            class="fas fa-plus"></i></a>

                    <a href="{{ route('backoffice.products.view', $product->id) }}" class="btn btn-info btn-xs m-1"
                        data-toggle="tooltip" title="Back to product"><i class="fas fa-arrow-alt-circle-left"></i></a>

                </div>
            </div>
            <!--col-->
        </div>
        @include('includes.product_box')
        <br />
        <div class="row">
            <div class="col-sm-6">
                <h4>Current Pricing </h4>
            </div>
            <div class="col-sm-6">

            </div>
        </div>

        <table class="table table-light table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Pricing Group</th>
                    <th>price</th>
                    <th>Dates</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($current_price_list as $pricing)
                <tr>
                    <td>{{ $pricing->pricing_group->name }}</td>
                    <td>{{ Corvus\Core\Helpers\Currency::format($pricing->price) }}</td>
                    <td>{{ $pricing->from_to }}</td>
                    <td>
                        <a href="{{ route('backoffice.products.edit_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-info btn-xs m-1 float-right" data-toggle="tooltip" title="Update pricing"><i
                                class="fas fa-pen"></i></a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <br />

        <div class="row">
            <div class="col-sm-6">
                <h4> Planned Pricing </h4>
            </div>
            <div class="col-sm-6">

            </div>
        </div>

        <table class="table table-light table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Pricing Group</th>
                    <th>price</th>
                    <th>Dates</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($future_price_list as $pricing)
                <tr>
                    <td>{{ $pricing->pricing_group->name }}</td>
                    <td>{{ Corvus\Core\Helpers\Currency::format($pricing->price) }}</td>
                    <td>{{ $pricing->from_to }}</td>
                    <td>
                    <a href="{{ route('backoffice.products.edit_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-info btn-xs m-1 float-right" data-toggle="tooltip" title="Update pricing"><i
                                class="fas fa-pen"></i></a>

                        <a href="{{ route('backoffice.products.delete_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-danger btn-xs m-1 float-right" data-toggle="tooltip"
                            title="Delete pricing"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <br />

        <div class="row">
            <div class="col-sm-6">
                <h4> Pricing History </h4>
            </div>
            <div class="col-sm-6">

            </div>
        </div>

        <table class="table table-light table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Pricing Group</th>
                    <th>price</th>
                    <th>Dates</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($history_price_list as $pricing)
                <tr>
                    <td>{{ $pricing->pricing_group->name }}</td>
                    <td>{{ Corvus\Core\Helpers\Currency::format($pricing->price) }}</td>
                    <td>{{ $pricing->from_to }}</td>
                    <td>


                        <a href="{{ route('backoffice.products.delete_pricing', [$product->id, $pricing->id]) }}"
                            class="btn btn-danger btn-xs m-1 float-right" data-toggle="tooltip"
                            title="Delete pricing"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $history_price_list->render() }}
    </div>
</div>
@endsection

@section('scripts')
@parent

@stop
