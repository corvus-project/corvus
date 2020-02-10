@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.warehouses.title'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.warehouses.title') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('admin.warehouses.create') }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="Create a category"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!--col-->
        </div>


        <br />

        <table class="table table-light table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Warehouses</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->name }}</td>
                    <td>
                        <a href="{{ route('admin.warehouses.delete', $warehouse->id) }}"
                            class="btn btn-danger btn-sm ml-1 float-right" title="Delete the warehouse"><i
                                class="fas fa-trash"></i></a>
                        <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}"
                            class="btn btn-info btn-sm ml-1 float-right" title="Edit the warehouse"><i
                                class="fas fa-pen"></i></a>
                        <a href="{{ route('admin.warehouses.products', $warehouse->id) }}"
                            class="btn btn-primary btn-sm ml-1 float-right" title="List products in the warehouse"><i
                                class="fas fa-list"></i></a>

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