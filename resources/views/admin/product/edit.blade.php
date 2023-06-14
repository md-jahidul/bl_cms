@php use App\Enums\OfferType @endphp
@extends('layouts.admin')
@php $type = ucfirst($type)  @endphp
@section('title', "$type Offer Edit")
@section('card_name', "$type Offer Edit")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active"> {{ $type }} Offer Edit</li>
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
                        <div class="row">
                            <input type="hidden" name="previous_page" value="{{ $previous_page  }}">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <div class="form-group col-md-3 {{ $errors->has('product_type_id') ? ' error' : '' }}">
                                <label for="offer_category_id" class="required">Offer Type</label>
                                <select class="form-control" name="offer_category_id" id="offer_type"
                                        required data-validation-required-message="Please select offer" disabled>
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
                            <div class="form-group col-md-3 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                <label for="offer_category_id">Show In</label>
                                <select class="form-control data-section" name="show_in_multi_cat[]" id="offer_type" multiple>
                                    @foreach($offersType as $offer)
                                        @if(!in_array($offer->alias, ['others', 'packages', 'campaign']) && $product->offer_category_id != $offer->id)
                                            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}"
                                                    @if(is_array($product->show_in_multi_cat) && in_array($offer->id, $product->show_in_multi_cat)) selected @endif
                                            >{{ $offer->name_en }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('offer_category_id'))
                                    <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('product_code') ? ' error' : '' }}">
                                <label for="product_code" class="required">Product Code</label>
                                <input type="text" class="form-control" name="product_code" placeholder="Enter product code"
                                       required data-validation-required-message="Enter product code"
                                       value="{{ $product->product_code }}">
                                <div class="help-block"></div>
                                @if ($errors->has('product_code'))
                                    <div class="help-block">{{ $errors->first('product_code') }}</div>
                                @endif
                            </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Please Select Category</label>
                                        <select multiple
                                                class="form-control data-section"
                                                name="offer_categories[]">
                                            <option value="">Please Select Category</option>

                                            @foreach ($offerCategory as $key => $category)
                                                <option
                                                    value="{{ $category['id'] }}" @if(in_array($category['id'], $selectedCategory)) selected @endif >  {{$category['name']}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <span><h4><strong>Offer Info</strong></h4></span>
                                    <div class="form-actions col-md-12 mt-0 type-line"></div>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en">Offer Name</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter offer name english"
                                           value="{{ $product->name_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Offer Name Bangla</label>
                                    <input type="text" name="name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                           value="{{ $product->name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('sd_vat_tax_en') ? ' error' : '' }}">
                                    <label for="sd_vat_tax_en">Display SD VAT Tax (English)</label>
                                    <input type="text" name="sd_vat_tax_en" id="sd_vat_tax_en" class="form-control" placeholder="Enter SD Vat Tax in English"
                                           value="{{ optional($product->product_core)->sd_vat_tax_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('sd_vat_tax_en'))
                                        <div class="help-block">{{ $errors->first('sd_vat_tax_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('sd_vat_tax_bn') ? ' error' : '' }}">
                                    <label for="sd_vat_tax_bn">Display SD VAT Tax (Bangla)</label>
                                    <input type="text" name="sd_vat_tax_bn" id="sd_vat_tax_bn" class="form-control" placeholder="Enter SD Vat Tax in Bangla"
                                           value="{{ optional($product->product_core)->sd_vat_tax_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('sd_vat_tax_bn'))
                                        <div class="help-block">{{ $errors->first('sd_vat_tax_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               value="{{ $product->start_date }}"
                                               placeholder="Please select start date" />
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                           placeholder="Please select end date"
                                           value="{{ (!empty($product->end_date)) ? $product->end_date : '' }}" autocomplete="off">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }} product_detals_img {{ $product->offer_category_id != OfferType::OTHERS ? '' : 'd-none' }}">
                                    <label for="tag_category_id">Product Details Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input dropify" data-height="90"
                                               data-default-file="{{ config('filesystems.file_base_url') . $product->image }}">
                                    </div>
                                </div>

                                <slot class="{{ $product->offer_category_id == OfferType::INTERNET ? '' : 'd-none' }}" id="internet" data-offer-type="internet">
                                    @include('layouts.partials.products.internet')
                                </slot>

                                <slot class="{{ $product->offer_category_id == OfferType::BUNDLES ? '' : 'd-none' }}" id="bundles" data-offer-type="bundles">
                                    @include('layouts.partials.products.bundle')
                                </slot>

                                <slot class="{{ $product->offer_category_id == OfferType::NEW_SIM_OFFER ? '' : 'd-none' }}" id="new_sim_offer" data-offer-type="new_sim_offer">
                                    @include('layouts.partials.products.bundle')
                                </slot>

                                <slot class="{{ $product->offer_category_id == OfferType::VOICE ? '' : 'd-none' }}" id="voice" data-offer-type="voice">
                                    @include('layouts.partials.products.voice')
                                </slot>
                                @if(strtolower($type) == 'prepaid')
                                    <slot class="{{ $product->offer_category_id == OfferType::CALL_RATE ? '' : 'd-none' }}" id="call_rate" data-offer-type="call_rate">
                                            @include('layouts.partials.products.call_rate')
                                    </slot>

                                    <slot class="{{ $product->offer_category_id == OfferType::RECHARGE_OFFER ? '' : 'd-none' }}" id="recharge_offer" data-offer-type="recharge_offer">
                                        @include('layouts.partials.products.bundle')
                                    </slot>
                                @endif
                                <slot class="{{ $product->offer_category_id == OfferType::PACKAGES ? '' : 'd-none' }}" id="packages" data-offer-type="packages">
                                    @include('layouts.partials.products.packages')
                                    @include('layouts.partials.products.common-field.price_vat_mrp')
                                    @include('layouts.partials.products.common-field.internet_volume')
                                    @include('layouts.partials.products.common-field.minute_volume')
                                    @include('layouts.partials.products.common-field.sms_volume')
                                    @include('layouts.partials.products.common-field.call_rate')
                                    @include('layouts.partials.products.common-field.call_rate_unit')
                                    @include('layouts.partials.products.common-field.ussd_code')
                                    @include('layouts.partials.products.common-field.validity_unit')
                                    @include('layouts.partials.products.common-field.validity')
                                    @include('layouts.partials.products.common-field.validity_free_text')
                                    @include('layouts.partials.products.common-field.tag')
                                </slot>
                                <slot class="{{ $product->offer_category->alias == "bondho_sim" ? '' : 'd-none' }}" id="bondho_sim" data-offer-type="bondho_sim">
                                    @include('layouts.partials.products.common-field.price_vat_mrp')
                                    @include('layouts.partials.products.common-field.call_rate')
                                    @include('layouts.partials.products.common-field.call_rate_unit')
                                    @include('layouts.partials.products.common-field.minute_volume')
                                    @include('layouts.partials.products.common-field.internet_volume')
                                    @include('layouts.partials.products.common-field.sms_volume')
                                    @include('layouts.partials.products.common-field.ussd_code')
                                    @include('layouts.partials.products.common-field.validity_unit')
                                    @include('layouts.partials.products.common-field.validity')
                                    @include('layouts.partials.products.common-field.validity_free_text')
                                    @include('layouts.partials.products.common-field.tag')
                                </slot>

                                <slot class="{{ $product->offer_category_id == OfferType::OTHERS ? '' : 'd-none' }}" id="others" data-offer-type="others">
                                    @include('layouts.partials.products.other')
                                </slot>

                                @include('layouts.partials.products.common-field.search-related-field')

                                <div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }} {{ $product->offer_category_id == OfferType::OTHERS ? '' : 'd-none' }}">
                                    <label for="mobileImg">Product Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="product_image" data-height="90" class="dropify"
                                        data-default-file="{{ config('filesystems.file_base_url') . $product->product_image }}">
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('icon'))
                                        <div class="help-block">  {{ $errors->first('icon') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    <label>For:</label>
                                    <div class="form-group" id="show_in_home">
                                        <label for="trending"></label><br>
                                        <input type="checkbox" name="show_in_home" value="1" id="trending" {{ ($product->show_in_home == 1) ? 'checked' : '' }}>
                                        <label for="trending" class="ml-1"> <strong>Show In Home</strong></label><br>
                                        <input type="checkbox" name="special_product" value="1" id="special_product" {{ ($product->special_product == 1) ? 'checked' : '' }}>
                                        <label for="special_product" class="ml-1"><strong>Special Product</strong></label><br>
                                        <input type="checkbox" name="rate_cutter_offer" value="1" id="rate_cutter" {{ ($product->rate_cutter_offer == 1) ? 'checked' : '' }}>
                                        <label for="rate_cutter" class="ml-1"><strong>Is Rate Cutter Offer</strong></label> <br>
                                        <input type="checkbox" name="is_four_g_offer" value="1" id="is_four_g_offer" {{ ($product->is_four_g_offer == 1) ? 'checked' : '' }}>
                                        <label for="is_four_g_offer" class="ml-1"><strong>Is 4G Offer</strong></label> <br>
                                        <input type="checkbox" name="is_recharge" value="1" id="is_recharge" {{ ($product->is_recharge == 1) ? 'checked' : '' }}>
                                        <label for="is_recharge" class="ml-1"><strong>Is Recharge Offer</strong></label> <br>
                                    </div>
                                </div>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <style>
        .type-line {
            border-top: 1px solid #0a0e45 !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#start_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                showClose: true,

            });
            $('.data-section').select2({
                placeholder: 'Please Select Category',
                allowClear: true
            });
            $('#end_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false, //Important! See issue #1075
                showClose: true,

            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });

            $('.duration_categories').change(function () {
                let durationOntion = $(this).find('option:selected').attr('data-alias')
                let durationDays = $(this).find('option:selected').attr('data-days')
                let validityField = $('.validity_days');

                if (durationOntion) {
                    validityField.val(durationDays).prop('readonly', true);
                }
            })

            $('.validity_unit').change(function () {
                let validityUnit = $(this).val();
                let validate = $('.validity');
                let validateFreeText = $('.validity_free_text');
                if (validityUnit === "free_text") {
                    validate.addClass('hidden')
                    validateFreeText.removeClass('hidden')
                }else {
                    validateFreeText.addClass('hidden')
                    validate.removeClass('hidden')
                }
            })
        });
    </script>
@endpush







