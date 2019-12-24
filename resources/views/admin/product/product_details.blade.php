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
                                @if($productDetail->offer_category_id == 9)
                                    <input type="hidden" name="other_offer_type_id" value="{{ $productDetail->offer_info['other_offer_type_id'] }}">
                                @endif
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
                                           value="{{ $productDetail->product_core->activation_ussd }}">
                                </div>


                                @if($productDetail->offer_category_id == \App\Enums\OfferType::INTERNET)
                                    @include('layouts.partials.product-details.voice')
                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::VOICE)
                                    @include('layouts.partials.product-details.voice')

                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::BUNDLES)
                                    @include('layouts.partials.product-details.voice')

                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::PACKAGES &&
                                        $productDetail->offer_info['package_offer_type_id'] == \App\Enums\OfferType::PREPAID_PLANS)
                                    @include('layouts.partials.product-details.packages.prepaid_plan')

                                @elseif( $productDetail->offer_category_id == \App\Enums\OfferType::PACKAGES &&
                                         $productDetail->offer_info['package_offer_type_id'] == \App\Enums\OfferType::START_UP_OFFERS)
                                    @include('layouts.partials.product-details.packages.start_up_offer_structure_2')

                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::POSTPAID_PLANS)
                                    <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>

                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::ICON_PLANS)
                                    <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>

                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::OTHERS &&
                                        $productDetail->offer_info['other_offer_type_id'] == \App\Enums\OfferType::BONDHO_SIM_OFFER)
                                    @include('layouts.partials.product-details.other-details.bondho_sim')

                                @elseif($productDetail->offer_category_id == \App\Enums\OfferType::OTHERS &&
                                        $productDetail->offer_info['other_offer_type_id'] == \App\Enums\OfferType::FOUR_G_OFFERS)
                                    @include('layouts.partials.product-details.other-details.4g_offer')
                                @endif

                                <div class="form-group col-md-6 {{ $errors->has('banner_alt_text') ? ' error' : '' }}">
                                    <label for="banner_alt_text" class="required">Alt Text</label>
                                    <input type="text" name="banner_alt_text"  class="form-control" placeholder="Enter image alter text"
                                           value="{{ optional($productDetail->product_details)->banner_alt_text}}" required data-validation-required-message="Enter image alter text">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_alt_text'))
                                        <div class="help-block">  {{ $errors->first('banner_alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mt-1 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <span>Upload banner image</span>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image_url" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                </div>

                                <div class="form-group col-md-6">
                                    @if( !empty($productDetail->product_details->banner_image_url) )
                                        <img src="{{ config('filesystems.file_base_url') . optional($productDetail->product_details)->banner_image_url }}" style="height:70px;width:70px;margin-top:10px;" id="imgDisplay">
                                    @else
                                        <div class="form-group col-md-6">
                                            <img style="height:70px;width:70px;display:none" id="imgDisplay">
                                        </div>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>

{{--    <script>--}}
{{--        $(function () {--}}
{{--            $("textarea#details").summernote({--}}
{{--                toolbar: [--}}
{{--                    ['style', ['bold', 'italic', 'underline', 'clear']],--}}
{{--                    ['font', ['strikethrough', 'superscript', 'subscript']],--}}
{{--                    ['fontsize', ['fontsize']],--}}
{{--                    ['color', ['color']],--}}
{{--                    // ['table', ['table']],--}}
{{--                    ['para', ['ul', 'ol', 'paragraph']],--}}
{{--                    ['view', ['fullscreen', 'codeview']]--}}
{{--                ],--}}
{{--                height:200--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endpush






