@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('order::labels.orders.management'))

@section('content')
     
     <h2> @lang('order::labels.orders.management') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
