@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.users.index'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Users
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    @include('includes.user_submenu')
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <table id="users" class="table row-border hover" style="width: 100%">
                    <thead>
                        <tr>
                           
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->roles()->first()->display_name}}</td>
                    <td><a href="{{ route('backoffice.users.edit', $user->id) }}" class="float-right btn btn-info btn-xs m-1"><i class="fas fa-pen"></i></a></td>
                </tr>
                @endforeach
                </tbody>
                </table>
                {{ $users->render() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
@stop
