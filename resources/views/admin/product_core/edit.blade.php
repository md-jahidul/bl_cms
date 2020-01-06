@php use App\Enums\OfferType @endphp
@extends('layouts.admin')
@php $type = ucfirst($type)  @endphp
@section('title', "Product Core Edit")
@section('card_name', "Product Core Edit")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.core.list') }}"> Product Core List</a></li>
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active"> Product Core Edit</li>
@endsection
@section('action')
    <a href="{{ url($previous_page) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>{{ $type }} Offer Edit</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('product.update', [strtolower($type), $product->product_code] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <input type="hidden" name="previous_page" value="{{ $previous_page  }}">

                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Offer Name</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter offer name english"
                                           value="{{ $product->name }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('product_code') ? ' error' : '' }}">
                                    <label for="product_code" class="required">Product ID</label>
                                    <input type="text" class="form-control" placeholder="Enter product code"
                                           required data-validation-required-message="Enter product code" readonly
                                           value="{{ $product->product_code }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('commercial_name_en') ? ' error' : '' }}">
                                    <label for="commercial_name_en" class="required">Commercial Name English</label>
                                    <input type="text" name="commercial_name_en"  class="form-control" placeholder="Enter offer name english"
                                           value="{{ $product->commercial_name_en }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_en'))
                                        <div class="help-block">{{ $errors->first('commercial_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('commercial_name_bn') ? ' error' : '' }}">
                                    <label for="commercial_name_bn" class="required">Commercial Name Bangla</label>
                                    <input type="text" name="commercial_name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                           required data-validation-required-message="Enter offer name in Bangla"
                                           value="{{ $product->commercial_name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_bn'))
                                        <div class="help-block">{{ $errors->first('commercial_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_description') ? ' error' : '' }}">
                                    <label for="short_description" class="required">Short Description</label>
                                    <input type="text" name="short_description" class="form-control" placeholder="Enter offer name in Bangla"
                                           required data-validation-required-message="Enter offer name in Bangla"
                                           value="{{ $product->short_description }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_description'))
                                        <div class="help-block">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>



                                {{-- <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date" class="required">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               value="{{ $product->start_date }}"
                                               required data-validation-required-message="Please select start date"
                                               placeholder="Please select start date" />
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div> --}}



                                <div class="form-group col-md-6">
                                    <label for="ussd">USSD Code</label>
                                    <input type="text" name="activation_ussd"  class="form-control" placeholder="Enter offer ussd english" maxlength="25"
                                           value="{{ $product->activation_ussd }}">
                                </div>

                                
                                {{-- <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                           placeholder="Please select end date"
                                           value="{{ (!empty($product->end_date)) ? $product->end_date : '' }}" autocomplete="off">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ussd_bn') ? ' error' : '' }}">
                                    <label for="ussd_bn">USSD Code Bangla</label>
                                    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd in Bangla" maxlength="25"
                                           value="{{ $product->ussd_bn }}">
                                </div>  --}}

                                <div class="form-group col-md-6">
                                    <label for="price">Mrp Price</label>
                                    <input type="number" name="price"  class="form-control" placeholder="Enter offer price" step="0.001"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ $product->mrp_price }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price">Price</label>
                                    <input type="number" name="price"  class="form-control" placeholder="Enter offer price" step="0.001"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ $product->price }}">
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="price">Vat</label>
                                    <input type="text" name="vat"  class="form-control" placeholder="Enter offer price in taka" step="0.001"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ $product->vat }}">
                                    <div class="help-block"></div>
                                </div>

                                {{-- <div class="form-group col-md-6">
                                    <label for="tag_category_id">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option value="">---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ ($tag->id == $product->tag_category_id ) ? 'selected' : '' }}>{{ $tag->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="form-group col-md-6 {{ $errors->has('product_type_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer Type</label>
                                    <select class="form-control" name="offer_category_id" id="offer_type"
                                            required data-validation-required-message="Please select offer">
                                        <option value="">---Select Offer Type---</option>
                                        @foreach($offersType as $offer)
                                            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}" {{ ($offer->id == $product->offer_category_id ) ? 'selected' : '' }}>{{ $offer->name_en }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">  {{ $errors->first('offer_category_id') }}</div>
                                    @endif
                                </div>
                            {{--</div>--}}

                                <slot class="{{ $product->offer_category_id == OfferType::INTERNET ? '' : 'd-none' }}" id="internet" data-offer-type="internet">
                                    @include('layouts.partials.products.internet')
                                </slot>
                                <slot class="{{ $product->offer_category_id == OfferType::PACKAGES ? '' : 'd-none' }}" id="packages" data-offer-type="packages">
                                    @include('layouts.partials.products.packages')
                                </slot>

                                <slot class="{{ $product->offer_category_id == OfferType::OTHERS ? '' : 'd-none' }}" id="others" data-offer-type="others">
                                    @include('layouts.partials.products.other')
                                </slot>

                            @if(strtolower($type) == 'prepaid')
                                <slot class="{{ $product->offer_category_id == OfferType::CALL_RATE ? '' : 'd-none' }}" id="call_rate" data-offer-type="call_rate">
                                    @include('layouts.partials.products.call_rate')
                                </slot>
                                <slot class="{{ $product->offer_category_id == OfferType::VOICE ? '' : 'd-none' }}" id="voice" data-offer-type="voice">
                                    @include('layouts.partials.products.voice')
                                </slot>
                                <slot class="{{ $product->offer_category_id == OfferType::BUNDLES ? '' : 'd-none' }}" id="bundles" data-offer-type="bundles">
                                    @include('layouts.partials.products.bundle')
                                </slot>
                            @endif

                            {{--<div class="row">--}}

                                {{-- <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="purchase_option" class="required">Purchase Option</label>
                                    <select class="form-control required" name="purchase_option" id="offer_type"
                                            required data-validation-required-message="Please select purchase option">
                                        <option data-alias="" value="">---Select Purchase Option---</option>
                                        <option value="recharge" {{ ("recharge" == $product->purchase_option ) ? 'selected' : '' }}>Recharge</option>
                                        <option value="balance" {{ ("balance" == $product->purchase_option ) ? 'selected' : '' }}>Balance</option>
                                        <option value="all" {{ ("all" == $product->purchase_option ) ? 'selected' : '' }}>All</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('purchase_option'))
                                        <div class="help-block">{{ $errors->first('purchase_option') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group pt-1" id="show_in_home">
                                        <label for="trending" class="mr-1">Trending Offer:</label>
                                        <input type="checkbox" name="show_in_home" value="1" {{ ($product->show_in_home == 1) ? 'checked' : '' }} id="trending">
                                    </div>
                                </div> --}}

{{--                                TODO: Savely Delete Recharge --}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="title" class="mr-1">Recharge</label>--}}
{{--                                        <input type="radio" name="is_recharge" value="1" id="yes" {{ ($product->status == 1) ? 'checked' : '' }}>--}}
{{--                                        <label for="yes" class="mr-1">Yes</label>--}}
{{--                                        <input type="radio" name="is_recharge" value="0" id="no" {{ ($product->is_recharge == 0) ? 'checked' : '' }}>--}}
{{--                                        <label for="no">No</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="active" {{ ($product->status == 1) ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ ($product->status == 0) ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
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

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#start_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                showClose: true,

            });
            $('#end_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false, //Important! See issue #1075
                showClose: true,

            });

            $('.duration_categories').change(function () {
                let durationOntion = $(this).find('option:selected').attr('data-alias')
                let durationDays = $(this).find('option:selected').attr('data-days')
                let validityField = $('.validity_days');

                if (durationOntion) {
                    validityField.val(durationDays).prop('readonly', true);
                }
            })
        });
    </script>
@endpush







