@extends('layouts.admin')
@section('title', 'Add Image')
@section('card_name',"Image" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Image</li>
@endsection
@section('action')
    <a href="{{route('generic-carousel.index')}}" class="btn btn-info btn-glow px-2">
        Image list
    </a>
@endsection

@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">

                    <div class="card-body">
                        <form novalidate class="form row" action="{{route('generic-carousel.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_en" class="required">Title(EN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title_en')) {{old('title_en')}} @endif" required id="title_en"
                                            type="text" class="form-control @error('title_en') is-invalid @enderror"
                                            placeholder="Title in English" name="title_en">
                                        <small class="text-danger"> @error('title_en') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_bn" class="required">Title(BN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title_bn')) {{old('title_bn')}} @endif" required id="title_bn"
                                            type="text" class="form-control @error('title_bn') is-invalid @enderror"
                                            placeholder="Title in Bangla" name="title_bn">
                                        <small class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="sub_title_en" class="required">Sub Title(EN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('sub_title_en')) {{old('sub_title_en')}} @endif" required id="sub_title_en"
                                            type="text" class="form-control @error('sub_title_en') is-invalid @enderror"
                                            placeholder="Sub Title in English" name="sub_title_en">
                                        <small class="text-danger"> @error('sub_title_en') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="sub_title_bn" class="required">Sub Title(BN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('sub_title_bn')) {{old('sub_title_bn')}} @endif" required id="sub_title_bn"
                                            type="text" class="form-control @error('sub_title_bn') is-invalid @enderror"
                                            placeholder="Sub Title in Bangla" name="sub_title_bn">
                                        <small class="text-danger"> @error('sub_title_bn') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Active Status:</label>
                                            <select class="form-control" id="status"
                                                    name="status">
                                                <option value="1"> Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="link" class="form-group col-md-6">
                                        <label id="label_link" for="numbers">Web or Deep Link</label>
                                        <div class='input-group'>
                                            <input type='text' class="form-control" name="web_deep_link" id="web_deep_link"
                                                   placeholder="Please enter link" />
                                        </div>
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
                                                           id="image" name="image_url" type="file"
                                                           class="custom-file-input">
                                                    <label class="custom-file-label" for="image_url">Upload
                                                        Image...</label>
                                                </div>
                                            </div>
                                            <div class="help-block">
                                                <small class="text-info"> Image aspect ratio should be in
                                                    16:9 </small><br>
                                            </div>
                                            <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small id="massage"></small>
                                        </div>
                                    </div>
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


            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
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
