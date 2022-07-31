@extends('layouts.admin')
@section('title', 'Redeem Detail')
@section('card_name',"Redeem Detail" )

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
                        <form novalidate class="form row"  action="{{ isset($redeemDetail->id) ? route('orange-club-redeem.update', $redeemDetail->id) :  route('orange-club-redeem.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @if(isset($redeemDetail->id))
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="redeem_title_en" class="required">Redeem Title EN:</label>
                                        <input
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
                                        <input
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
                                        <input
                                            value="{{isset($redeemDetail->btn_text_en) ? $redeemDetail->btn_text_en : "" }}" required id="btn_text_en"
                                            type="text" class="form-control @error('btn_text_en') is-invalid @enderror"
                                            placeholder="Enter Button Title EN" name="btn_text_en">
                                        <small class="text-danger"> @error('btn_text_en') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="btn_text_bn" class="required">Button Text BN:</label>
                                        <input
                                            value="{{isset($redeemDetail->btn_text_bn) ? $redeemDetail->btn_text_bn : "" }}" required id="btn_text_en"
                                            type="text" class="form-control @error('btn_text_bn') is-invalid @enderror"
                                            placeholder="Enter Button Title BN" name="btn_text_bn">
                                        <small class="text-danger"> @error('btn_text_bn') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="coin_amount" class="required">Coin Amount:</label>
                                        <input
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
                                                   data-default-file="{{ isset($redeemDetail->redeem_logo) ? asset($redeemDetail->redeem_logo) : '' }}"
                                            />
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="btn_text_en" class="required">Button Text EN:</label>
                                        <input
                                            value="{{isset($redeemDetail->btn_text_en) ? $redeemDetail->btn_text_en : ""}}" required id="btn_text_en"
                                            type="text" class="form-control @error('btn_text_en') is-invalid @enderror"
                                            placeholder="Enter Button Title EN" name="btn_text_en">
                                        <small class="text-danger"> @error('btn_text_en') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="btn_text_bn" class="required">Button Text BN:</label>
                                        <input
                                            value="{{isset($redeemDetail->btn_text_bn) ? $redeemDetail->btn_text_bn : ""}}" required id="btn_text_en"
                                            type="text" class="form-control @error('btn_text_bn') is-invalid @enderror"
                                            placeholder="Enter Button Title BN" name="btn_text_bn">
                                        <small class="text-danger"> @error('btn_text_bn') {{ $message }} @enderror </small>
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
