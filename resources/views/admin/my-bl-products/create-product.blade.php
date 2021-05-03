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
        Back To Product List GGG
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
                                        <option value="ma loan">MA LOAN</option>
                                        <option value="data loan">DATA LOAN</option>
                                        <option value="gift">GIFT</option>
                                        <option value="volume request">VOLUME REQUEST</option>
                                        <option value="volume transfer">VOLUME TRANSFER</option>
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
                                           data-validation-required-message="Please enter product code">
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('name') ? ' error' : '' }}">
                                        <label for="name" class="required">Title</label>
                                        <input class="form-control" name="name" required id="name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('commercial_name_en') ? ' error' : '' }}">
                                    <label for="name" class="required">Commercial Name En</label>
                                    <input class="form-control" name="commercial_name_en" required id="name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_en'))
                                        <div class="help-block">{{ $errors->first('commercial_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('commercial_name_bn') ? ' error' : '' }}">
                                    <label for="name" class="required">Commercial Name Bn</label>
                                    <input class="form-control" name="commercial_name_bn" required id="name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_bn'))
                                        <div class="help-block">{{ $errors->first('commercial_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Display Title En</label>
                                    <input class="form-control" name="display_title_en">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Display Title Bn</label>
                                    <input class="form-control" name="display_title_bn">
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
                                        <input class="form-control" name="short_description" required>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_description'))
                                        <div class="help-block">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('display_sd_vat_tax') ? ' error' : '' }}">
                                    <label>Display SD Vat Tax</label>
                                    <input class="form-control" name="display_sd_vat_tax">
                                    <div class="help-block"></div>
                                    @if ($errors->has('display_sd_vat_tax'))
                                        <div class="help-block">{{ $errors->first('display_sd_vat_tax') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('points') ? ' error' : '' }}">
                                    <label>Points</label>
                                    <input type="number" class="form-control" name="points">
                                    <div class="help-block"></div>
                                    @if ($errors->has('points'))
                                        <div class="help-block">{{ $errors->first('points') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MRP Price</label>
                                        <input class="form-control" name="mrp_price">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input class="form-control" name="price">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vat</label>
                                        <input type="text" step="0.001" class="form-control" name="vat"
                                               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));">
                                    </div>
                                </div>

                                <slot id="offer_types"></slot>

                                <div class="form-group col-md-4 {{ $errors->has('validity') ? ' error' : '' }}">
                                    <label class="required">Validity </label>
                                    <input type="number" class="form-control" required name="validity">
                                    <div class="help-block"></div>
                                    @if ($errors->has('validity'))
                                        <div class="help-block">{{ $errors->first('validity') }}</div>
                                    @endif
                                </div>

                                @php
                                    $validityUnits = [/*'hour', 'hours', */'day', 'days'];
                                @endphp

                                <div class="form-group col-md-4 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
                                    <label for="duration_category_id" class="validity_unit required">Validity Unit</label>
                                    <select class="form-control required duration_categories" name="validity_unit"
                                            id="validity_unit" required>
                                        <option value="">---Select Validity Unit---</option>
                                        @foreach($validityUnits as $value)
                                            <option value="{{ $value }}">{{ ucfirst($value) }}</option>
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
                                        <input class="form-control" name="auto_renew_code">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Recharge Product Code</label>
                                        <input class="form-control" name="recharge_product_code">
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
                                        {{--                                        @php--}}
                                        {{--                                            $thisProductTags = $details->tags->pluck('id')->toArray() ?? [];--}}
                                        {{--                                        @endphp--}}
                                        <select multiple
                                                class="form-control tags"
                                                name="tags[]">
                                            <option value=""></option>

                                            @foreach ($tags as $key => $tag)
                                                <option
                                                    {{--                                                    {{ in_array($key, $thisProductTags, false) ? 'selected' : '' }}--}}
                                                    value="{{ $key }}">  {{$tag}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Schedule Availability </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label small">Show From</label>
                                                <input class="form-control" id="show_from" name="show_from" value=""
                                                       placeholder="Show From Time" autocomplete="on">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small">Hide From</label>
                                                <input class="form-control" id="hide_from" name="hide_from"
                                                       placeholder="Hide From Time" autocomplete="off">
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

                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="show_in_home" value="1" name="show_in_app">
                                        <label for="show_in_home">Show in Home</label>
                                    </fieldset>
                                </div>

                                <div class="col-md-3 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_rate_cutter_offer" value="1"
                                               name="is_rate_cutter_offer">
                                        <label for="is_rate_cutter_offer">Is Rate Cutter offer</label>
                                    </fieldset>
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

            $("#commentForm").validate();

            $('.data-section').select2({
                placeholder: 'Please Select Data Section',
                maximumSelectionLength: 5,
                allowClear: true
            });

            $('.tags').select2({
                placeholder: 'Please Select Tags',
                maximumSelectionLength: 3
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
        $('#show_from').val("");
        $('#hide_from').val("");
        //$('#hide_from').val('');

        $('#show_from,#hide_from').on('cancel.daterangepicker', function (ev, picker) {
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
                                <label class="required">Data Volume (MB)</label>
                                <input type="number" class="form-control" name="internet_volume_mb" required>
                                <div class="help-block"></div>
                            </div>
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

            let sectionType = `<div class="form-group col-md-4">
                                    <label class="required">Select Data Section</label>
                                    <select multiple
                                            class="form-control data-section"
                                            name="offer_section_slug[]" required>
                                        <option value="">Please Select Data Section</option>
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
                type === 'gift'
            ) {
                offer_types.append(data + sectionType)
            } else if (type === 'mix' || type === 'recharge_offer') {
                offer_types.append(data + voiceVol + smsVol)
            } else if (type === 'voice') {
                offer_types.append(voiceVol)
            } else if (type === 'sms') {
                offer_types.append(smsVol)
            } else if (type === 'scr') {
                offer_types.append(callRate + callRateUnit)
            } else if (type === 'ma loan') {
                offer_types.empty()
            }

            $('.data-section').select2({
                placeholder: 'Please Select Data Section',
                maximumSelectionLength: 5,
                allowClear: true
            });
        })

    </script>
@endpush
