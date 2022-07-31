@extends('layouts.admin')
@section('title', 'Add Image')
@section('card_name',"Add Image" )


@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <h4 class="form-section"><b>Redeem Details</b></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="row mb-1">
                    <div class="form-group col-md-6 mb-2">
                        <label for="redeem_title_en" class="required">Redeem Title EN:</label>
                        <input readonly
                               maxlength="200"
                               data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                               data-validation-required-message="Title is required"
                               data-validation-regex-message="Title must start with alphabets"
                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                               value="{{isset($redeemDetail->redeem_title_en) ? $redeemDetail->redeem_title_en : ""}}" required id="redeem_title_en"
                               type="text" class="form-control @error('redeem_title_en') is-invalid @enderror"
                               placeholder="Enter Redeem Title BN" name="redeem_title_en">
                        <small class="text-danger"> @error('redeem_title_en') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="redeem_title_bn" class="required">Redeem Title BN:</label>
                        <input readonly
                               maxlength="200"
                               data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                               data-validation-required-message="Title is required"
                               data-validation-regex-message="Title must start with alphabets"
                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                               value="{{isset($redeemDetail->redeem_title_bn) ? $redeemDetail->redeem_title_bn : ""}}" required id="redeem_title_bn"
                               type="text" class="form-control @error('redeem_title_bn') is-invalid @enderror"
                               placeholder="Enter Redeem Title EN" name="redeem_title_bn">
                        <small class="text-danger"> @error('redeem_title_bn') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="btn_text_en" class="required">Button Text EN:</label>
                        <input readonly
                               value="{{isset($redeemDetail->btn_text_en) ? $redeemDetail->btn_text_en : "" }}" required id="btn_text_en"
                               type="text" class="form-control @error('btn_text_en') is-invalid @enderror"
                               placeholder="Enter Button Title EN" name="btn_text_en">
                        <small class="text-danger"> @error('btn_text_en') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="btn_text_bn" class="required">Button Text BN:</label>
                        <input readonly
                               value="{{isset($redeemDetail->btn_text_bn) ? $redeemDetail->btn_text_bn : "" }}" required id="btn_text_en"
                               type="text" class="form-control @error('btn_text_bn') is-invalid @enderror"
                               placeholder="Enter Button Title BN" name="btn_text_bn">
                        <small class="text-danger"> @error('btn_text_bn') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="coin_amount" class="required">Coin Amount:</label>
                        <input readonly
                               value="{{ isset($redeemDetail->coin_amount) ? $redeemDetail->coin_amount : "" }}" required id="btn_text_en"
                               type="number" class="form-control @error('coin_amount') is-invalid @enderror"
                               placeholder="Enter Coin Amount" name="coin_amount">
                        <small class="text-danger"> @error('coin_amount') {{ $message }} @enderror </small>
                        <div class="help-block"></div>
                    </div>
                    <div id="image-input" class="form-group col-md-6 mb-2">
                        <div class="form-group">
                            <label for="redeem_logo">Redeem Logo</label>
                            <input type="file" id="redeem_logo" name="redeem_logo" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"
                                   data-default-file="{{ isset($redeemDetail->redeem_logo) ? asset($redeemDetail->redeem_logo) : '' }}" readonly
                            />
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">

                    <div class="card-body">
                        <form novalidate class="form row"  action="{{ route('orange-club.update', $orangeClubImage->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    {{-- Select User Group --}}
                                    <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Select User Group</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                    <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                        <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12">
                                                <input  type="radio" name="user_group_type" value="all" class="user_group_type" id="all"
                                                    {{ (isset($orangeClubImage) && $orangeClubImage->user_group_type == "all") ? 'checked' : '' }}>
                                                <label for="all">All</label>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <input type="radio" name="user_group_type" value="prepaid" class="user_group_type" id="prepaid"
                                                    {{ (isset($orangeClubImage) && $orangeClubImage->user_group_type == "prepaid") ? 'checked' : '' }}>
                                                <label for="prepaid">Prepaid</label>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <input type="radio" name="user_group_type" value="postpaid" class="user_group_type" id="postpaid"
                                                    {{ isset($orangeClubImage) && $orangeClubImage->user_group_type == "postpaid" ? 'checked' : '' }}>
                                                <label for="postpaid">Postpaid</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="user_group_type" value="segment_wise" class="user_group_type" id="segment_wise"
                                                    {{ isset($orangeClubImage) && $orangeClubImage->user_group_type == "segment_wise" ? 'checked' : '' }} {{ isset($orangeClubImage) ? '' : 'checked' }}>
                                                <label for="segment_wise">Segment Wise (Base Msisdn)</label>
                                            </div>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('type'))
                                            <div class="help-block">  {{ $errors->first('type') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 mb-2 {{ isset($orangeClubImage) && $orangeClubImage->user_group_type != "segment_wise" ? 'd-none' : '' }}" id="base_msisdn">
                                        <label for="redirect_url" class="required">Base Msisdn</label>
                                        <select id="base_groups_id" name="base_groups_id"
                                                class="browser-default custom-select">
                                            <option value="">Select Action</option>
                                            @foreach ($baseMsisdnGroups as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    {{ isset($orangeClubImage) && $orangeClubImage->base_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="name" class="required">Name:</label>
                                        <input
                                            value="{{isset($orangeClubImage->name) ? $orangeClubImage->name : "" }}" required id="btn_text_en"
                                            type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name" name="name">
                                        <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="partner_details" class="required">Partner Details</label>
                                        <textarea rows="3" id="partner_details" name="partner_details" class="form-control" placeholder="Enter Partner Details">{{ $orangeClubImage->partner_details }}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Active Status:</label>
                                            <select class="form-control" id="status"
                                                    name="status">
                                                <option value="1" {{ $orangeClubImage->status == 1 ? 'selected' : "" }}> Active</option>
                                                <option value="0" {{ $orangeClubImage->status == 0 ? 'selected' : "" }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Upload Image :</label>
                                            <div class="input-group" id="image_input_div">
                                                <div class="custom-file">
                                                    <input accept="image/*"
                                                           onchange="checkImageRatio(this)"
                                                           id="image" name="image_url"
                                                           type="file"
                                                           class="custom-file-input">
                                                    <div class="help-block"></div>
                                                    <label class="custom-file-label"
                                                           for="image_url">Upload Image...</label>
                                                </div>
                                            </div>
                                            <small class="text-info" id="ratio_info">
                                                Shortcut icon should be in
                                                16:9 aspect ratio</small><br>
                                            <small
                                                class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small id="message"></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('start_time') ? ' error' : '' }}">
                                        <label for="end_time">Start Date</label>
                                        <input type="text" name="start_time" id="start_date" class="form-control"
                                               placeholder="Please select end date"
                                               value="{{ $orangeClubImage->end_time }}" autocomplete="off">
                                        <div class="help-block"></div>
                                        @if ($errors->has('end_date'))
                                            <div class="help-block">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                        <label for="end_time">End Date</label>
                                        <input type="text" name="end_time" id="end_date" class="form-control"
                                               placeholder="Please select end date"
                                               value="{{ $orangeClubImage->end_time }}" autocomplete="off">
                                        <div class="help-block"></div>
                                        @if ($errors->has('end_date'))
                                            <div class="help-block">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <img style="height:100px;width:200px" id="img_display"
                                             src="{{asset($orangeClubImage->image_url)}}" alt="" srcset="">
                                    </div>
                                    @php
                                        $actionList = Helper::navigationActionList();

                                        /*dd($actionList)*/
                                    @endphp

                                    <div class="form-group col-md-6 mb-2 "
                                         id="slider_action">
                                        <label for="redirect_url">Slider Action </label>
                                        <select id="navigate_action" name="component_identifier" class="browser-default custom-select">
                                            <option value="">Select Action</option>
                                            @foreach ($actionList as $key => $value)
                                                <option value="{{ $key }}" {{ ( $key == $orangeClubImage->redirect_url) ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                    {{--<div id="link" class="form-group col-md-6">
                                        <label id="label_link" for="numbers">Web or Deep Link</label>
                                        <div class='input-group'>
                                            <input type='text' class="form-control" name="web_deep_link" id="web_deep_link"
                                                   placeholder="Please enter link" />
                                        </div>
                                    </div>--}}

                                    <div id="append_div" class="col-md-6"></div>
                                    <div class="col-md-8 mb-2">
                                        <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt=""
                                             srcset="">
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
                    'default': 'Upload Image',
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


                $('#navigate_action').on('change', function () {
                    let action = $(this).val();
                    console.log(action);
                    if (action == 'DIAL') {
                        $("#append_div").html(dial_html);
                    } else if (action == 'URL') {
                        $("#append_div").html(url_html);
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
            $('.user_group_type').click(function () {
                if ($(this).val() !== "segment_wise"){
                    $('#base_msisdn').addClass('d-none')
                } else {
                    $('#base_msisdn').removeClass('d-none')
                }
            });

            let checkImageRatio = function ($this) {
                createImageBitmap($this.files[0]).then((bmp) => {

                    if (bmp.width / bmp.height == 16 / 9) {
                        document.getElementById('submitForm').disabled = false;
                        document.getElementById('message').innerHTML = '';
                        document.getElementById('image_input_div').style.border = 'none';

                        //change image preview
                        imageURL($this, 'img_display');

                    } else {
                        document.getElementById('image_input_div').style.border = '1px solid red';
                        document.getElementById('message').innerHTML = '<b>image aspact ratio must 16:9(change the picture to enable button)</b>';
                        document.getElementById('ratio_info').innerHTML = '';
                        document.getElementById('message').classList.add('text-danger');
                        document.getElementById('submitForm').disabled = true;
                    }
                })
            };
        })
    </script>
@endpush
