@php
    function match($slug, $multiItems){
        foreach ($multiItems as $item){
           if($item->offer_section_slug == $slug){
              return true;
           }
         }
        return false;
     }
@endphp

@extends('layouts.admin')
@section('title', 'Mybl Products')

@section('card_name', "Product Details")

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
                    <h5 class="menu-title"><strong> Product Details Info</strong></h5><hr>
                    <div class="card-body card-dashboard">
                    <form class="form"
                          action="{{ route('mybl.product.update',  $details->details->product_code )}}"
                          enctype="multipart/form-data"
                          method="POST"
                          novalidate>
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sim_type">Connection Type</label>
                                        <input class="form-control"
                                               value="@if($details->details->sim_type == 1) PREPAID @else POSTPAID @endif"
                                               disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="content_type">Content Type</label>
                                        <input class="form-control"
                                               value="{{ ucfirst($details->details->content_type) }}"
                                               disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('product_code') ? ' error' : '' }}">
                                        <label for="product_code">Product Code</label>
                                        <input type="hidden" class="form-control" name="mybl_product_id" value="{{ $details->id }}">
                                        <input class="form-control" name="product_code" value="{{ $details->details->product_code }}" readonly>
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="required">Name</label>
                                        <input class="form-control" value="{{ $details->details->name }}" name="name"
                                               id="name" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('commercial_name_en') ? ' error' : '' }}">
                                    <label for="name" class="required">Commercial Name En</label>
                                    <input class="form-control" name="commercial_name_en" required id="name"
                                           value="{{ $details->details->commercial_name_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_en'))
                                        <div class="help-block">{{ $errors->first('commercial_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('commercial_name_bn') ? ' error' : '' }}">
                                    <label for="name" class="required">Commercial Name Bn</label>
                                    <input class="form-control" name="commercial_name_bn" required id="name"
                                           value="{{ $details->details->commercial_name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('commercial_name_bn'))
                                        <div class="help-block">{{ $errors->first('commercial_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Display Title En</label>
                                    <input class="form-control" name="display_title_en"
                                           value="{{ $details->details->display_title_en }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Display Title Bn</label>
                                    <input class="form-control" name="display_title_bn"
                                           value="{{ $details->details->display_title_bn }}">
                                    <div class="help-block"></div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="required">Short Description</label>
                                        <input class="form-control" value="{{ $details->details->short_description }}"
                                               name="short_description" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('display_sd_vat_tax') ? ' error' : '' }}">
                                    <label>Display SD Vat Tax</label>
                                    <input class="form-control" name="display_sd_vat_tax"
                                           value="{{ $details->details->display_sd_vat_tax }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('display_sd_vat_tax'))
                                        <div class="help-block">{{ $errors->first('display_sd_vat_tax') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('points') ? ' error' : '' }}">
                                    <label>Points</label>
                                    <input type="number" class="form-control" name="points"
                                           value="{{ $details->details->points }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('points'))
                                        <div class="help-block">{{ $errors->first('points') }}</div>
                                    @endif
                                </div>

{{--                                @if( $details->details->activation_ussd)--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Activation USSD </label>--}}
{{--                                            <input class="form-control"--}}
{{--                                                   value="{{ $details->details->activation_ussd }}"--}}
{{--                                                   name="activation_ussd">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                @if( $details->details->balance_check_ussd)--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Balance USSD</label>--}}
{{--                                            <input class="form-control"--}}
{{--                                                   value="{{ $details->details->balance_check_ussd }}"--}}
{{--                                                   name="balance_check_ussd">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MRP Price</label>
                                        <input class="form-control" value="{{ $details->details->mrp_price }}"
                                               name="mrp_price">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input class="form-control" name="price"
                                               value="{{ $details->details->price }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vat</label>
                                        <input class="form-control" name="vat"
                                        value="{{ $details->details->vat }}">
                                    </div>
                                </div>

                                @if($details->details->data_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">Data Volume</label>
                                            <input class="form-control"
                                                   value="{{ $details->details->data_volume }}"
                                                   name="internet_volume_mb" required>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">Data Volume Unit</label>
                                            <select class="form-control" name="data_volume_unit" required>
                                                <option value="">--Select Unit--</option>
                                                <option {{ ($details->details->data_volume_unit == "MB" ) ? 'selected' : '' }} value="MB">MB</option>
                                                <option {{ ($details->details->data_volume_unit == "GB" ) ? 'selected' : '' }} value="GB">GB</option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                @endif

                                @if($details->details->minute_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">Minute Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->minute_volume }}"
                                                   name="minute_volume" required>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                @endif

                                @if($details->details->sms_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">SMS Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->sms_volume }} SMS" name="sms_volume" required>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                @endif
                                @if($details->details->sms_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">SMS Volume </label>
                                            <input class="form-control" value="{{ $details->details->sms_volume }} SMS" required>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                @endif
                                @if(strtolower($details->details->content_type) == 'scr')
                                    <div class="form-group col-md-4">
                                        <label class="required">Call Rate</label>
                                        <input type="number" class="form-control" name="call_rate" required
                                               value="{{ $details->details->call_rate }}">
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="required">Call Rate Unit</label>
                                        <input class="form-control" name="call_rate_unit" required
                                               value="{{ $details->details->call_rate_unit }}">
                                        <div class="help-block"></div>
                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="required">Validity </label>
                                        <input class="form-control"
                                               value="{{ $details->details->validity }}"
                                               name="validity" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                @php
                                    $validityUnits = ['hours', 'days'];
                                @endphp

                                <div class="form-group col-md-4 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
                                    <label for="duration_category_id" class="validity_unit required">Validity Unit</label>
                                    <select class="form-control required duration_categories" name="validity_unit" id="validity_unit" required>
                                        <option value="">---Select Validity Unit---</option>
                                        @foreach($validityUnits as $value)
                                            <option value="{{ $value }}" {{ $value == strtolower($details->details->validity_unit) ? 'selected' : '' }}>{{ ucfirst($value) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('duration_category_id'))
                                        <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Recharge Product Code</label>
                                        <input class="form-control" name="recharge_product_code"
                                               value="{{ $details->details->recharge_product_code }}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Auto Renewable Code</label>
                                        <input class="form-control" name="renew_product_code"
                                               value="{{ $details->details->renew_product_code }}"
                                               >
                                    </div>
                                </div>

{{--                                {{ dd($details->details->content_type) }}--}}
                                @if(  $details->details->content_type == 'data' ||
                                      $details->details->content_type == 'mix' ||
                                      $details->details->content_type == 'data loan' ||
                                      $details->details->content_type == 'mix' ||
                                      $details->details->content_type == 'gift' ||
                                      $details->details->content_type == 'voice' ||
                                      $details->details->content_type == 'volume transfer'
                                    )
                                    @php
                                        $tabs = $details->detailTabs->pluck('id')->toArray() ?? [];
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Categories</label>
                                            <select multiple
                                                    class="form-control data-section"
                                                    name="offer_section_slug[]" required>
                                                <option value="">Please Select Product Category</option>

                                                @foreach ($internet_categories as $key => $category)
                                                    <option
                                                        {{ in_array($key, $tabs, false) ? 'selected' : '' }}
                                                        value="{{ $key }}">  {{$category}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tags </label>
                                        @php
                                            $thisProductTags = $details->tags->pluck('id')->toArray() ?? [];
                                        @endphp
                                        <select multiple class="form-control tags" name="tags[]">
                                            <option value=""></option>
                                            @foreach ($tags as $key => $tag)
                                                <option {{ in_array($key, $thisProductTags, false) ? 'selected' : '' }}
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
                                                <input class="form-control" id="show_from" name="show_from"
                                                       placeholder="Show From Time" autocomplete="off">
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

                                <div class="col-md-4">
                                    <label>Product Image</label>
                                    <div class="form-group mb-0">
                                        @if($errors->has('media'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('media') }}</small>
                                            </p>
                                        @endif
                                        @if ($details->media)
                                            <input type="file"
                                                   id="input-file-now-custom-1"
                                                   class="dropify"
                                                   name="media"
                                                   data-default-file="{{ url('storage/' .$details->media) }}"/>
                                        @else
                                            <input type="file" id="input-file-now" name="media" class="dropify"/>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Visibility (show/hide in app)</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="is_visible" id="show"
                                                   value="1" {{$details->is_visible ? 'checked' : ''}}>
                                            <label for="show">Show</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="radio" name="is_visible" id="hide"
                                                   value="0" {{$details->is_visible ? '' : 'checked'}}>
                                            <label for="hide">Hide</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="show_in_home" value="1" name="show_in_app"
                                               @if($details->show_in_home) checked @endif>
                                        <label for="show_in_home">Show in Home</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="pin_to_top" value="1" name="pin_to_top"
                                               @if($details->pin_to_top) checked @endif
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
                                <div class="col-md-3 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_rate_cutter_offer" value="1"
                                               name="is_rate_cutter_offer"
                                               @if($details->is_rate_cutter_offer) checked @endif>
                                        <label for="show_in_home">Is Rate Cutter offer</label>
                                    </fieldset>
                                </div>

                                <div class="form-group col-md-8 mb-2" id="cta_action">
                                    <label for="base_msisdn_groups_id">Base Msisdn</label>
                                    <select id="base_msisdn_groups_id" name="base_msisdn_group_id"
                                            class="browser-default custom-select">
                                        <option value="">No Base Msisdn Group Selected</option>
                                        @foreach ($baseMsisdnGroups as $key => $value)
                                            <option value="{{ $value->id }}" {{ $value->id == $details->base_msisdn_group_id ? 'selected' : '' }}>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-warning"><strong><i class="la la-warning"></i> Warning:</strong> If you don't select a base group, this product is available for connection type-wise users</span>
                                    <div class="help-block"></div>
                                </div>

                                {{--                                <div class="col-md-4">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <button type="submit" class="btn btn-info btn-block">--}}
                                {{--                                            <i class="ft-save"></i> Update--}}
                                {{--                                        </button>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button id="save" class="btn btn-primary"><i
                                                class="la la-refresh"></i> Update
                                        </button>
                                    </div>
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
    <script>
        $(function () {
            $('.data-section').select2({
                placeholder: 'Please Select Product Category',
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
        $('#show_from').val("{{$details->show_from ? \Carbon\Carbon::parse($details->show_from)->format('Y/m/d h:i A') : ''}}");
        $('#hide_from').val("{{$details->hide_from ? \Carbon\Carbon::parse($details->hide_from)->format('Y/m/d h:i A') : ''}}");
        //$('#hide_from').val('');

        $('#show_from,#hide_from').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });


        $(function() {
            // $('.dropify').dropify({ height: 100 });
            // Used events
            var drEvent = $('.dropify').dropify({ height: 100 });
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                $.ajax({
                    url: "{{ route('product.img.remove', $details->id)}}",
                    type: 'Get',
                    success: function (result) {
                        if (result.status === "success") {
                            swal.fire({
                                title: result.massage,
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            console.log(result.massage)
                            swal.close();
                            swal.fire({
                                title: "Something went wrong",
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed to sync',
                            type: 'error',
                        });
                    }
                });
            });
        });





        $('#remove-img').click(function (e) {
            e.preventDefault();

            $('.dropify').dropify().resetPreview();
            alert('ok')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('#syncBtn').html(),
                showCancelButton: true,
                confirmButtonText: 'Yes, Sync it!'
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: 'Data Processing. Please Wait...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });


                }
            });

        });

    </script>
@endpush
