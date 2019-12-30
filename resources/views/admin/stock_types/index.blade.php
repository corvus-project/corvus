@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.stock_types.title'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.stock_types.title') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('admin.stock_types.create') }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="Create a stock types"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!--col-->
        </div>


        <br />

        <table class="table table-light table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Stock Type Name</th>
                    <th>Slug</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($stock_types as $stock_type)
                <tr>
                    <td>{{ $stock_type->name }}</td>
                    <td>{{ $stock_type->slug }}</td>
                    <td>
                        <a href="{{ route('admin.stock_types.delete', $stock_type->id) }}"
                            class="btn btn-danger btn-sm ml-1 float-right" title="Delete the group"><i
                                class="fas fa-trash"></i></a>
                        <a href="{{ route('admin.stock_types.edit', $stock_type->id) }}"
                            class="btn btn-info btn-sm ml-1 float-right" title="Edit the group"><i
                                class="fas fa-pen"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

@section('scripts')
@parent

@stop