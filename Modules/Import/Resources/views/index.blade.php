@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('import::labels.imports.management'))

@section('content')
     
     <h2> @lang('import::labels.imports.management') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
