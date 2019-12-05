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


                                @if($productDetail->offer_category_id == \App\Enums\OtherOfferType::INTERNET)
                                    <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>
                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::VOICE)
                                    @include('layouts.partials.product-details.voice')

                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::BUNDLES)
                                   <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>

                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::PREPAID_PLANS)
                                    <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>

                                @elseif( $productDetail->offer_category_id == \App\Enums\OtherOfferType::PACKAGES &&
                                         $productDetail->offer_info['package_offer_type_id'] == \App\Enums\OtherOfferType::START_UP_OFFERS)
                                    {{--<div class="col-md-12 text-center">--}}
                                        {{--<h2><strong class="text-danger"> Under Construction</strong></h2>--}}
                                    {{--</div>--}}
                                    @include('layouts.partials.product-details.packages.start_up_offer_structure_2')

                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::POSTPAID_PLANS)
                                    <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>

                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::ICON_PLANS)
                                    <div class="col-md-12 text-center">
                                        <h2><strong class="text-danger"> Under Construction</strong></h2>
                                    </div>

                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::OTHERS &&
                                        $productDetail->offer_info['other_offer_type_id'] == \App\Enums\OtherOfferType::BONDHO_SIM_OFFER)
                                    @include('layouts.partials.product-details.other-details.bondho_sim')

                                @elseif($productDetail->offer_category_id == \App\Enums\OtherOfferType::OTHERS &&
                                        $productDetail->offer_info['other_offer_type_id'] == \App\Enums\OtherOfferType::FOUR_G_OFFERS)
                                    @include('layouts.partials.product-details.other-details.4g_offer')
                                @endif

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
    <script src="{{ asset('app-assets/js/scripts/editors/editor-ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    // ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:200
            })
        })
    </script>
@endpush






