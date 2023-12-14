@extends('layouts.admin')
@section('title', 'Add VAS Product')
@section('card_name',"Add VAS Product" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add VAS Product</li>
@endsection
@section('action')
    <a href="{{route('vas-products.index')}}" class="btn btn-info btn-glow px-2">
        VAS Product List
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
                        <form novalidate class="form row" action="{{route('vas-products.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="partner_id" class="required">Partner id:</label>
                                        <input
                                            data-validation-required-message="Partner ID is required"
                                            value="@if(old('partner_id')) {{old('partner_id')}} @endif" required id="partner_id"
                                            type="text" class="form-control @error('title_en') is-invalid @enderror"
                                            placeholder="Partner Id" name="partner_id">
                                        <div class="help-block"></div>
                                        @if ($errors->has('partner_id'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('partner_id') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="cp_id" class="required">CP id:</label>
                                        <input
                                            data-validation-required-message="CP ID is required"
                                            value="@if(old('cp_id')) {{old('cp_id')}} @endif" required id="cp_id"
                                            type="text" class="form-control @error('cp_id') is-invalid @enderror"
                                            placeholder="CP ID" name="cp_id">
                                        <div class="help-block"></div>
                                        @if ($errors->has('cp_id'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('cp_id') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_en" class="required">Title (EN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title_en')) {{old('title_en')}} @endif" required id="title_en"
                                            type="text" class="form-control @error('title_en') is-invalid @enderror"
                                            placeholder="Title in English" name="title_en">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('title_en') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_bn" class="required">Title (BN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-required-message="Title is required"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title_bn')) {{old('title_bn')}} @endif" required id="title_bn"
                                            type="text" class="form-control @error('title_bn') is-invalid @enderror"
                                            placeholder="Title in Bangla" name="title_bn">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('title_bn') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="desc_en" class="">Description (EN):</label>
                                        <textarea
                                            class="form-control"
                                            placeholder="Description in English" name="desc_en"> @if(old('desc_en')) {{old('desc_en')}} @endif</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('desc_en'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('desc_en') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="desc_bn" class="">Description (BN):</label>
                                        <textarea
                                            class="form-control"
                                            placeholder="Description in Bangla" name="desc_bn"> @if(old('desc_bn')) {{old('desc_bn')}} @endif</textarea>
                                        <div class="help-block"></div>
                                        @if ($errors->has('desc_bn'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('desc_bn') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="price" class="required">Price:</label>
                                        <input
                                            data-validation-required-message="Title is required"
                                            value="@if(old('price')) {{old('price')}} @endif" required id="price"
                                            type="number" class="form-control @error('price') is-invalid @enderror"
                                            placeholder="Product Price" name="price" step="0.01">
                                        <div class="help-block"></div>
                                        @if ($errors->has('price'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('price') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="platform" class="required">Platform:</label>
                                            <select class="form-control" id="platform"
                                                    name="platform">
                                                <option value="SDP"> SDP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="validity_en" class="required">Validity (EN):</label>
                                        <input
                                            data-validation-required-message="Validity is required"
                                            value="@if(old('validity_en')) {{old('validity_en')}} @endif" required id="validity_en"
                                            type="text" class="form-control @error('validity_en') is-invalid @enderror"
                                            placeholder="Validity in English" name="validity_en">
                                        <div class="help-block"></div>
                                        @if ($errors->has('validity_en'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('validity_en') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="validity_bn" class="required">Validity (BN):</label>
                                        <input
                                            data-validation-required-message="Validity is required"
                                            value="@if(old('validity_bn')) {{old('validity_bn')}} @endif" required id="validity_bn"
                                            type="text" class="form-control @error('validity_bn') is-invalid @enderror"
                                            placeholder="Validity in Bangla" name="validity_bn">
                                        <div class="help-block"></div>
                                        @if ($errors->has('validity_bn'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('validity_bn') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="activation_type" class="required">Activation type:</label>
                                        <input
                                            data-validation-required-message="Activation type is required"
                                            value="@if(old('activation_type')) {{old('activation_type')}} @endif" required id="activation_type"
                                            type="text" class="form-control @error('validity_en') is-invalid @enderror"
                                            placeholder="Activation type" name="activation_type">
                                        <div class="help-block"></div>
                                        @if ($errors->has('activation_type'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('activation_type') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="deactivation_type" class="required">Deactivation type:</label>
                                        <input
                                            data-validation-required-message="Deactivation type is required"
                                            value="@if(old('deactivation_type')) {{old('deactivation_type')}} @endif" required id="deactivation_type"
                                            type="text" class="form-control @error('deactivation_type') is-invalid @enderror"
                                            placeholder="Deactivation type" name="deactivation_type">
                                        <div class="help-block"></div>
                                        @if ($errors->has('deactivation_type'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('deactivation_type') }} </small>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="is_renewal">Is Renewal:</label>
                                            <select class="form-control" id="is_renewal"
                                                    name="is_renewal">
                                                <option value="1"> Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
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

                                    <div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }}">
                                        <label for="image" class="required">Image</label>
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
                                                type="file" name="image" class="custom-file-input dropify"
                                                    required data-validation-required-message="Image field is required" data-height="80" data-allowed-file-extensions="png jpg jpeg gif json">
                                        </div>
                                        <div class="help-block">
                                            <small class="text-info"> Image aspect ratio should be in
                                                1:1 </small><br>
                                        </div>
                                        <div class="help-block"></div>
                                        <small id="massage"></small>
                                        @if ($errors->has('image'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('image') }} </small>
                                            </div>
                                        @endif
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
                    'default': 'Browse for an Image/Json File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image/Json file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        })
    </script>
@endpush
