@extends('layouts.admin')
@section('title', 'Edit | Product Price Slab')
@section('card_name', 'Product Price Slab Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('product-price/slabs') }}">Price Slab List</a></li>
<li class="breadcrumb-item active">Price Slab Edit</li>
@endsection
@section('action')
<a href="{{ url('product-price/slabs') }}" class="btn btn-sm btn-secondary"><i class="la la-arrow-left"></i>Back</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form method="POST" action="{{ route('priceSlab.update', $priceSlab->id) }}" class="form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Range</label>
                                <input class="form-control" value="{{$priceSlab->range_name}}" name="range_name">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Product Code</label>
                                <input class="form-control" value="{{$priceSlab->product_code}}" name="product_code">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Range Start</label>
                                <input type="number" class="text_editor form-control" value="{{$priceSlab->range_start}}" name="range_start" min="1" max="1000">
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Range End</label>
                                <input type="number" class="form-control" value="{{$priceSlab->range_end}}" name="range_end" min="1" max="1000">
                                <div class="help-block"></div>
                            </div>

                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

@endpush
@push('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>



<script>
    $(function () {

    });
</script>

@endpush




