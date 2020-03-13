@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('customer::labels.accounts.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.accounts.index') }}" class="btn btn-success btn-sm m-1"
                        data-toggle="tooltip" title="List the accounts"><i class="fas fa-list"></i></a>

                    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm m-1"
                        data-toggle="tooltip" title="New Account"><i class="fas fa-plus"></i></a>

                    <a href="{{ route('admin.accounts.edit', $user->id) }}" class="btn btn-info btn-sm m-1"
                        data-toggle="tooltip" title="Edit the Account"><i class="fas fa-pen"></i></a>



                        <a href="{{ route('admin.accounts.orders', $user->id) }}" class="btn btn-info btn-sm m-1"
                        data-toggle="tooltip" title="Orders"><i class="fas fas fa-wallet"></i></a>


                </div>
            </div>
            <!--col-->
        </div>
        <!--row--> 
        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>ID</b></div>
            <div class="col-sm-9 p-2">{{ $user->id }}</div>
        </div>

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Name</b></div>
            <div class="col-sm-9 p-2">{{ $user->name }}</div>
        </div>

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Account Number</b></div>
            <div class="col-sm-9 p-2">{{ $user->account_number }}</div>
        </div>

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Account Group</b></div>
            <div class="col-sm-9 p-2">{{ $user->account_group }}</div>
        </div>

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Stock Type</b></div>
            <div class="col-sm-9 p-2">{{ $user->profile->stock_type->name }}</div>
        </div>        

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Pricing Group</b></div>
            <div class="col-sm-9 p-2">{{ $user->profile->pricing_group->name }}</div>
        </div>        

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Warehouse</b></div>
            <div class="col-sm-9 p-2">{{ $user->profile->warehouse->name }}</div>
        </div>        

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Email</b></div>
            <div class="col-sm-9 p-2">{{ $user->email }}</div>
        </div>

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Confirmed</b></div>
            <div class="col-sm-9 p-2">{{ $user->is_confirmed }}</div>
        </div>

        <div class="row mb-3 border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Active</b></div>
            <div class="col-sm-9 p-2">{{ $user->is_active }}</div>
        </div>

        <form autocomplete="off" role="form" action="{{ route('admin.accounts.token.regenerate', $user->id)  }}"
            method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="form-group row mr-2 {!! $errors->first('token', 'has-warning') !!}">
                <label for="token" class="col-sm-3 col-form-label"><b>API key</b></label>

                <div class="col-sm-6">
                    <input type="text" class="form-control" id="token" name="token" autocomplete="off"
                        value="{{{ old('token', isset($user) ? $user->token : null) }}}"> {!!
                    $errors->first('token', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row mr-2 {!! $errors->first('token', 'has-warning') !!}">
                <label for="token" class="col-sm-3 col-form-label"></label>

                <div class="col-sm-9 p-2">

                    <button type="submit" class="btn btn-primary btn-md">
                        <i class="fas fa-save align-middle"></i> <span
                            class="align-middle"><strong>Re-Generate</strong></span>
                    </button>
                </div>
            </div>


        </form>



        <br />


        <br />

        <div class="row">
            <div class="col-sm-6 offset-3">



            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop