@extends('layouts.admin')
@php $type = ucfirst($type)  @endphp
@section('title', "$type Offer Create")
@section('card_name', "$type Offer Create")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
    <li class="breadcrumb-item active"> {{ $type }} Offer Create</li>
@endsection
@section('action')
    <a href="{{ route('product.list', $type) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>{{ $type }} Offer Create</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('product.store', strtolower($type)) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                @if($errors->any())
                                    <div class="form-group col-md-12 mb-0">
                                        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            {{ implode('', $errors->all(':message')) }}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group col-md-4 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer Type</label>
                                    <select class="form-control required" name="offer_category_id" id="offer_type"
                                            required data-validation-required-message="Please select offer">
                                        <option data-alias="" value="">---Select Offer Type---</option>
                                        @foreach($offers as $offer)
                                            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}">{{ $offer->name_en }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('product_code') ? ' error' : '' }}">
                                    <label for="product_code" class="required">Product Code</label>
                                    <select id="product_core" name="product_code"
                                            data-url="{{ url('product-core/match') }}"
                                            required data-validation-required-message="Please select product code">
                                        <option value="">Select product code</option>
                                        @foreach($productCoreCodes as $productCodes)
                                            <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['product_code'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-warning">If product existing in core product. select dropdown. otherwise type than enter</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Please Select Category</label>
                                        <select multiple
                                                class="form-control data-section"
                                                name="offer_categories[]">
                                            <option value="">Please Select Category</option>

                                            @foreach ($offerCategory as $key => $category)
                                                <option
                                                    value="{{ $category['id'] }}">  {{$category['name']}}
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
                                    <label for="name_en">Offer Name (English)</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter offer name in English"
                                           value="{{ old("name_en") ? old("name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Offer Name (Bangla)</label>
                                    <input type="text" name="name_bn" id="name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('sd_vat_tax_en') ? ' error' : '' }}">
                                    <label for="sd_vat_tax_en">Display SD VAT Tax (English)</label>
                                    <input type="text" name="sd_vat_tax_en" id="sd_vat_tax_en" class="form-control" placeholder="Enter SD Vat Tax in English"
                                           value="{{ old("sd_vat_tax_en") ? old("sd_vat_tax_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('sd_vat_tax_en'))
                                        <div class="help-block">{{ $errors->first('sd_vat_tax_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('sd_vat_tax_bn') ? ' error' : '' }}">
                                    <label for="sd_vat_tax_bn">Display SD VAT Tax (Bangla)</label>
                                    <input type="text" name="sd_vat_tax_bn" id="sd_vat_tax_bn" class="form-control" placeholder="Enter SD Vat Tax in Bangla"
                                           value="{{ old("sd_vat_tax_bn") ? old("sd_vat_tax_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('sd_vat_tax_bn'))
                                        <div class="help-block">{{ $errors->first('sd_vat_tax_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               value="{{ old("start_date") ? old("start_date") : '' }}"
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
                                           value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="0">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }} product_details_img">
                                    <label for="tag_category_id">Product Details Image</label>
                                    <div class="custom-file">
                                        {{--        <input type="hidden" name="old_web_img" value="">--}}
                                        {{--        <input type="hidden" name="old_web_img" value="{{ (!empty($product->image)) ? $product->image : ''}}">--}}
                                        <input type="file" name="image" class="custom-file-input dropify" data-height="90">
                                        {{--        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                                    </div>
                                </div>

                                <slot id="internet" data-offer-type="internet" style="display: none">
                                    @include('layouts.partials.products.internet')
                                </slot>

                                <slot id="bundles" data-offer-type="bundles" style="display: none">
                                    @include('layouts.partials.products.bundle')
                                </slot>

                                <slot id="new_sim_offer" data-offer-type="new_sim_offer" style="display: none">
                                    @include('layouts.partials.products.bundle')
                                </slot>

                                <slot id="voice" data-offer-type="voice" style="display: none">
                                    @include('layouts.partials.products.voice')
                                </slot>
                                @if(strtolower($type) == 'prepaid')
                                    <slot id="call_rate" data-offer-type="call_rate" style="display: none">
                                        @include('layouts.partials.products.call_rate')
                                    </slot>
                                @endif

                                <slot id="packages" data-offer-type="packages" style="display: none">
                                    @include('layouts.partials.products.packages')
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

                                <slot id="bondho_sim" data-offer-type="bondho_sim" style="display: none">
                                    @include('layouts.partials.products.common-field.price_vat_mrp')
                                    @include('layouts.partials.products.common-field.call_rate')
                                    @include('layouts.partials.products.common-field.call_rate_unit')
                                    @include('layouts.partials.products.common-field.minute_volume')
                                    @include('layouts.partials.products.common-field.internet_volume')
                                    @include('layouts.partials.products.common-field.sms_volume')

                                    @include('layouts.partials.products.common-field.validity_unit')
{{--                                    @include('layouts.partials.products.common-field.validity')--}}
{{--                                    @include('layouts.partials.products.common-field.validity_free_text')--}}
                                    @include('layouts.partials.products.common-field.ussd_code')

                                    @include('layouts.partials.products.common-field.tag')
                                </slot>

                                <slot id="others" data-offer-type="others" style="display: none">
                                    @include('layouts.partials.products.other')
                                    @include('layouts.partials.products.common-field.product-image')
                                </slot>

                                @include('layouts.partials.products.common-field.search-related-field')

                                <div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }}">
                                    <label for="mobileImg">Product Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="product_image" data-height="90" class="dropify">
                                        {{--<!-- data-default-file="{{ config('filesystems.file_base_url') . $menu->icon }}"-->>--}}
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
                                        <input type="checkbox" name="show_in_home" value="1" id="trending">
                                        <label for="trending" class="ml-1"> <strong>Show In Home</strong></label><br>
                                        <input type="checkbox" name="special_product" value="1" id="special_product">
                                        <label for="special_product" class="ml-1"><strong>Special Product</strong></label><br>
                                        <input type="checkbox" name="rate_cutter_offer" value="1" id="rate_cutter">
                                        <label for="rate_cutter" class="ml-1"><strong>Is Rate Cutter Offer</strong></label> <br>
                                        <input type="checkbox" name="is_four_g_offer" value="1" id="is_four_g_offer">
                                        <label for="is_four_g_offer" class="ml-1"><strong>Is 4G Offer</strong></label> <br>
                                    </div>
                                </div>

                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <label></label>--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="special_product" class="mr-1">Is Special Product:</label>--}}
                                {{--                                        <input type="checkbox" name="special_product" value="1" id="special_product">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="rate_cutter" class="mr-1">Is Rate Cutter Offer:</label>--}}
                                {{--                                        <input type="checkbox" name="rate_cutter_offer" value="1" id="rate_cutter">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button id="save" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
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

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <style>
        .type-line {
            border-top: 1px solid #0a0e45 !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(function () {
            let offerType = $('#offer_type');

            offerType.change(function () {
                let offerTypeVal = $('option:selected', this).attr('data-alias')
                let productImg = $('.product_details_img');
                if(offerTypeVal == "internet" || offerTypeVal == "voice" || offerTypeVal == "bundles" || offerTypeVal == "call_rate"){
                    productImg.show()
                } else {
                    productImg.hide()
                }
            })

            $('#product_core').selectize({
                create: true,
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });

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
            $('.data-section').select2({
                placeholder: 'Please Select Category',
                allowClear: true
            });
        })
    </script>
@endpush


