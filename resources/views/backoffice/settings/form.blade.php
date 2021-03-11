@extends('adminlte::page')
@section('title', app_name() . ' | ' . __('labels.settings.form'))

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{  __('labels.settings.form') }}
                        </h4>
                    </div>
                    <!--col-->

                </div>
                @php

                @endphp
                @include('includes.partials.messages')
                <form autocomplete="off" role="form"
                      action="{{ route('backoffice.settings.form.update') }}" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group row {!! $errors->first('currency', 'has-warning') !!}">
                        <label for="name"
                               class="col-sm-3 col-form-label">{{ trans('labels.currency') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('currency', $currencies, $settings->firstWhere('setting_key', 'currency')->setting_value, ['class'=>'form-control col-sm-5 currency']) }}
                            {!! $errors->first('currency', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                        <i class="fas fa-save align-middle"></i> <span
                            class="align-middle"><strong>{{__('labels.general.buttons.save')}}</strong></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
@parent
@stop
@section('scripts')
@parent

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js">
</script>

<script type="text/javascript">
    $(function() {
        $('.categories').select2({
            placeholder: 'Select an category'
        });
    });
</script>

@stop
