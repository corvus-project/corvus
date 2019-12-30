@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.pricing_groups.title'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.pricing_groups.title') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('admin.pricing_groups.create') }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="Create a group"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!--col-->
        </div>


        <br />

        <table class="table table-light table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Group Name</th>
                    <th>Slug</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->slug }}</td>
                    <td>
                        <a href="{{ route('admin.pricing_groups.delete', $group->id) }}"
                            class="btn btn-danger btn-sm ml-1 float-right" title="Delete the group"><i
                                class="fas fa-trash"></i></a>
                        <a href="{{ route('admin.pricing_groups.edit', $group->id) }}"
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