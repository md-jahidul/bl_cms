@php
    function match($id,$relatedProducts){
        foreach ($relatedProducts as $relatedProduct)
        {
            if($relatedProduct->related_product_id == $id){
                return true;
            }
        }
        return false;
    }
@endphp

@extends('layouts.admin')
@php $type = ucfirst($type)  @endphp
@section('title', "$type Offer ")
@section('card_name', "$type Offer Details")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active"> {{ $type }} Offer Details</li>
@endsection
@section('action')
    <a href="{{ url("offers/$type") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Product Details Page</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('product.details-update', [strtolower($type), $productDetail->id] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <input type="hidden" name="product_details_id" value="{{ $productDetail->product_details->id }}">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="">Offer Name</label>
                                    <input type="text" class="form-control" placeholder="Enter offer name english" readonly
                                           value="{{ $productDetail->name_en }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd">USSD Code English</label>
                                    <input type="text" class="form-control" placeholder="Enter offer ussd english" maxlength="25" readonly
                                           value="{{ $productDetail->ussd_en }}">
                                </div>

                                @if(strtolower($type) == 'prepaid')
                                    <div class="form-group col-md-6 {{ $errors->has('balance_check') ? ' error' : '' }}">
                                        <label for="balance_check" class="required">Balance Check (USSD)</label>
                                        <input type="text" name="balance_check"  class="form-control" placeholder="Enter offer name bangla"
                                               required data-validation-required-message="Enter offer name bangla"
                                               value="{{ $productDetail->product_details->balance_check }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('balance_check'))
                                            <div class="help-block">{{ $errors->first('balance_check') }}</div>
                                        @endif
                                    </div>
                                @endif


                                <div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
                                    <label for="role_id" class="required">Related Product</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple" name="related_product_id[]" required
                                                data-validation-required-message="Please select related product">
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ match($product->id,$productDetail->related_product) ? 'selected' : '' }}>{{$product->name_en}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>

                                @if($productDetail->offer_category_id == 4)
                                    <div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
                                        <label for="details_en" class="required">Details (English)</label>
                                        <textarea type="text" name="details_en"  class="form-control" placeholder="Enter short details in english" rows="5"
                                               required data-validation-required-message="Enter short details in english">{{ $productDetail->product_details->details_en }}</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_en'))
                                            <div class="help-block">{{ $errors->first('details_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                        <label for="details_bn" class="required">Details (Bangla)</label>
                                        <textarea type="text" name="details_bn"  class="form-control" placeholder="Enter short details in bangla" rows="5"
                                                  required data-validation-required-message="Enter short details in bangla">{{ $productDetail->product_details->details_bn }}</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('details_bn'))
                                            <div class="help-block">{{ $errors->first('details_bn') }}</div>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
                                    <label for="offer_details_en" class="required">Offer Details (English)</label>
                                    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
                                           required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_details_en'))
                                        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
                                    <label for="offer_details_bn" class="required">Offer Details (Bangla)</label>
                                    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
                                              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_details_bn'))
                                        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


<style>
    form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
        border-color: unset;
        -webkit-box-shadow: unset;
        -moz-box-shadow: unset;
        box-shadow: unset;
        border-width: 0;
        color : unset;
    }
</style>

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:300
            })
        })
    </script>
@endpush






