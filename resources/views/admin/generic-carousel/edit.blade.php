@extends('layouts.admin')
@section('title', 'Edit Image')
@section('card_name', 'Edit Image Info')

@section('action')
    <a href="{{route('generic-carousel.index')}}" class="btn btn-info btn-glow px-2">
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
                              action="{{ route("generic-carousel.update",$imageInfo->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group col-md-6">
                                <label for="title_en">Title(EN): <small
                                        class="text-danger">*</small> </label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title_en')?old('title_en'):$imageInfo->title_en}}" required id="title_en"
                                    type="text"
                                    class="form-control @error('title_en') is-invalid @enderror"
                                    placeholder="Title" name="title_en">
                                <small
                                    class="text-danger"> @error('title_en') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="title_bn" class="required">Title(BN):</label>
                                <input
                                    maxlength="200"
                                    data-validation-required-message="Title is required"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title_bn')?old('title_bn'):$imageInfo->title_bn}}" required id="title_bn"
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
                                    value="{{old('sub_title_en')?old('sub_title_en'):$imageInfo->sub_title_en}}" required id="sub_title_en"
                                    type="text" class="form-control @error('sub_title_en') is-invalid @enderror"
                                    placeholder="Sub Title in English" name="sub_title_en">
                                <small class="text-danger"> @error('sub_title_en') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="sub_title_bn" class="required">Sub Title(BN):</label>
                                <input
                                    maxlength="200"
                                    data-validation-required-message="Title is required"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('sub_title_bn')?old('sub_title_bn'):$imageInfo->sub_title_bn}}" required id="sub_title_bn"
                                    type="text" class="form-control @error('sub_title_bn') is-invalid @enderror"
                                    placeholder="Sub Title in Bangla" name="sub_title_bn">
                                <small class="text-danger"> @error('sub_title_bn') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>

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

                            <div id="link" class="form-group col-md-6">
                                <label id="label_link" for="numbers">Web or Deep Link</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" name="web_deep_link" id="web_deep_link"
                                        value="{{old('web_deep_link')?old('web_deep_link'):$imageInfo->web_deep_link}}"
                                        placeholder="Please enter link" />
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

                            <div class="col-md-8">
                                <img style="height:100px;width:200px" id="img_display"
                                     src="{{asset($imageInfo->image_url)}}" alt="" srcset="">
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

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
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
