@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', 'Edit Image Info')

@section('action')
    <a href="{{route('myblslider.images.index',$imageInfo->slider_id)}}" class="btn btn-info btn-glow px-2">
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
                              action="{{ route("myblslider.images.update",$imageInfo->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" hidden value="{{$imageInfo->id}}" name="id">


                            <div class="form-group col-md-12">
                                <div class="form-group {{ $errors->has('user_type') ? ' error' : '' }}">
                                    <input type="radio" name="user_type" value="all" id="radio-15"
                                           @if($imageInfo->user_type == "all") {{ 'checked' }} @endif checked>
                                    <label for="input-radio-15" class="mr-3">All</label>
                                    <input type="radio" name="user_type" value="prepaid"
                                           id="radio-16" @if($imageInfo->user_type == "prepaid") {{ 'checked' }} @endif>
                                    <label for="input-radio-16" class="mr-3">Prepaid</label>
                                    <input type="radio" name="user_type" value="postpaid"
                                           id="radio-17" @if($imageInfo->user_type == "postpaid") {{ 'checked' }} @endif>
                                    <label for="input-radio-17" class="mr-3">Postpaid</label>
                                    <input type="radio" name="user_type" value="propaid"
                                           id="radio-18" @if($imageInfo->user_type == "propaid") {{ 'checked' }} @endif>
                                    <label for="input-radio-18" class="mr-3">Propaid</label>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="title">Title: <small
                                            class="text-danger">*</small> </label>
                                <input
                                        required
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
                                <label for="alt_text">Alt Text: </label>
                                <input
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

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="is_active">Active Status:</label>
                                    <select value="{{$imageInfo->is_active}}"
                                            class="form-control" id="is_active"
                                            name="is_active">
                                        <option value="1"
                                                @if($imageInfo->is_active == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($imageInfo->is_active == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>


                            @php
                                $actionList = Helper::navigationActionList();
                            @endphp

                            <div class="form-group col-md-6 mb-2">
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


                            {{--  @if($imageInfo->redirect_url == "URL")
                                  <div id="link" class="form-group col-md-6">
                                      <label id="label_link" for="numbers">Web or Deep Link</label>
                                      <div class='input-group'>
                                          <input type='text' class="form-control" name="web_deep_link" id="web_deep_link"
                                                 placeholder="Please enter link"
                                                 value="{{old('web_deep_link') ? old('web_deep_link'): $imageInfo->web_deep_link}}"/>
                                      </div>
                                  </div>
                              @else
                                  <div id="link" style="display: none" class="form-group col-md-6">
                                      <label id="label_link" for="numbers">Web or Deep Link</label>
                                      <div class='input-group'>
                                          <input type='text' class="form-control" name="web_deep_link" id="web_deep_link"
                                                 placeholder="Please enter link" />
                                      </div>
                                  </div>
                              @endif--}}


                            <div id="append_div" class="col-md-6">
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
                                            <div class="help-block"></div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="col-md-8">
                                {{$imageInfo->image_url}}
                                <img style="height:100px;width:200px" id="img_display"
                                     src="{{asset($imageInfo->image_url)}}" alt="" srcset="">
                            </div>

                            {{-- <div class="col-2">
                                 <button type="submit" style="width:100%" id="submitForm"
                                         class=" btn btn-success">Submit
                                 </button>
                             </div>--}}

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


            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                //console.log(action);
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                } else if (action == 'URL') {
                    $("#append_div").html(url_html);
                } else if (action == 'PURCHASE') {
                    $("#append_div").html(product_html);
                    $(".product-list").select2({
                        placeholder: "Select a product",
                        minimumInputLength:3,
                        allowClear: true,
                        selectOnClose:true,
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
    </script>
@endpush
