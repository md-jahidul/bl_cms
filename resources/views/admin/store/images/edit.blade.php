@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', 'Edit Image Info')

@section('action')
    <a href="{{route('appslider.images.index',$imageInfo->slider_id)}}" class="btn btn-info btn-glow px-2">
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
                              action="{{ route("appslider.images.update",$imageInfo->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" hidden value="{{$imageInfo->id}}" name="id">


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
                                        value="{{$imageInfo->alt_text}}" id="alt_text" type="text"
                                        class="form-control @error('alt_text') is-invalid @enderror"
                                        placeholder="Alt text" name="alt_text">
                                <small
                                        class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="required">Upload Image :</label>
                                    @if (isset($imageInfo))
                                        <input type="file"
                                               id="image_url"
                                               class="dropify_image"
                                               name="image_url"
                                               data-height="70"
                                               data-default-file="{{ asset($imageInfo->image_url) }}"
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

            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        });
    </script>

@endpush
