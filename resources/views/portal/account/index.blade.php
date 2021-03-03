@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.accounts.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
       

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Name</b></div>
            <div class="col-sm-9 p-2">{{ $user->name }}</div>
        </div>

        <div class="row  border-bottom">
            <div class="col-sm-3 bg-light p-2"><b>Account Type</b></div>
            <div class="col-sm-9 p-2">{{ strtoupper($user->roles()->first()->name) }}</div>
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
            <div class="col-sm-3 bg-light p-2"><b>Stock Group</b></div>
            <div class="col-sm-9 p-2">{{ $user->profile->stock_group->name }}</div>
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

        
            <div class="form-group row mr-2 {!! $errors->first('token', 'has-warning') !!}">
                <label for="token" class="col-sm-3 col-form-label"><b>API key</b></label>

                <div class="col-sm-6">
                    <input type="text" class="form-control" id="token" name="token" autocomplete="off"
                        value="{{{ old('token', isset($user) ? $user->token : null) }}}" readonly> {!!
                    $errors->first('token', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group row mr-2 {!! $errors->first('token', 'has-warning') !!}">
                <label for="token" class="col-sm-3 col-form-label"></label>

                <div class="col-sm-9 p-2">
 
                </div>
            </div>
        
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