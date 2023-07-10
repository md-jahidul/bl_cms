@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', 'Edit Image Info')

@section('action')
    <a href="{{route('generic-slider.images.index',$imageInfo->slider->id)}}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row"
                              action="{{ route("generic-slider.images.update",$imageInfo->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" hidden value="{{$imageInfo->id}}" name="id">


                            <div class="form-group col-md-12">
                                <div class="form-group {{ $errors->has('user_type') ? ' error' : '' }}">
                                    <input type="radio" name="user_type" value="all" id="all"
                                    @if($imageInfo->user_type == "all") {{ 'checked' }} @endif>
                                    <label for="all" class="mr-3 cursor-pointer">All</label>
                                    @if(!($imageInfo->slider->component_for == 'non_bl' || $imageInfo->slider->component_for == 'non_bl_offer'))
                                    <input type="radio" name="user_type" value="prepaid"
                                           id="prepaid" @if($imageInfo->user_type == "prepaid") {{ 'checked' }} @endif>
                                    <label for="prepaid" class="mr-3 cursor-pointer">Prepaid</label>
                                    <input type="radio" name="user_type" value="postpaid"
                                           id="postpaid" @if($imageInfo->user_type == "postpaid") {{ 'checked' }} @endif>
                                    <label for="postpaid" class="mr-3 cursor-pointer">Postpaid</label>
                                    @endif
                                {{--<input type="radio" name="user_type" value="segment_wise_banner" id="segment_wise_banner" @if($imageInfo->user_type == "segment_wise_banner") {{ 'checked' }} @endif>--}}
                                {{--<label for="segment_wise_banner" class="mr-3 cursor-pointer">Segment wise banner</label>--}}
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="title">Title: <small
                                        class="text-danger">*</small> </label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title')?old('title'):$imageInfo->title}}" required id="title"
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Title" name="title">
                                <small
                                    class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="alt_text" class="required">Alt Text: </label>
                                <input  required
                                        maxlength="200"
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                        data-validation-regex-message="Alt Text must start with alphabets"
                                        data-validation-maxlength-message="Alt Text can not be more then 200 Characters"
                                        value="{{$imageInfo->alt_text}}" id="alt_text" type="text"
                                        class="form-control @error('alt_text') is-invalid @enderror"
                                        placeholder="Alt text" name="alt_text">
                                <small
                                    class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>


                            <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                <label for="start_date">Start Date</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" name="start_date" id="start_date"
                                           placeholder="Please select start date"
                                           value="{{$imageInfo->start_date}}">
                                </div>
                                <div class="help-block"></div>
                                @if ($errors->has('start_date'))
                                    <div class="help-block">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control" name="end_date" id="end_date"
                                       placeholder="Please select end date"
                                       value="{{old('end_date') ? old('end_date'): $imageInfo->end_date}}">
                                <div class="help-block"></div>
                                @if ($errors->has('end_date'))
                                    <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>

                            @if($imageInfo->slider->component_type == "swipe_banner" ||
                                $imageInfo->slider->component_type == "category_banner")
                            <div class="form-group col-md-6">
                                <label for="banner_text_en">Banner Text English</label>
                                <input class="form-control"
                                        name="banner_text_en"
                                        id="banner_text_en"
                                        placeholder="Enter English Banner Text"
                                        value="{{ $imageInfo->banner_text_en }}">
                                @if($errors->has('banner_text_en'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('banner_text_en') }}</small>
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="banner_text_bn">Banner Text Bangla</label>
                                <input class="form-control"
                                        name="banner_text_bn"
                                        id="banner_text_bn"
                                        placeholder="Enter Bangla Banner Text"
                                        value="{{ $imageInfo->banner_text_bn }}">
                                @if($errors->has('banner_text_bn'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('banner_text_bn') }}</small>
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subtitle_text_en">Subtitle Text (English)</label>
                                <input class="form-control"
                                        name="subtitle_text_en"
                                        id="subtitle_text_en"
                                        placeholder="Enter Bangla Banner Text",
                                        value="{{ $imageInfo->subtitle_text_en }}"
                                        >
                                @if($errors->has('subtitle_text_en'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('subtitle_text_en') }}</small>
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subtitle_text_bn">Subtitle Text (Bangla)</label>
                                <input class="form-control"
                                        name="subtitle_text_bn"
                                        id="subtitle_text_bn"
                                        placeholder="Enter Bangla Banner Text",
                                        value="{{ $imageInfo->subtitle_text_bn }}"
                                        >
                                @if($errors->has('subtitle_text_bn'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('subtitle_text_bn') }}</small>
                                    </p>
                                @endif
                            </div>
                            @endif

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select value="{{$imageInfo->status}}"
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($imageInfo->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($imageInfo->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Deeplink</label>
                                    <input type="text" name="deeplink" class="form-control" value="{{ $imageInfo->deeplink }}" placeholder="Enter Valid Deeplink" >
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            @php
                                $actionList = Helper::navigationActionList();

                                /*dd($actionList)*/
                            @endphp

                            <div class="form-group col-md-6 mb-2 {{ $imageInfo->user_type != "segment_wise_banner" ? 'show' : 'hidden' }}"
                                 id="slider_action">
                                <label for="redirect_url">Slider Action </label>
                                <select id="navigate_action" name="redirect_url" class="browser-default custom-select">
                                    <option value="">Select Action</option>
                                    @foreach ($actionList as $key => $value)
                                        <option value="{{ $key }}" {{ ( $key == $imageInfo->redirect_url) ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                            </div>


                            @php
                                if (isset($imageInfo->slider->component_size) && $imageInfo->slider->component_size !=null){
                                        $width = explode('x', $imageInfo->slider->component_size)[0];
                                        $height = explode('x', $imageInfo->slider->component_size)[1];
                                        $size = $width/$height;
                                    } else {
                                        $size = - 1;
                                        $width = -1;
                                        $height = -1;
                                    }
                            @endphp
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
                                    <small
                                        class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                    <small id="message"></small>
                                </div>
                            </div>

                            <div id="append_div" class="col-md-6 {{ $imageInfo->user_type != "segment_wise_banner" ? 'show' : 'hidden' }}">
                                @if(isset($imageInfo))
                                    @if($info = json_decode(json_encode($imageInfo->other_attributes)))
                                        <div class="form-group other-info-div">
                                            @if($imageInfo->redirect_url == "DIAL")
                                                <label> Dial Number</label>
                                                <input type="text" name="other_attributes" class="form-control" required
                                                       value="@if($info) {{$info->content}} @endif">
                                            @endif
                                            @if($imageInfo->redirect_url == "URL")
                                                <label>Redirect URL</label>
                                                <input type="text" name="other_attributes" class="form-control" required
                                                       value="@if($info) {{$info->content}} @endif">
                                            @endif
                                            @if($imageInfo->redirect_url == "PURCHASE")
                                                <label>Linked Product</label>
                                                <select name="other_attributes" class="form-control select2" required>
                                                    <option value="">Select a Product</option>
                                                    @foreach ($products as $value)
                                                        <option value="{{ $value['id'] }}" {{ ( $value['id']  == $info->content) ? 'selected' : '' }}>
                                                            {{ $value['text'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if($imageInfo->redirect_url == "FEED_CATEGORY")
                                                <div class="form-group other-info-div">
                                                    <label>Select a Feed Category</label>
                                                    <select class="feed-cat-list form-control" name="other_attributes[feed_cat_slug]" required>
                                                        @foreach($feedCategories as $feedCategory)
                                                            <option value="{{ $feedCategory->slug }}" data-id="{{ $feedCategory->id }}"
                                                                {{ isset($imageInfo->other_attributes['feed_cat_slug']) && $feedCategory->slug == $imageInfo->other_attributes['feed_cat_slug'] ? 'selected' : '' }}>{{ $feedCategory->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            @endif
                                            <div class="help-block"></div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="col-md-8">
                                <img style="height:100px;width:200px" id="img_display"
                                     src="{{asset($imageInfo->image_url)}}" alt="" srcset="">
                            </div>

                            {{-- <div class="col-2">
                                 <button type="submit" style="width:100%"
                                         class=" btn btn-success">Submit
                                 </button>
                             </div>--}}

                            <div class="form-group col-md-12 mt-2 {{ $imageInfo->user_type != "segment_wise_banner" ? 'hidden' : 'show' }}"
                                 id="BannerSegmentWiseDiv">
                                <label><b>Banner segment wise CTA</b></label>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Base Msisdn</th>
                                        <th>Segment Action</th>
                                        <th>CTA Action</th>
                                        {{--                                        <th>Status</th>--}}
                                        <th class="text-center" style="width: 2%">
                                            <i data-repeater-create
                                               class="la la-plus-circle text-info cursor-pointer"
                                               id="repeater-button">
                                            </i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="segment_wise_cta" id="cta_table">
                                    {{--                                    {{ dd(!empty($imageInfo->baseImageCats)) }}--}}
                                    @if(!$imageInfo->baseImageCats->isEmpty())
                                        @foreach($imageInfo->baseImageCats as $data)
                                            <tr data-repeater-item>
                                                <td>
                                                    <select class="form-control" id="segment_action" name="group_id">
                                                        <option value="">Select Group</option>
                                                        @foreach($baseGroups as $group)
                                                            <option value="{{$group->id}}" {{ ($group->id == $data->group_id) ? 'selected' : '' }}>{{$group->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="segment_action" name="action_name">
                                                        <option value="">Select Action</option>
                                                        @foreach ($actionList as $key => $value)
                                                            <option value="{{ $key }}" {{ ($key == $data->action_name) ? 'selected' : '' }}>
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control" name="action_url_or_code" value="{{ $data->action_url_or_code }}" type="text">
                                                </td>
                                                <td class="text-center align-middle">
                                                    <i data-repeater-delete
                                                       class="la la-trash-o text-danger cursor-pointer"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr data-repeater-item>
                                            <td>
                                                <select class="form-control" id="segment_action" name="group_id">
                                                    <option value="">Select Group</option>
                                                    @foreach($baseGroups as $group)
                                                        <option value="{{$group->id}}">{{$group->title}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" id="segment_action" name="action_name">
                                                    <option value="">Select Action</option>
                                                    @foreach ($actionList as $key => $value)
                                                        <option value="{{ $key }}">
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control" name="action_url_or_code" type="text">
                                            </td>
                                            <td class="text-center align-middle">
                                                <i data-repeater-delete
                                                   class="la la-trash-o text-danger cursor-pointer"></i>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-12">
                                <button style="float: right" type="submit" id="submitForm"
                                        class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!$imageInfo)
        <h1>
            No Image Available with this ID
        </h1>
    @else

    @endif
@endsection




@push('style')

@endpush

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>

        $(function () {
            $('#BannerSegmentWiseDiv').repeater();

            $("input[name=user_type]").click(function () {
                if ($(this).val() === "segment_wise_banner") {
                    $("#BannerSegmentWiseDiv").addClass('show').removeClass('hidden');
                    $("#slider_action").addClass('hidden').removeClass('show');
                    $("#append_div").addClass('hidden').removeClass('show');
                } else {
                    $("#BannerSegmentWiseDiv").addClass('hidden').removeClass('show');
                    $("#slider_action").addClass('show').removeClass('hidden');
                    $("#append_div").addClass('show').removeClass('hidden');
                }
            });

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


            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            var dial_content = "";
            var redirect_content = "";
            var purchase_content = "";
            var feed_category = "";
            var url_html;
            var product_html;
            var parse_data;
            let dial_html, other_attributes = '';
            var js_data = '<?php echo isset($imageInfo) ? json_encode($imageInfo) : null; ?>';


            if (js_data) {
                parse_data = JSON.parse(js_data);
                other_attributes = parse_data.other_attributes;
                if (other_attributes) {
                    let type = other_attributes.type;
                    if(type == 'dial'){
                        dial_content = other_attributes.content;
                    }else if(type == 'USSD'){
                        redirect_content = other_attributes.content;
                    }else if(type == 'url'){
                        redirect_content = other_attributes.content;
                    }else{
                        purchase_content = other_attributes.content;
                    }
                }

            }

            //alert(content);
            // add dial number
            dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number</label>
                                        <input type="text" name="other_attributes" class="form-control" value="${dial_content}" placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

            url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="other_attributes" class="form-control" value="${redirect_content}" placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;

            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control" name="other_attributes">
                                            <option value="${purchase_content}" selected="selected">${purchase_content}</option>
                                         </select>
                                        <div class="help-block"></div>
                                    </div>`;

            feed_category = ` <div class="form-group other-info-div">
                                    <label>Feed Category</label>
                                    <select class="feed-cat-list form-control" name="other_attributes[feed_cat_slug]" required>
                                        <option value="">---Select Feed Category---</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>`;
            var code = (parse_data.ussd_code != null) ? parse_data.ussd_code : '';
            var message_en = (parse_data.message_en != null) ? parse_data.message_en : '';
            var message_bn = (parse_data.message_bn != null) ? parse_data.message_bn : '';
            ussd_code = ` <div class="form-group col-md-12 mb-2 other-info-div">
                                        <label for="ussd_code" class="required">USSD Code:</label>
                                        <input
                                            maxlength="16"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="USSD Code is required"
                                            data-validation-maxlength-message="USSD code can not be more then 16 Characters"
                                            value="${code}" required id="ussd_code"
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
                                            placeholder="Message En" name="message_en"> ${message_en} </textarea>
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
                                            placeholder="Message Bn" name="message_bn"> ${message_bn} </textarea>
                                        <small class="text-danger"> @error('message_bn') {{ $message_bn }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div> `;

            if(parse_data.redirect_url == 'USSD'){
                $("#append_div").html(ussd_code);
            }


            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                //console.log(action);
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                }else if (action == 'USSD') {
                    $("#append_div").html(ussd_code);
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
                        minimumInputLength: 2,
                        allowClear: true,
                        selectOnClose: false,
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
            $("#navigate_action").select2();
        });


    </script>


    <script>

        let imageURL = function (input, id) {
            if (input.files && input.files[0]) {
                console.log(id);
                let reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById(id).src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        let checkImageRatio = function ($this) {
            let size = `{{round($size, 2)}}`;
            let width = `{{$width}}`;
            let height = `{{$height}}`;
            createImageBitmap($this.files[0]).then((bmp) => {
                console.log(size != -1 || (bmp.width / bmp.height).toFixed(2) == size);
                if (size == -1 || (bmp.width / bmp.height).toFixed(2) == size) {
                    document.getElementById('submitForm').disabled = false;
                    document.getElementById('message').innerHTML = '';
                    document.getElementById('image_input_div').style.border = 'none';

                    //change image preview
                    imageURL($this, 'img_display');

                } else {
                    document.getElementById("submitForm").disabled = true;
                    document.getElementById('image_input_div').style.border = '1px solid red';
                    document.getElementById('message').innerHTML = `<b style="color: red">image size must be ${width} x ${height} pixel (change the picture to enable button)</b>`;
                    document.getElementById('ratio_info').innerHTML = '';
                    document.getElementById('message').classList.add('text-danger');
                }
            })
        };
    </script>
@endpush
