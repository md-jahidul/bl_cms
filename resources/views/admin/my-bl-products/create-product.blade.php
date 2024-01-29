{{--@php--}}
{{--    function match($slug, $multiItems){--}}
{{--        foreach ($multiItems as $item){--}}
{{--           if($item->offer_section_slug == $slug){--}}
{{--              return true;--}}
{{--           }--}}
{{--         }--}}
{{--        return false;--}}
{{--     }--}}
{{--@endphp--}}

@extends('layouts.admin')
@section('title', 'Mybl Products')

@section('card_name', "Product Create")

@section('action')
    <a href="{{ route('mybl.product.index') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back To Product List
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong> Product Create Form</strong></h5><hr>
                    <div class="card-body card-dashboard">
                    <form class="form"
                          action="{{ route('mybl.product.store')}}"
                          enctype="multipart/form-data"
                          method="POST"
                          id="commentForm">
                        @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sim_type">Connection Type</label>
                                        <select name="sim_type" required class="form-control">
                                            <option value="1">PREPAID</option>
                                            <option value="2">POSTPAID</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('content_type') ? ' error' : '' }}">
                                    <label for="sim_type" class="required">Content Type</label>
                                    <select name="content_type" class="form-control filter" id="content_type"
                                            required data-validation-required-message="Please select content type">
                                        <option value="">---Select Content Type---</option>
                                        <option value="data">DATA</option>
                                        <option value="mix">MIX BUNDLES</option>
                                        <option value="voice">VOICE BUNDLES</option>
                                        <option value="sms">SMS BUNDLES</option>
                                        <option value="scr">SPECIAL CALL RATE</option>
                                        <option value="recharge_offer">RECHARGE OFFER</option>
                                        <option value="reactivation">REACTIVATION OFFER</option>
                                        <option value="ma loan">MA LOAN</option>
                                        <option value="data loan">DATA LOAN</option>
                                        <option value="minute loan">MINUTE LOAN</option>
                                        <option value="gift">GIFT</option>
                                        <option value="volume request">VOLUME REQUEST</option>
                                        <option value="volume transfer">VOLUME TRANSFER</option>
                                        <option value="roam">ROAMING PRODUCT</option>
                                        <option value="service">SERVICES</option>
                                        {{--<option value="bonus">BONUS</option>--}}
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('content_type'))
                                        <div class="help-block">{{ $errors->first('content_type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('product_code') ? ' error' : '' }}">
                                    <label for="product_code" class="required">Product Code</label>
                                    <input class="form-control" name="product_code" required
                                           data-validation-required-message="Please enter product code"
                                           value="{{ old("product_code") ? old("product_code") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('name') ? ' error' : '' }}">
                                        <label for="name" class="required">Name</label>
                                        <input class="form-control" name="name" required id="name"
                                        value="{{ old("name") ? old("name") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('commercial_name_en') ? ' error' : '' }}">
                                    <label for="name" class="required">Commercial Name En</label>
                                    <input class="form-control" name="commercial_name_en" required id="name"
                                           value="{{ old("commercial_name_en") ? old("commercial_name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_en'))
                                        <div class="help-block">{{ $errors->first('commercial_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('commercial_name_bn') ? ' error' : '' }}">
                                    <label for="name" class="required">Commercial Name Bn</label>
                                    <input class="form-control" name="commercial_name_bn" required id="name"
                                           value="{{ old("commercial_name_bn") ? old("commercial_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_bn'))
                                        <div class="help-block">{{ $errors->first('commercial_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Display Title En</label>
                                    <input class="form-control" name="display_title_en"
                                           value="{{ old("display_title_en") ? old("display_title_en") : '' }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Display Title Bn</label>
                                    <input class="form-control" name="display_title_bn"
                                           value="{{ old("display_title_bn") ? old("display_title_bn") : '' }}">
                                </div>

{{--                                <div class="form-group col-md-4 {{ $errors->has('activation_ussd') ? ' error' : '' }}">--}}
{{--                                    <label for="name">Activation USSD</label>--}}
{{--                                    <input class="form-control" name="activation_ussd" required id="name">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('activation_ussd'))--}}
{{--                                        <div class="help-block">{{ $errors->first('activation_ussd') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('balance_check_ussd') ? ' error' : '' }}">--}}
{{--                                    <label for="name">Balance Check USSD</label>--}}
{{--                                    <input class="form-control" name="balance_check_ussd" required id="name">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('balance_check_ussd'))--}}
{{--                                        <div class="help-block">{{ $errors->first('balance_check_ussd') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-4 {{ $errors->has('short_description') ? ' error' : '' }}">
                                        <label class="required">Short Description</label>
                                        <input class="form-control" name="short_description" required
                                               value="{{ old("short_description") ? old("short_description") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_description'))
                                        <div class="help-block">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('display_sd_vat_tax') ? ' error' : '' }}">
                                    <label>Display SD Vat Tax</label>
                                    <input class="form-control" name="display_sd_vat_tax"
                                           value="{{ old("display_sd_vat_tax") ? old("display_sd_vat_tax") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('display_sd_vat_tax'))
                                        <div class="help-block">{{ $errors->first('display_sd_vat_tax') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('points') ? ' error' : '' }}">
                                    <label>Points</label>
                                    <input type="number" class="form-control" name="points"
                                           value="{{ old("points") ? old("points") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('points'))
                                        <div class="help-block">{{ $errors->first('points') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MRP Price</label>
                                        <input class="form-control" name="mrp_price"
                                               value="{{ old("mrp_price") ? old("mrp_price") : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input class="form-control" name="price"
                                               value="{{ old("price") ? old("price") : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vat</label>
                                        <input type="text" step="0.001" class="form-control" name="vat"
                                               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                               value="{{ old("vat") ? old("vat") : '' }}">
                                    </div>
                                </div>

                                <slot id="offer_types"></slot>

                                <div class="form-group col-md-4 {{ $errors->has('validity') ? ' error' : '' }}">
                                    <label class="required">Validity </label>
                                    <input type="number" class="form-control" required name="validity"
                                           value="{{ old("price") ? old("price") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('validity'))
                                        <div class="help-block">{{ $errors->first('validity') }}</div>
                                    @endif
                                </div>

                                @php
                                    $validityUnits = ['day', 'days', 'hour', 'hours', 'month', 'months', 'year', 'years'];
                                @endphp

                                <div class="form-group col-md-4 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
                                    <label for="duration_category_id" class="validity_unit required">Validity Unit</label>
                                    <select class="form-control required duration_categories" name="validity_unit"
                                            id="validity_unit" required>
                                        <option value="">---Select Validity Unit---</option>
                                        @foreach($validityUnits as $value)
                                            <option value="{{ $value }}" {{ old("validity_unit") == $value ? 'selected' : '' }}>{{ ucfirst($value) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('duration_category_id'))
                                        <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Auto Renewable Code</label>
                                        <input class="form-control" name="auto_renew_code"
                                               value="{{ old("auto_renew_code") ? old("auto_renew_code") : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Recharge Product Code</label>
                                        <input class="form-control" name="recharge_product_code"
                                               value="{{ old("recharge_product_code") ? old("recharge_product_code") : '' }}">
                                    </div>
                                </div>

{{--                                <div class="form-group col-md-4">--}}
{{--                                    <label>Select Data Section</label>--}}
{{--                                    <select multiple--}}
{{--                                            class="form-control data-section"--}}
{{--                                            name="offer_section_slug[]" required>--}}
{{--                                        <option value="">Please Select Data Section</option>--}}
{{--                                            @foreach ($internet_categories as $key => $category)--}}
{{--                                                <option--}}
{{--                                                    value="{{ $key }}">  {{$category}}--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tags </label>
                                        <select multiple
                                                class="form-control tags"
                                                name="tags[]">
                                            <option value=""></option>

                                            @foreach ($tags as $key => $tag)
                                                <option
                                                    value="{{ $key }}" {{ old("tags") == $value ? 'selected' : '' }}>  {{$tag}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="special_type">Special Type</label>
                                        <select name="special_type" class="form-control">
                                            <option value=""></option>
                                            @foreach ($productSpecialTypes as $key => $specialType)
                                                <option
                                                    value="{{ $key }}" {{ old("special_type") == $key ? 'selected' : '' }}>  {{$specialType}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="required">Visibility (show/hide in app)</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="is_visible" value="1" id="show">
                                            <label for="show">Show</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="radio" name="is_visible" value="0" id="hide" checked>
                                            <label for="hide">Hide</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Schedule Availability </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label small">Show From</label>
                                                <input class="form-control" id="show_from" name="show_from"
                                                       placeholder="Show From Time" autocomplete="on"
                                                       value="{{ old("show_from") ? old("show_from") : '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small">Hide From</label>
                                                <input class="form-control" id="hide_from" name="hide_from"
                                                       placeholder="Hide From Time" autocomplete="off"
                                                       value="{{ old("hide_from") ? old("hide_from") : '' }}">
                                            </div>
                                        </div>
                                        @if($errors->has('tag'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('tag') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Product Image</label>
                                    <input type="file" id="input-file-now" name="media" class="dropify"/>
                                    @if($errors->has('media'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('media') }}</small>
                                        </p>
                                    @endif
                                </div>

                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="show_in_home" value="1" name="show_in_app">
                                        <label for="show_in_home">Show in Home</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="status" value="1" name="status" checked>
                                        <label for="status">Active</label>
                                    </fieldset>
                                </div>

                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="pin_to_top" value="1" name="pin_to_top"
{{--                                               @if($details->pin_to_top) checked @endif--}}
                                            {{$disablePinToTop ? 'disabled' : ''}}>
                                        <label for="pin_to_top">Pin to Top</label>
                                        @if($disablePinToTop)
                                            <label for="pin_to_top" class="small red">
                                                Maximum range for pin to top has been exceeded.
                                                To pin this product to top , please unpin any other product and retry.
                                            </label>
                                        @endif
                                    </fieldset>
                                </div>

                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_rate_cutter_offer" value="1"
                                               name="is_rate_cutter_offer">
                                        <label for="is_rate_cutter_offer">Is Rate Cutter offer</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_favorite" value="1"
                                               name="is_favorite">
                                        <label for="is_favorite">Is Favorite</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_popular_pack" value="1" name="is_popular_pack">
                                        <label for="is_popular_pack">Is Popular Pack</label>
                                    </fieldset>
                                </div>
                                <slot id="lms_tier_slab_info"></slot>
                                <div class="form-group col-md-4 mb-2" id="cta_action">
                                    <label for="base_msisdn_groups_id">Base Msisdn</label>
                                    <select id="base_msisdn_groups_id" name="base_msisdn_group_id"
                                            class="browser-default custom-select">
                                        <option value="">No Base Msisdn Group Selected</option>
                                        @foreach ($baseMsisdnGroups as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ isset($campaign) && $campaign->base_msisdn_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-warning"><strong><i class="la la-warning"></i> Warning:</strong> If you don't select a base group, this product is available for connection type-wise users</span>
                                    <div class="help-block"></div>
                                </div>
                                <div class="col-md-12 pl-0"><h5><strong>Digital Service</strong></h5></div>

                                <div class="form-group col-md-4 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Name BN</label>
                                    <input class="form-control" name="name_bn" id="name_bn"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('cta_name_en') ? ' error' : '' }}">
                                    <label for="name_bn">Cta Name EN</label>
                                    <input class="form-control" name="cta_name_en" id="cta_name_en"
                                           value="{{ old("cta_name_en") ? old("cta_name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('cta_name_en'))
                                        <div class="help-block">{{ $errors->first('cta_name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('cta_name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Cta Name BN</label>
                                    <input class="form-control" name="cta_name_bn" id="cta_name_bn"
                                           value="{{ old("cta_name_bn") ? old("cta_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('cta_name_bn'))
                                        <div class="help-block">{{ $errors->first('cta_name_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('redirection_name_en') ? ' error' : '' }}">
                                    <label for="name_bn">Redirection Name EN</label>
                                    <input class="form-control" name="redirection_name_en" id="redirection_name_en"
                                           value="{{ old("redirection_name_en") ? old("redirection_name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirection_name_en'))
                                        <div class="help-block">{{ $errors->first('redirection_name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('redirection_name_bn') ? ' error' : '' }}">
                                    <label for="redirection_name_bn">Redirection Name BN</label>
                                    <input class="form-control" name="redirection_name_bn" id="redirection_name_bn"
                                           value="{{ old("redirection_name_bn") ? old("redirection_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirection_name_bn'))
                                        <div class="help-block">{{ $errors->first('redirection_name_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('redirection_deeplink') ? ' error' : '' }}">
                                    <label for="redirection_deeplink">Redirection Deeplink</label>
                                    <input class="form-control" name="redirection_deeplink" id="redirection_deeplink"
                                           value="{{ old("redirection_deeplink") ? old("redirection_deeplink") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirection_deeplink'))
                                        <div class="help-block">{{ $errors->first('redirection_deeplink') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="activation_type">Activation Type</label>
                                        <select name="activation_type" class="form-control">
                                            <option value="REGULAR">REGULAR</option>
                                            <option value="SERVICE">SERVICE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tag_bgd_color" class="control-label">Background Color</label>
                                        <input type="color" name="tag_bgd_color" class="form-control" placeholder="Background Color" value="'#000000'" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tag_text_color" class="control-label">Text Color</label>
                                        <input type="color" name="tag_text_color" class="form-control" placeholder="Color" value="'#ffffff'" required>
                                    </div>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="show_timer" value="1" name="show_timer">
                                        <label for="show_timer">Show Timer</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tnc_type">C for T&C</label>
                                        <select name="tnc_type" class="form-control">
                                            <option value="">Select a option</option>
                                            @foreach(config('constants.tnc_types') as $key => $type)
                                            <option value="{{$key}}">{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('service_tags') ? ' error' : '' }}">
                                    <label for="service_tags">Service Tags</label>
                                    <input class="form-control" name="service_tags" id="service_tags"
                                           value="{{ old("service_tags") ? old("service_tags") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('service_tags'))
                                        <div class="help-block">{{ $errors->first('service_tags') }}</div>
                                    @endif
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Service Tags should be Comma-separated value. Example: iscreen,toffee</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>LMS Tier Slab</label>
                                    <input class="form-control" name="lms_tier_slab" id="lms_tier_slab" value="">
                                    <div class="help-block"></div>
                                    @if ($errors->has('lms_tier_slab'))
                                        <div class="help-block">{{ $errors->first('lms_tier_slab') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('service_tags') ? ' error' : '' }}">
                                    <label for="service_tags">Service Tags</label>
                                    <input class="form-control" name="service_tags" id="service_tags"
                                           value="{{ old("service_tags") ? old("service_tags") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('service_tags'))
                                        <div class="help-block">{{ $errors->first('service_tags') }}</div>
                                    @endif
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Service Tags should be Comma-separated value. Example: iscreen,toffee</span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tnc_type">C for T&C</label>
                                        <select name="tnc_type" class="form-control">
                                            <option value="">Select a option</option>
                                            @foreach($tnc_keywords as $key => $type)
                                            <option value="{{$type}}">{{strtoupper($type)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Service Product Image</label>
                                    <input type="file" id="input-file-now" name="service_image_url" class="dropify"/>
                                    @if($errors->has('service_image_url'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('service_image_url') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-12 pl-0"><h5><strong>Product Schedule Settings</strong></h5></div>
                                <div class="form-actions col-md-12 mt-0"></div>
                                <div class="col-md-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_banner_schedule" name="is_banner_schedule">
                                        <label for="is_banner_schedule">Banner Schedule</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_tags_schedule" value="1"
                                               name="is_tags_schedule">
                                        <label for="is_tags_schedule">Tags Schedule</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_visible_schedule" value="1"
                                               name="is_visible_schedule">
                                        <label for="is_visible_schedule">Visibility Schedule</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_pin_to_top_schedule" value="1"
                                               name="is_pin_to_top_schedule">
                                        <label for="is_pin_to_top_schedule">Pin To Top Schedule</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_base_msisdn_group_id_schedule" value="1"
                                               name="is_base_msisdn_group_id_schedule">
                                        <label for="is_base_msisdn_group_id_schedule">Base Msisdn Schedule</label>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-4 schedule_media d-none">
                                    <label>Schedule Product Image</label>
                                    <input type="file" id="input-file-now" name="schedule_media" class="dropify"/>
                                    @if($errors->has('schedule_media'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('schedule_media') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-4 tag_schedule">
                                    <div class="form-group">
                                        <label>Schedule Tags </label>
                                        <select multiple
                                                class="form-control tags"
                                                name="schedule_tags[]">
                                            <option value=""></option>

                                            @foreach ($tags as $key => $tag)
                                                <option
                                                    value="{{ $key }}" {{ old("tags") == $value ? 'selected' : '' }}>  {{$tag}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 schedule_visibility d-none">
                                    <label class="required">Schedule Visibility (show/hide in app)</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="schedule_visibility" value="1" id="show">
                                            <label for="show">Show</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="radio" name="schedule_visibility" value="0" id="hide" checked>
                                            <label for="hide">Hide</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 schedule_pin_to_top d-none">
                                    <label class="required">Schedule Pin To Top Schedule (On/Off)</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="schedule_pin_to_top" value="1" id="show">
                                            <label for="show">On</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="radio" name="schedule_pin_to_top" value="0" id="hide" checked>
                                            <label for="hide">Off</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group col-md-4 mb-2 schedule_base_msisdn_groups d-none">
                                    <label for="schedule_base_msisdn_groups_id">Base Msisdn</label>
                                    <select id="schedule_base_msisdn_groups_id" name="schedule_base_msisdn_groups_id"
                                            class="browser-default custom-select">
                                        <option value="">No Base Msisdn Group Selected</option>
                                        @foreach ($baseMsisdnGroups as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ isset($campaign) && $campaign->base_msisdn_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label small">Start Date</label>
                                                <input class="form-control" id="start_date" name="start_date"
                                                       placeholder="Start Date" autocomplete="on"
                                                       value="{{ old("start_date") ? old("start_date") : '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small">End Date</label>
                                                <input class="form-control" id="end_date" name="end_date"
                                                       placeholder="End Date" autocomplete="off"
                                                       value="{{ old("end_date") ? old("end_date") : '' }}">
                                            </div>
                                        </div>
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
@endsection

@push('style')
    <style>
        .form-group .help-block ul {
            padding-left: 0; !important;
        }
        .error {
            color: red !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="{{asset('app-assets')}}/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(function () {

            $('select[name="special_type"]').select2({
                placeholder: 'Please Select Special Type',
                allowClear: true
            });
            // alert(true)

            $("#commentForm").validate();
            $('.data-section').select2({
                placeholder: 'Please Selcet Product Category',
                maximumSelectionLength: 5,
                allowClear: true
            });
            $('.tags').select2({
                placeholder: 'Please Select Tags',
                maximumSelectionLength: 1
            });
        });

        // Translated
        var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());
        $('#show_from').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 5,
            startDate: '{{date('Y-m-d H:i:s')}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });

        $('#hide_from').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 5,
            endDate: '{{date('Y-m-d H:i:s', strtotime('+ 6 hours'))}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });

        $('#start_date').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 1,
            startDate: '{{date('Y-m-d H:i:s')}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });

        $('#end_date').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 1,
            endDate: '{{date('Y-m-d H:i:s', strtotime('+ 6 hours'))}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });
        $('#show_from').val("");
        $('#hide_from').val("");
        $('#start_date').val("");
        $('#end_date').val("");
        //$('#hide_from').val('');

        $('#show_from,#hide_from,#start_date,#end_date').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $('.dropify').dropify({
            height: 70,
            messages: {
                'default': 'Browse for an Image to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            }
        });



        $('#content_type').on('change', function () {

            let type = $(this).val();
            let offer_types = $('#offer_types');

            let data = `<div class="col-md-4">
                            <div class="form-group package_type">
                                <label class="required">Data Volume</label>
                                <input type="number" class="form-control" name="internet_volume_mb" required>
                                <div class="help-block"></div>
                            </div>
                        </div>`

            let dataUnit = `<div class="form-group col-md-4">
                                    <label class="required">Data Volume Unit</label>
                                    <select class="form-control"
                                            name="data_volume_unit" required>
                                        <option value="">---Select Unit---</option>
                                        <option value="MB">MB</option>
                                        <option value="GB">GB</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>`

            let voiceVol = `<div class="form-group col-md-4">
                                <label class="required">Minute Volume </label>
                                <input type="number" class="form-control" name="minute_volume" required>
                                <div class="help-block"></div>
                            </div>`
            let smsVol = `<div class="form-group col-md-4">
                              <label class="required">SMS Volume </label>
                              <input type="number" class="form-control" name="sms_volume" required>
                                <div class="help-block"></div>
                          </div>`

            let callRate = `<div class="form-group col-md-4">
                              <label class="required">Call Rate</label>
                              <input type="number" class="form-control" name="call_rate" required>
                              <div class="help-block"></div>
                           </div>`


            let callRateUnit = `<div class="form-group col-md-4">
                                  <label class="required">Call Rate Unit</label>
                                  <input class="form-control" name="call_rate_unit" required>
                                  <div class="help-block"></div>
                                </div>`

            let reactivationCallRateUnit = `<div class="form-group col-md-4">
                                  <label>Call Rate Unit</label>
                                  <input class="form-control" name="call_rate_unit">
                                  <div class="help-block"></div>
                                </div>`

            let reactivationCallRate = `<div class="form-group col-md-4">
                              <label>Call Rate</label>
                              <input type="number" class="form-control" name="call_rate">
                              <div class="help-block"></div>
                           </div>`

            let sectionType = `<div class="form-group col-md-4">
                                    <label class="required">Product Categories</label>
                                    <select multiple
                                            class="form-control data-section"
                                            name="offer_section_slug[]" required>
                                        <option value="">Please Select Product Category</option>
                                        @foreach ($internet_categories as $key => $category)
                                           <option value="{{ $key }}">  {{$category}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>`

            offer_types.empty()

            console.log(type)
            if (
                type === 'data' ||
                type === 'volume request' ||
                type === 'volume transfer' ||
                type === 'data loan' ||
                type === 'gift' ||
                type === 'service'
            ) {
                offer_types.append(data + dataUnit + sectionType)
            } else if (type === 'reactivation') {
                offer_types.append(data + dataUnit + voiceVol + reactivationCallRate + reactivationCallRateUnit)
            } else if (type === 'mix' || type === 'recharge_offer') {
                offer_types.append(data + dataUnit + voiceVol + smsVol + sectionType)
            } else if (type === 'voice') {
                offer_types.append(voiceVol + sectionType)
            } else if (type === 'sms') {
                offer_types.append(smsVol)
            } else if (type === 'scr') {
                offer_types.append(callRate + callRateUnit)
            } else if (type === 'ma loan') {
                offer_types.empty()
            }
            $('.data-section').select2({
                placeholder: 'Please Select Product Category',
                maximumSelectionLength: 5,
                allowClear: true
            });
        })

        $('#is_banner_schedule').change(function () {
            if(this.checked) {
                $('.schedule_media').removeClass('d-none');
            } else {
                $('.schedule_media').addClass('d-none');
            }
        });

        $('#is_tags_schedule').change(function () {
            if(this.checked) {
                $('.tag_schedule').removeClass('d-none');
            } else {
                $('.tag_schedule').addClass('d-none');
            }
        });

        $('#is_visible_schedule').change(function () {
            if(this.checked) {
                $('.schedule_visibility').removeClass('d-none');
            } else {
                $('.schedule_visibility').addClass('d-none');
            }
        });

        $('#is_pin_to_top_schedule').change(function () {
            if(this.checked) {
                $('.schedule_pin_to_top').removeClass('d-none');
            } else {
                $('.schedule_pin_to_top').addClass('d-none');
            }
        });

        $('#is_base_msisdn_group_id_schedule').change(function () {
            if(this.checked) {
                $('.schedule_base_msisdn_groups').removeClass('d-none');
            } else {
                $('.schedule_base_msisdn_groups').addClass('d-none');
            }
        });
    </script>
@endpush
