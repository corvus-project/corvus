@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('attribute::labels.attributes.management'))

@section('content')
     
     <h2> @lang('attribute::labels.attributes.management') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
