@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('report::labels.reports.portal'))

@section('content')
     
     <h2> @lang('report::labels.reports.portal') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
