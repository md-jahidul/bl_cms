@extends('layouts.admin')
@section('title', 'Edit Special Type')
@section('card_name', 'Edit Special Type')

@section('action')
    <a href="{{route('product-special-types.index')}}" class="btn btn-info btn-glow px-2">
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
                              action="{{ route("product-special-types.update",$productSpecialType->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group col-md-6">
                                <label for="name_en">Name(EN): <small
                                        class="text-danger">*</small> </label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('name_en')?old('name_en'):$productSpecialType->name_en}}" required id="name_en"
                                    type="text"
                                    class="form-control @error('name_en') is-invalid @enderror"
                                    placeholder="Title" name="name_en">
                                <small
                                    class="text-danger"> @error('name_en') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                                @if ($errors->has('name_en'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('name_en') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="name_bn" class="required">Name(BN):</label>
                                <input
                                    maxlength="200"
                                    data-validation-required-message="Title is required"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('name_bn')?old('name_bn'):$productSpecialType->name_bn}}" required id="name_bn"
                                    type="text" class="form-control @error('name_bn') is-invalid @enderror"
                                    placeholder="Title in Bangla" name="name_bn">
                                <small class="text-danger"> @error('name_bn') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                                @if ($errors->has('name_bn'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('name_bn') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select value="{{$productSpecialType->status}}"
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($productSpecialType->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($productSpecialType->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }}">
                                <label for="icon">Icon</label>
                                <div class="custom-file">
                                    <input 
                                        accept="image/*"
                                        onchange="createImageBitmap(this.files[0]).then((bmp) => {

                                                    if(bmp.width/bmp.height == 1/1){
                                                        console.log('yes')
                                                        document.getElementById('submitForm').disabled = false;
                                                        document.getElementById('massage').innerHTML = '';
                                                        this.style.border = 'none';
                                                        // this.nextElementSibling.innerHTML = '';
                                                    }else{
                                                        console.log('no')
                                                        this.style.border = '1px solid red';
                                                        document.getElementById('massage').innerHTML = '<b>Image aspect ratio must be 1:1(change the picture to enable button)</b>';
                                                        document.getElementById('massage').classList.add('text-danger');
                                                        document.getElementById('submitForm').disabled = true;
                                                    }
                                                })"
                                        
                                        type="file" name="icon" class="custom-file-input dropify" data-default-file="{{ asset($productSpecialType->icon) }}"
                                            data-height="80" data-allowed-file-extensions="png jpg jpeg gif json">
                                </div>
                                <div class="help-block">
                                    <small class="text-info"> Image aspect ratio should be in
                                        1:1 </small><br>
                                </div>
                                <div class="help-block"></div>
                                <small id="massage"></small>
                                @if ($errors->has('icon'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('icon') }} </small>
                                    </div>
                                @endif
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

    @if(!$productSpecialType)
        <h1>
            No Internet Gift Content Available
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
                    'default': 'Browse for an Image/Json File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image/Json file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        });

    </script>
@endpush
