@extends('layouts.admin')
@section('title', 'Partner Offer Edit')
@section('card_name', 'Partner Offer Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"><strong><a href="{{ url('partners') }}"> Partner List</a></strong></li>
<li class="breadcrumb-item active"><a href="{{ route('partner-offer', [$partnerId, $partnerName]) }}"> Partner Offer
        List</a></li>
<li class="breadcrumb-item active"> Partner Offer Edit</li>
@endsection
@section('action')
<a href="{{ route('partner-offer', [$partnerId, $partnerName]) }}" class="btn btn-warning  btn-glow px-2"><i
        class="la la-list"></i> Cancel </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="menu-title"><strong>{{ ucwords($partnerName) }} offer edit</strong></h4>
                <hr>
                <div class="card-body card-dashboard">
                    <form role="form"
                          action="{{ route('partner_offer_update', [$partnerId, $partnerName, $partnerOffer->id]) }}"
                          method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div id="free_text_value_en"
                                 class="form-group col-md-4 col-xs-12">
                                <label for="offer_unit" class="required">Offer Title EN</label>
                                <input type="text" name="other_attributes[free_text_value_en]" class="form-control" placeholder="Enter any number of text"
                                       value="{{ isset($partnerOffer->other_attributes['free_text_value_en']) ? $partnerOffer->other_attributes['free_text_value_en'] : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('free_text_value'))
                                    <div class="help-block">{{ $errors->first('free_text_value') }}</div>
                                @endif
                            </div>

                            <div id="free_text_value_bn"
                                 class="form-group col-md-4 col-xs-12">
                                <label for="offer_unit" class="required">Offer Title BN</label>
                                <input type="text" name="other_attributes[free_text_value_bn]" class="form-control" placeholder="Enter any number of text"
                                       value="{{ isset($partnerOffer->other_attributes['free_text_value_bn']) ? $partnerOffer->other_attributes['free_text_value_bn'] : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('free_text_value'))
                                    <div class="help-block">{{ $errors->first('free_text_value') }}</div>
                                @endif
                            </div>

                            <input type="hidden" name="campaign_redirect" value="{{ isset($campaignPath) ? $campaignPath : '' }}">
{{--                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('product_code') ? ' error' : '' }}">--}}
{{--                                <label for="product_code" class="">Product Code</label>--}}
{{--                                <input type="text" class="form-control" placeholder="Enter offer validity in English" readonly--}}
{{--                                       value="{{ $partnerOffer->product_code }}" >--}}
{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('product_code'))--}}
{{--                                <div class="help-block">{{ $errors->first('product_code') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

                             <div class="form-group col-md-4 col-xs-12 {{ $errors->has('area') ? ' error' : '' }}">
                                <label for="offer_unit" class="required">Area</label>
                                <select class="form-control required" name="area_id"
                                        required data-validation-required-message="Please select area">
                                    <option value="">---Select Offer Area---</option>
                                    @foreach($areas as $val)
                                    <option {{$partnerOffer->area_id == $val->id ? 'selected' : ''}} value="{{$val->id}}">{{$val->area_en}}</option>
                                    @endforeach

                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('area_id'))
                                <div class="help-block">{{ $errors->first('area_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('partner_category_id') ? ' error' : '' }}">
                                <label for="offer_unit" class="required">Categories</label>
                                <select class="form-control required" name="partner_category_id"
                                        required data-validation-required-message="Please select area">
                                    <option value="">---Select Categories---</option>
                                    @foreach($categories as $val)
                                        <option {{$partnerOffer->partner_category_id == $val->id ? 'selected' : ''}} value="{{$val->id}}">{{$val->name_en}}</option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('partner_category_id'))
                                    <div class="help-block">{{ $errors->first('partner_category_id') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('loyalty_tier_id') ? ' error' : '' }}">
                                <label for="offer_unit" class="required">Tier</label>
                                <select class="form-control required" name="loyalty_tier_id"
                                        required data-validation-required-message="Please select area">
                                    <option value="">---Select Tier---</option>
                                    @foreach($tiers as $val)
                                        <option {{$partnerOffer->loyalty_tier_id == $val->id ? 'selected' : ''}} value="{{$val->id}}">{{$val->title_en}}</option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('loyalty_tier_id'))
                                    <div class="help-block">{{ $errors->first('loyalty_tier_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('validity_en') ? ' error' : '' }}">
                                <label for="validity_en" class="required">Offer Validity (English)</label>
                                <input type="text" name="validity_en" class="form-control"
                                       placeholder="Enter offer validity in English"
                                       value="{{ $partnerOffer->validity_en }}" required
                                       data-validation-required-message="Enter offer validity in English">
                                <div class="help-block"></div>
                                @if ($errors->has('validity_en'))
                                <div class="help-block">{{ $errors->first('validity_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('validity_bn') ? ' error' : '' }}">
                                <label for="validity_bn" class="required">Offer Validity (Bangla)</label>
                                <input type="text" name="validity_bn" class="form-control"
                                       placeholder="Enter offer validity in Bangla"
                                       value="{{ $partnerOffer->validity_bn }}" required
                                       data-validation-required-message="Enter offer validity in Bangla">
                                <div class="help-block"></div>
                                @if ($errors->has('validity_bn'))
                                <div class="help-block">{{ $errors->first('validity_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('start_date') ? ' error' : '' }}">
                                <label for="start_date" class="">Start Date</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" name="start_date" id="start_date"
                                           value="{{ $partnerOffer->start_date }}"

                                           placeholder="Please select start date"/>
                                </div>
                                <div class="help-block"></div>
                                @if ($errors->has('start_date'))
                                <div class="help-block">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('end_date') ? ' error' : '' }}">
                                <label for="end_date">End Date</label>
                                <input type="text" name="end_date" id="end_date" class="form-control"
                                       placeholder="Please select end date"
                                       value="{{ $partnerOffer->end_date }}" autocomplete="off">
                                <div class="help-block"></div>
                                @if ($errors->has('end_date'))
                                <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>

{{--                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('offer_scale') ? ' error' : '' }}">--}}
{{--                                <label for="offer_scale" class="required">Offer Scale</label>--}}
{{--                                <select class="form-control required" name="offer_scale" id="offer_scale"--}}
{{--                                        required data-validation-required-message="Please select offer scale">--}}
{{--                                    <option data-alias="" value="">---Select Offer Type---</option>--}}
{{--                                    <option value="Upto" {{ ($partnerOffer->offer_scale == "Upto") ? 'selected' : "" }}>Upto</option>--}}
{{--                                    <option value="Minimum" {{ ($partnerOffer->offer_scale == "Minimum") ? 'selected' : "" }}>Minimum</option>--}}
{{--                                    <option value="Fixed" {{ ($partnerOffer->offer_scale == "Fixed") ? 'selected' : "" }}>Fixed</option>--}}
{{--                                    <option value="free_text" {{ ($partnerOffer->offer_scale == "free_text") ? 'selected' : "" }}>Free Text</option>--}}
{{--                                </select>--}}
{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('offer_scale'))--}}
{{--                                <div class="help-block">{{ $errors->first('offer_scale') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <div id="offer_value" class="form-group col-md-4 col-xs-12 {{ $partnerOffer->offer_scale == "free_text" ? 'hidden' : '' }}">--}}
{{--                                <label for="offer_value" class="required">Offer Value</label>--}}
{{--                                <input type="number" name="offer_value"  class="form-control" placeholder="Enter offer percentage in English"--}}
{{--                                       value="{{ $partnerOffer->offer_value }}">--}}
{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('offer_value'))--}}
{{--                                <div class="help-block">  {{ $errors->first('offer_value') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <div id="offer_unit" class="form-group col-md-4 col-xs-12 {{ $partnerOffer->offer_scale == "free_text" ? 'hidden' : '' }}">--}}
{{--                                <label for="offer_unit" class="required">Offer Unit</label>--}}
{{--                                <select class="form-control required" name="offer_unit" id="offer_unit">--}}
{{--                                    <option data-alias="" value="">---Select Offer Unit---</option>--}}
{{--                                    <option value="Percentage" {{ ($partnerOffer->offer_unit == "Percentage") ? 'selected' : "" }}>Percentage</option>--}}
{{--                                    <option value="Taka" {{ ($partnerOffer->offer_unit == "Taka") ? 'selected' : "" }}>Taka</option>--}}
{{--                                </select>--}}
{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('offer_unit'))--}}
{{--                                <div class="help-block">{{ $errors->first('offer_unit') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

                            <div class="form-group col-md-3 col-xs-12 {{ $errors->has('get_offer_msg_en') ? ' error' : '' }}">
                                <label for="get_offer_msg_en" class="required">Subscription SMS Info (English)</label>
                                <textarea type="text" name="get_offer_msg_en" class="form-control summernote_editor"
                                       placeholder="Enter get send SMS text in English" required
                                       data-validation-required-message="Enter get send SMS text in English">{{ $partnerOffer->get_offer_msg_en }}</textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('get_offer_msg_en'))
                                    <div class="help-block">  {{ $errors->first('get_offer_msg_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 col-xs-12 {{ $errors->has('get_offer_msg_bn') ? ' error' : '' }}">
                                <label for="get_offer_msg_bn" class="required">Subscription SMS Info (Bangla)</label>
                                <textarea type="text" name="get_offer_msg_bn" class="form-control summernote_editor"
                                       placeholder="Enter get send SMS text in Bangla" required
                                       data-validation-required-message="Enter get send SMS text in Bangla">{{ $partnerOffer->get_offer_msg_bn }}</textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('get_offer_msg_bn'))
                                <div class="help-block">  {{ $errors->first('get_offer_msg_bn') }}</div>
                                @endif
                            </div>
                            <?php
                                $location = json_decode($partnerOffer->location);
                            ?>
                            <div class="form-group col-md-3 col-xs-12">
                                <label>Location (EN)</label>
                                <textarea type="text" name="location[en]"
                                          class="form-control summernote_editor" placeholder="Enter Location EN">{{!empty($location) ? $location->en : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-3 col-xs-12">
                                <label>Location (BN)</label>
                                <textarea type="text" name="location[bn]" class="form-control summernote_editor" placeholder="Enter Location BN"
                                >{{!empty($location) ? $location->bn : ''}}</textarea>
                            </div>


                            <?php
                                $phone = json_decode($partnerOffer->phone);
                            ?>
                            <div class="form-group col-md-4 col-xs-12">
                                <label>Phone (EN)</label>
                                <input type="text" name="phone[en]" value="{{!empty($phone) ? $phone->en : ''}}"  class="form-control" placeholder="Enter Phone EN">
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label>Phone (BN)</label>
                                <input type="text" name="phone[bn]" value="{{!empty($phone) ? $phone->bn : ''}}"  class="form-control" placeholder="Enter Phone BN">
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label>Map Link</label>
                                <input type="text" name="map_link"  class="form-control" value='{{$partnerOffer->map_link}}' placeholder="Enter Map Link">
                            </div>

                            <div class="form-group col-md-6 col-xs-12 {{ $errors->has('btn_text_en') ? ' error' : '' }}">
                                <label for="btn_text_en" class="required">Button Label (English)</label>
                                <input type="text" name="btn_text_en" class="form-control"
                                       placeholder="Enter button label in English"
                                       value="{{ $partnerOffer->btn_text_en }}" required
                                       data-validation-required-message="Enter button label in English">
                                <div class="help-block"></div>
                                @if ($errors->has('btn_text_en'))
                                <div class="help-block">  {{ $errors->first('btn_text_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 col-xs-12 {{ $errors->has('btn_text_bn') ? ' error' : '' }}">
                                <label for="btn_text_bn" class="required">Button Label (Bangla)</label>
                                <input type="text" name="btn_text_bn" class="form-control"
                                       placeholder="Enter button label in Bangla"
                                       value="{{ $partnerOffer->btn_text_bn }}" required
                                       data-validation-required-message="Enter button label in Bangla">
                                <div class="help-block"></div>
                                @if ($errors->has('btn_text_bn'))
                                <div class="help-block">  {{ $errors->first('btn_text_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 col-xs-12 {{ $errors->has('card_img') ? ' error' : '' }}">
                                <label for="card_img">Card Image</label>
                                <input type="file" id="card_img" name="card_img" class="dropify_image"
                                       data-default-file="{{ isset($partnerOffer->card_img) ?  config('filesystems.file_base_url') . $partnerOffer->card_img : null }}"/>
                                <div class="help-block"></div>
                                @if ($errors->has('card_img'))
                                    <div class="help-block">  {{ $errors->first('card_img') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                <label for="alt_text">Search Special Keyword En</label>
                                <textarea name="tag_en" id="tag_en" class="form-control" rows="4"
                                          placeholder="Enter keywords en"
                                >{{ $partnerOffer->searchableFeature->tag_en ?? '' }}</textarea>
                                <small class="warning"><strong>Example: Internet Packs, Tier Based Tenure, Eligible Customers, Point Status</strong></small>
                                <div class="help-block"></div>
                                @if ($errors->has('tag_en'))
                                    <div class="help-block">{{ $errors->first('tag_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                <label for="alt_text">Search Special Keyword Bn</label>
                                <textarea type="text" name="tag_bn" id="alt_text" class="form-control" rows="4"
                                          placeholder="Enter keywords bn">{{ $partnerOffer->searchableFeature->tag_bn ?? '' }}</textarea>
                                <small class="warning"><strong>Example: পয়েন্ট স্ট্যাটাস, টিয়ার সিস্টেম, অরেঞ্জ ক্লাব এর সদস্য</strong></small>
                                <div class="help-block"></div>
                                @if ($errors->has('tag_bn'))
                                    <div class="help-block">{{ $errors->first('tag_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{ isset($partnerOffer->page_header) ? $partnerOffer->page_header : null }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($partnerOffer->page_header_bn) ? $partnerOffer->page_header_bn : null }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{ isset($partnerOffer->schema_markup) ? $partnerOffer->schema_markup : null }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                <label> URL (url slug) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('url_slug_bn') ? old('url_slug_bn') : $partnerOffer->url_slug }}" required
                                       name="url_slug" placeholder="URL">
                                <div class="help-block"></div>
                                <small class="text-info">
                                    <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
                                </small>
                                @if ($errors->has('url_slug'))
                                    <div class="help-block">  {{ $errors->first('url_slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                <label> URL Bangla (url slug) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $partnerOffer->url_slug_bn }}"
                                       name="url_slug_bn" placeholder="URL">
                                <div class="help-block"></div>
                                <small class="text-info">
                                    <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
                                </small>
                                @if ($errors->has('url_slug_bn'))
                                    <div class="help-block">{{ $errors->first('url_slug_bn') }}</div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="show_in_home" class="display-block">For:</label>
                                    <input type="checkbox" name="silver" {{ $partnerOffer->silver == 1 ? 'checked' : '' }} value="1"> Silver <br>
                                    <input type="checkbox" name="gold" {{ $partnerOffer->gold == 1 ? 'checked' : '' }} value="1"> Gold <br>
                                    <input type="checkbox" name="platium" {{ $partnerOffer->platium == 1 ? 'checked' : '' }} value="1"> Platinum
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required mr-1">Status:</label>
                                    <input type="radio" name="is_active" value="1"
                                           id="active" {{ ($partnerOffer->is_active == 1) ? 'checked' : '' }}>
                                    <label for="active" class="mr-1">Active</label>
                                    <input type="radio" name="is_active" value="0"
                                           id="inactive" {{ ($partnerOffer->is_active == 0) ? 'checked' : '' }}>
                                    <label for="inactive">Inactive</label>
                                </div>
                            </div>

                            <div class="col-md-4 pr-0 pt-1">
                                <div class="form-group">
                                    <label for="" class="mr-1">Home Show:</label>
                                    <input type="checkbox" name="show_in_home" {{ ($partnerOffer->show_in_home == 1) ? 'checked' : "" }} value="1">
                                </div>
                            </div>

{{--                            <div class="col-md-2 pt-1">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="is_campaign" class="mr-1">Is Campaign:</label>--}}
{{--                                    <input type="checkbox" name="is_campaign" value="1"--}}
{{--                                           id="is_campaign" {{ ($partnerOffer->is_campaign == 1) ? 'checked' : "" }}>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="campaign_img"></label>--}}
{{--                                <div class="custom-file {{ ($partnerOffer->is_campaign == 1) ? '' : "d-none" }}">--}}
{{--                                    <input type="file" name="campaign_img" class="custom-file-input" id="image">--}}
{{--                                    <label class="custom-file-label" for="inputGroupFile01">Please Choose Campaign--}}
{{--                                        Image</label>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
{{--                                </div>--}}
{{--                                <div class="help-block">--}}
{{--                                    <ul role="alert" class="d-none text-danger" id="imgRequired">--}}
{{--                                        <li>Please Choose Campaign Image</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                @if ($errors->has('campaign_img'))--}}
{{--                                <div class="help-block">  {{ $errors->first('campaign_img') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

                            <div class="form-group col-md-1 mb-0 {{ ($partnerOffer->is_campaign == 1) ? '' : "d-none" }}"
                                 id="showImg">
                                <img width="140" height="80" id="imgDisplay"
                                     src="{{ ($partnerOffer->campaign_img != '') ? config('filesystems.file_base_url') . $partnerOffer->campaign_img : config('filesystems.file_base_url'). 'assetlite/images/campaign-image/campaign-placeholder.png' }}">
                            </div>

                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
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
<script src="{{ asset('js/custom-js/offer.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        var date = new Date();
        date.setDate(date.getDate());
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            showClose: true,
        });
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false, //Important! See issue #1075
            showClose: true,
        });

        // $("#offer_scale").change(function () {
        //     let offerScale = $(this).val();
        //     if (offerScale === "free_text") {
        //         $('#offer_unit').addClass('hidden')
        //         $('#offer_value').addClass('hidden')
        //         $('#free_text_value_en').removeClass('hidden')
        //         $('#free_text_value_bn').removeClass('hidden')
        //     } else {
        //         $('#offer_unit').removeClass('hidden')
        //         $('#offer_value').removeClass('hidden')
        //         $('#free_text_value_en').addClass('hidden')
        //         $('#free_text_value_bn').addClass('hidden')
        //     }
        // })

        $('.dropify_image').dropify({
            messages: {
                'default': 'Browse for an Image File to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            },
            error: {
                'imageFormat': 'The image must be valid format'
            },
            height: 100
        });
    });
</script>
@endpush







