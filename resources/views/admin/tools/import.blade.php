@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.imports.management'))


@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <!--col-->

            <div class="col-sm-7">

            </div>
            <!--col-->
        </div>
        <!--row-->

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Import Products</a>
               
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <div class="row">
                    <div class="col">
                        <form autocomplete="off" role="form" action="{{ route('admin.tools.import.csv_file')  }}"
                            method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" name="model" value="product" />

                            <div class="form-group row {!! $errors->first('csv_file', 'has-warning') !!}">
                                <label for="csv_file" class="col-sm-3 col-form-label">CSV file to import</label>
                                <div class="col-sm-9">

                                    <input type="file" class="form-control" id="csv_file" name="csv_file"
                                        autocomplete="off">
                                    {!!
                                    $errors->first('csv_file', '<span class="help-block">:message</span>') !!}
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

    </div>
</div>
@endsection
@section('styles')

@parent
@stop

@section('scripts')
@parent

@stop