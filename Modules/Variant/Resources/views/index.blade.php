@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('variant::labels.variants.management'))

@section('content')
     
     <h2> @lang('variant::labels.variants.management') module is not active</h2>
    @endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop
