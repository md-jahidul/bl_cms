@extends('layouts.admin')
@section('title', 'Add Content')
@section('card_name',"Content" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Content</li>
@endsection
@section('action')
    <a href="{{route('internet-gift-content.index')}}" class="btn btn-info btn-glow px-2">
        Content list
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
                        <form novalidate class="form row" action="{{route('internet-gift-content.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="name_en" class="required">Name(EN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Name must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('name_en')) {{old('name_en')}} @endif" required id="name_en"
                                            type="text" class="form-control @error('name_en') is-invalid @enderror"
                                            placeholder="Title in English" name="name_en">
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
                                            value="@if(old('name_bn')) {{old('name_bn')}} @endif" required id="name_bn"
                                            type="text" class="form-control @error('name_bn') is-invalid @enderror"
                                            placeholder="Title in Bangla" name="name_bn">
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
                                            <select class="form-control" id="status"
                                                    name="status">
                                                <option value="1"> Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }}">
                                        <label for="icon" class="required">Icon</label>
                                        <div class="custom-file">
                                            <input type="file" name="icon" class="custom-file-input dropify"
                                                    required data-validation-required-message="Icon field is required" data-height="80">
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('icon'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('icon') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('banner') ? ' error' : '' }}">
                                        <label for="banner" class="">Banner</label>
                                        <div class="custom-file">
                                            <input type="file" name="banner" class="custom-file-input dropify" data-height="80">
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('banner'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('banner') }} </small>
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
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>
@endpush
