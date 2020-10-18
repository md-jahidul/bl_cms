@extends('layouts.admin')
@section('title', 'Add Image')
@section('card_name',"Image" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Image</li>
@endsection
@section('action')
    <a href="{{route('appslider.images.index',$slider_information->id)}}" class="btn btn-info btn-glow px-2">
        Image list
    </a>
    <a href="{{route('appStore.index')}}" class="btn btn-primary btn-glow px-2">
        Slider list
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
                        <form novalidate class="form row" action="{{route('appslider.images.store')}}"   enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden"  value="{{$slider_information->id}}" name="store_app_id">
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title" class="required">Title:</label>
                                        <input
                                            required
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title')) {{old('title')}} @endif" required id="title"
                                            type="text" class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Title" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="alt_text">Alt Text: </label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-regex-message="Alt Text must start with alphabets"
                                            data-validation-maxlength-message="Alt Text can not be more then 200 Characters"
                                            value="@if(old('alt_text')) {{old('alt_text')}} @endif" id="alt_text"
                                            type="text" class="form-control @error('alt_text') is-invalid @enderror"
                                            placeholder="Alt text" name="alt_text">
                                        <small class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="required">Upload Image :</label>
                                            @if (isset($store))
                                                <input type="file"
                                                       id="image_url"
                                                       class="dropify_image"
                                                       name="image_url"
                                                       data-height="70"
                                                       data-default-file="{{ asset($store->image_url) }}"
                                                />
                                            @else
                                                <input type="file" required
                                                       id="image_url"
                                                       name="image_url"
                                                       data-height="70"
                                                       class="dropify_image"/>
                                            @endif
                                            <div class="help-block">
                                                <small class="text-danger"> @error('image_url'){{ $message }} @enderror </small>
                                            </div>
                                            <small id="massage"></small>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="is_active">Active Status:</label>
                                            <select class="form-control" id="is_active"
                                                    name="is_active">
                                                <option value="1"> Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
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
            $('.dropify_image').dropify({
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
