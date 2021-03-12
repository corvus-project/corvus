@extends('adminlte::page')

@section('title', config('corvus.app_name') . ' | ' . __('labels.categories.title'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.categories.title') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('backoffice.categories.create') }}" class="btn btn-success btn-xs m-1"
                        data-toggle="tooltip" title="Create a category"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!--col-->
        </div>

        @include('includes.partials.messages')
        <br />

        <table class="table table-light table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Category</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>

                        <a href="{{ route('backoffice.categories.products', $category->id) }}"
                            class="btn btn-primary btn-xs ml-1 float-right" title="List products"><i
                                class="nav-icon fas fa-list"></i></a>

                        <a href="{{ route('backoffice.categories.delete', $category->id) }}"
                            class="btn btn-danger btn-xs ml-1 float-right" title="Delete the category"><i
                                class="fas fa-trash"></i></a>
                        <a href="{{ route('backoffice.categories.edit', $category->id) }}"
                            class="btn btn-info btn-xs ml-1 float-right" title="Edit the category"><i
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
