@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('api::labels.api.api_management'))

@section('content')
     
     <h2> @lang('api::labels.api.api_management') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
