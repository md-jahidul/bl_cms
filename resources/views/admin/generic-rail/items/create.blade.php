@extends('layouts.admin')
@section('title', 'Add Item')
@section('card_name',"Item" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Item</li>
@endsection
@section('action')
    <a href="{{route('generic-rail.items.index',$railId)}}" class="btn btn-info btn-glow px-2">
        Item list
    </a>
    <a href="{{route('generic-rail.index')}}" class="btn btn-primary btn-glow px-2">
        Rail list
    </a>
@endsection

@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                {{--<h4 class="form-section"><i class="la la-paperclip"></i>Add Image to "{{$slider_information->title}}" Slider</h4>--}}
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="card-body">
                        <form novalidate class="form row" action="{{route('generic-rail.items.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" hidden value="{{$railId}}" name="generic_rail_id">
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-12">
                                        <div class="form-group {{ $errors->has('user_type') ? ' error' : '' }}">

                                            <input type="radio" name="user_type" value="all" id="input-radio-15" checked>
                                            <label for="input-radio-15" class="mr-3">All</label>
                                            <input type="radio" name="user_type" value="prepaid" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">Prepaid</label>
                                            <input type="radio" name="user_type" value="postpaid" id="input-radio-17">
                                            <label for="input-radio-17" class="mr-3">Postpaid</label>

                                            @if ($errors->has('user_type'))
                                                <div class="help-block">  {{ $errors->first('user_type') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title_en" class="required">Title English</label>
                                        <input class="form-control"
                                               name="title_en"
                                               id="title_en"
                                               placeholder="Enter English Title"
                                               required>
                                        @if($errors->has('title_en'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title_bn" class="required">Title Bangla</label>
                                        <input class="form-control"
                                               name="title_bn"
                                               id="title_bn"
                                               placeholder="Enter Bangla Title"
                                               required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="icon">Icon</label>
                                        <input class="form-control"
                                               name="icon"
                                               id="icon"
                                               placeholder="Enter Icon url"
                                               >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="deeplink">Deeplink</label>
                                        <input class="form-control"
                                               name="deeplink"
                                               id="deeplink"
                                               placeholder="Enter deeplink"
                                        >
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                        <label for="title" class="">Android Version Code</label>
                                        <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code" value="0-999999999">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('android_version_code'))
                                            <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                        <label for="title" class="">iOS Version Code</label>
                                        <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code" value="0-999999999">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('ios_version_code'))
                                            <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="is_active">Active Status:</label>
                                            <select class="form-control" id="is_active"
                                                    name="status">
                                                <option value="1"> Active</option>
                                                <option value="0" selected>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="is_active">Highlight:</label>
                                            <select class="form-control" id="is_highlight"
                                                    name="is_highlight">
                                                <option value="1"> Active</option>
                                                <option value="0" selected>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="action_div">
                                        @php
                                            $actionList = Helper::navigationActionList();
                                        @endphp

                                        <div class="form-group">
                                            <label>Component Identifier</label>
                                            <select name="component_identifier" class="browser-default custom-select"
                                                    id="component_identifier">
                                                <option value="">Select Action</option>
                                                @foreach ($actionList as $key => $value)
                                                    <option
                                                        value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button style="float: right" type="submit" id="submitForm"
                                                class="btn btn-success round px-2">
                                            <i class="la la-check-square-o"></i> Submit
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

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    {{--        <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>

        $(function () {

            $("input[name=user_type]").click(function () {
                if ($(this).val() === "segment_wise_banner") {
                    $("#BannerSegmentWiseDiv").addClass('show').removeClass('hidden');
                    $("#slider_action").addClass('hidden').removeClass('show');
                } else {
                    $("#BannerSegmentWiseDiv").addClass('hidden').removeClass('show');
                    $("#slider_action").addClass('show').removeClass('hidden');
                }
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
            $(function () {
                var content = "";
                var url_html;
                var product_html;
                var feed_category;
                var parse_data;
                let dial_html, other_attributes = '';
                var js_data = '<?php echo isset($imageInfo) ? json_encode($imageInfo) : null; ?>';

                if (js_data) {
                    parse_data = JSON.parse(js_data);
                    other_attributes = parse_data.other_attributes;
                    if (other_attributes) {
                        content = other_attributes.content;
                    }
                }


                // add dial number
                dial_html = ` <div class="form-group other-info-div">
                                            <label>Dial Number</label>
                                            <input type="text" name="other_attributes" class="form-control" value="${content}" placeholder="Enter Valid Number" required>
                                            <div class="help-block"></div>
                                        </div>`;

                url_html = ` <div class="form-group other-info-div">
                                            <label>Redirect External URL</label>
                                            <input type="text" name="other_attributes" class="form-control" value="${content}" placeholder="Enter Valid URL" required>
                                            <div class="help-block"></div>
                                        </div>`;
                product_html = ` <div class="form-group other-info-div">
                                            <label>Select a product</label>
                                            <select class="product-list form-control"  name="other_attributes" required></select>
                                            <div class="help-block"></div>
                                        </div>`;

                feed_category = ` <div class="form-group other-info-div">
                                    <label>Feed Category</label>
                                    <select class="feed-cat-list form-control" name="other_attributes[feed_cat_slug]" required>
                                        <option value="">---Select Feed Category---</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>`;


                ussd_code = ` <div class="form-group col-md-12 mb-2 other-info-div">
                                        <label for="ussd_code" class="required">USSD Code:</label>
                                        <input
                                            maxlength="16"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="USSD Code is required"
                                            data-validation-maxlength-message="USSD code can not be more then 16 Characters"
                                            value="@if(old('ussd_code')) {{old('ussd_code')}} @endif" required id="ussd_code"
                                            type="text" class="form-control @error('ussd_code') is-invalid @enderror"
                                            placeholder="USSD Code" name="ussd_code">
                                        <small class="text-danger"> @error('ussd_code') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-2 other-info-div">
                                        <label for="message_en" class="required">Message En:</label>
                                        <textarea
                                            maxlength="250"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Message En is required"
                                            data-validation-regex-message="Message En must start with alphabets"
                                            data-validation-maxlength-message="Message can not be more then 250 Characters"
                                            value="@if(old('message_en')) {{old('message_en')}} @endif" required id="message_en"
                                            type="text" class="form-control @error('message') is-invalid @enderror"
                                            placeholder="Message En" name="message_en"> </textarea>
                                        <small class="text-danger"> @error('message_en') {{ $message_en }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-2 other-info-div">
                                        <label for="message_bn" class="required">Message Bn:</label>
                                        <textarea
                                            maxlength="250"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Message Bn is required"
                                            data-validation-regex-message="Message Bn must start with alphabets"
                                            data-validation-maxlength-message="Message can not be more then 250 Characters"
                                            value="@if(old('message_bn')) {{old('message_bn')}} @endif" required id="message_bn"
                                            type="text" class="form-control @error('message_bn') is-invalid @enderror"
                                            placeholder="Message Bn" name="message_bn"> </textarea>
                                        <small class="text-danger"> @error('message_bn') {{ $message_bn }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div> `;


                $('#navigate_action').on('change', function () {
                    let action = $(this).val();
                    console.log(action);
                    if (action == 'DIAL') {
                        $("#append_div").html(dial_html);
                    } else if (action == 'URL') {
                        $("#append_div").html(url_html);
                    } else if (action == 'USSD') {
                        $("#append_div").html(ussd_code);
                    } else if (action === 'FEED_CATEGORY') {
                        $("#append_div").html(feed_category);
                        $.ajax({
                            url: "{{ route('feed.data') }}",
                            type: 'GET',
                            dataType: 'json', // added data type
                            success: function(res) {
                                res.map(function (data) {
                                    $(".feed-cat-list").append("<option value="+data.id+' data-id='+data.data_id+'>'+data.text+"</option>")
                                })
                            }
                        });
                    } else if (action == 'PURCHASE') {
                        $("#append_div").html(product_html);
                        $(".product-list").select2({
                            placeholder: "Select a product",
                            minimumInputLength: 3,
                            allowClear: true,
                            selectOnClose: true,
                            ajax: {
                                url: "{{ route('notification.productlist.dropdown') }}",
                                dataType: 'json',
                                data: function (params) {
                                    var query = {
                                        productCode: params.term
                                    }
                                    // Query parameters will be ?search=[term]&type=public
                                    return query;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data
                                    };
                                }
                            }
                        });
                    } else {
                        $(".other-info-div").remove();
                    }
                })
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
            $("#navigate_action").select2();
        })
    </script>
@endpush
