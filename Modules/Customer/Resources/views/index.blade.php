@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('customer::labels.customers.portal'))

@section('content')
     
     <h2> @lang('customer::labels.customers.portal') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
