@extends('layouts.backend')

@section('title', app_name() . ' | ' . __('labels.cart.view'))

@section('content')
<div class="card mt-2">
    <div class="card-body">
        <!--row-->
        <div class="card">
            <div class="card-body">
            @if(count($cart) > 0) 
            <form autocomplete="off" role="form" action="{{ route('portal.cart.save') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <div class="form-group row {!! $errors->first('ref_id', 'has-warning') !!}">
                        <label for="ref_id" class="col-sm-3 col-form-label">Rereference Id</label>
                        <div class="col-sm-4">

                            <input type="text" class="form-control" id="ref_id" name="ref_id" autocomplete="off">
                            {!!
                            $errors->first('ref_id', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-md mb-4 float-right">
                        <i class="fas fa-upload align-middle"></i> <span class="align-middle"><strong>Upload</strong></span>
                    </button>
                </form>


            <form autocomplete="off" role="form" action="{{ route('portal.cart.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
 

                <table  class="table row-border hover order-column" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($cart as $item)
                        <tr>
                            <td>{{ $item['sku'] }}</td>
                            <td>{{ productNameBySku($item['sku']) }}</td>
                            <td>
                            <div class="col-sm-3">
                            <input type="number" name="sku[{{$item['sku']}}]" class="form-control" value="{{$item['quantity']}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-info btn-md m-4 float-right">
                        <i class="far fa-save align-middle"></i> <span class="align-middle"><strong>Update Cart</strong></span>
                    </button>
                </form>
                @else

                <div class="alert alert-warning" role="alert">
                    There is no item in your cart!
                </div>
                @endif
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