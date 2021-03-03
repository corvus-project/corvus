@extends('adminlte::page')

@section('title', app_name() . ' | ' . __('labels.products.category_management'))


@section('content')



<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.products.categories.all') }}
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                    <a href="{{ route('backoffice.products.view_categories', $product->id) }}"
                        class="btn btn-success btn-xs m-1" data-toggle="tooltip" title="List the categories"><i
                            class="fas fa-list"></i></a>

                    <a href="{{ route('backoffice.products.create_category', $product->id) }}"
                        class="btn btn-primary btn-xs m-1" data-toggle="tooltip" title="Add Product to a Category"><i
                            class="fas fa-plus"></i></a>

                    <a href="{{ route('backoffice.products.view', $product->id) }}" class="btn btn-info btn-xs m-1"
                        data-toggle="tooltip" title="Back to product"><i class="fas fa-arrow-alt-circle-left"></i></a>

                </div>
            </div>
            <!--col-->
        </div>
        @include('includes.product_box')

        <form autocomplete="off" role="form"
            action="{{ route('backoffice.products.delete_category.destroy', [$product->id, $category->id]) }}" method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="hidden" name="category_id" value="{{{ $category->id }}}" />
            <input type="hidden" name="product_id" value="{{{ $product->id }}}" />
            <div class="form-group row {!! $errors->first('category', 'has-warning') !!}">
                <label for="category" product_id class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-9">
                    {{ $category->name }}
                    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <button type="submit" class="btn btn-danger btn-md mb-4 float-right">
                <i class="fas fa-trash align-middle"></i> <span
                    class="align-middle"><strong>{{__('labels.general.buttons.delete')}}</strong></span>
            </button>
        </form>

    </div>
</div>

@endsection