@extends('layouts.admin')
@section('title', 'Add Image')
@section('card_name',"Image" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Image</li>
@endsection
@section('action')
    <a href="{{route('myblslider.images.index',$slider_information->id)}}" class="btn btn-info btn-glow px-2">
        Image list
    </a>
    <a href="{{route('myblslider.index')}}" class="btn btn-primary btn-glow px-2">
        Slider list
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
                        <form novalidate class="form row" action="{{route('myblslider.images.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('post')
                        <input type="hidden" hidden value="{{$slider_information->id}}" name="slider_id">
                        <div class="form-group col-12 mb-2 file-repeater">

                            <div class="row mb-1">


                                <div class="form-group col-md-12">
                                    <div class="form-group {{ $errors->has('user_type') ? ' error' : '' }}">

                                        <input type="radio" name="user_type" value="all" id="input-radio-15"  checked>
                                        <label for="input-radio-15" class="mr-3">All</label>
                                        <input type="radio" name="user_type" value="prepaid" id="input-radio-16" >
                                        <label for="input-radio-16" class="mr-3">Prepaid</label>
                                        <input type="radio" name="user_type" value="postpaid" id="input-radio-17">
                                        <label for="input-radio-17" class="mr-3">Postpaid</label>
                                        <input type="radio" name="user_type" value="propaid" id="input-radio-18">
                                        <label for="input-radio-18" class="mr-3">Propaid</label>

                                        @if ($errors->has('user_type'))
                                            <div class="help-block">  {{ $errors->first('user_type') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group col-md-6 mb-2">
                                    <label for="title" class="required">Title:</label>
                                    <input
                                    required
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message = "Title can not be more then 200 Characters"
                                    value="@if(old('title')) {{old('title')}} @endif" required id="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title">
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="alt_text" >Alt Text: </label>
                                    <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-regex-message="Alt Text must start with alphabets"
                                    data-validation-maxlength-message = "Alt Text can not be more then 200 Characters"
                                    value="@if(old('alt_text')) {{old('alt_text')}} @endif" id="alt_text" type="text" class="form-control @error('alt_text') is-invalid @enderror" placeholder="Alt text" name="alt_text">
                                    <small class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               placeholder="Please select start date" />
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                           placeholder="Please select end date"
                                           value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="off">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_active">Active Status:</label>
                                        <select class="form-control" id="is_active"
                                                name="is_active">
                                            <option value="1"> Active </option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                @php
                                    $actionList = Helper::navigationActionList();
                                @endphp

                                <div class="form-group col-md-6 mb-2">
                                    <label for="redirect_url" >Slider Action </label>
                                    <select name="redirect_url" id="redirect_url" class="browser-default custom-select">
                                        <option value="">Select Action</option>
                                        @foreach ($actionList as $key => $value)
                                            <option value="{{ $key }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>


                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="required">Upload Image :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input accept="image/*"
                                                required
                                                data-validation-required-message="Image is required"
                                                onchange="createImageBitmap(this.files[0]).then((bmp) => {

                                                    if(bmp.width/bmp.height == 16/9){
                                                        console.log('yes')
                                                        document.getElementById('submitForm').disabled = false;
                                                        document.getElementById('massage').innerHTML = '';
                                                        this.style.border = 'none';
                                                        // this.nextElementSibling.innerHTML = '';
                                                    }else{
                                                        console.log('no')
                                                        this.style.border = '1px solid red';
                                                        document.getElementById('massage').innerHTML = '<b>Image aspect ratio must 16:9(change the picture to enable button)</b>';
                                                        document.getElementById('massage').classList.add('text-danger');
                                                        document.getElementById('submitForm').disabled = true;
                                                    }
                                                })"
                                                id="image"  name="image_url" type="file" class="custom-file-input">
                                                <label class="custom-file-label" for="image_url">Upload Image...</label>
                                            </div>
                                        </div>
                                        <div class="help-block">
                                            <small class="text-info"> Image aspect ratio should be in 16:9 </small><br>
                                        </div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="massage"></small>
                                    </div>
                                </div>


                                <div id="link" class="form-group col-md-6">
                                    <label id="label_link" for="numbers">Web or Deep Link</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="web_deep_link" id="web_deep_link"
                                               placeholder="Please enter link" />
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <img style="height:100px;width:200px;display:none" id="imgDisplay" src="" alt="" srcset="">
                                </div>

                                <div class="form-group col-md-12">
                                    <button style="float: right" type="submit" id="submitForm" class="btn btn-success round px-2">
                                        <i class="la la-check-square-o"></i> Submit
                                    </button>
                                </div>

                                </form>
                        </div>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>

        $("#link").hide();
        $(function () {
            $('#redirect_url').on('change', function() {
                if( this.value  == "URL" ) {
                    $("#link").show();
                }
                else {
                    $("#link").hide();
                }
            });
        })


        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>

@endpush
