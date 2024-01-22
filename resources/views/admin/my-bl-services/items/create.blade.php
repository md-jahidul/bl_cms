@extends('layouts.admin')
@section('title', 'Add Items')
@section('card_name',"Items" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Items</li>
@endsection
@section('action')
    <a href="{{route('my-bl-services.items.index',$service_information->id)}}" class="btn btn-info btn-glow px-2">
        Item list
    </a>
    <a href="{{route('my-bl-services.index')}}" class="btn btn-primary btn-glow px-2">
        Service list
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
                        <form novalidate class="form row" id="my-bl-services-items"
                              action="{{route('my-bl-services.items.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" hidden value="{{$service_information->id}}" name="my_bl_service_id">
                            <input type="hidden" hidden name="sequence">
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_en" class="required">Title En:</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title_en')) {{old('title_en')}} @endif" required
                                            id="title_en"
                                            type="text" class="form-control @error('title_en') is-invalid @enderror"
                                            placeholder="Title En" name="title_en">
                                        <small class="text-danger"> @error('title_en') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_bn" class="required">Title Bn:</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Title must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('title_bn')) {{old('title_bn')}} @endif" required
                                            id="title_bn"
                                            type="text" class="form-control @error('title_bn') is-invalid @enderror"
                                            placeholder="Title Bn" name="title_bn">
                                        <small class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="alt_text" class="required">Alt Text: </label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-regex-message="Alt Text must start with alphabets"
                                            data-validation-maxlength-message="Alt Text can not be more then 200 Characters"
                                            value="@if(old('alt_text')) {{old('alt_text')}} @endif" id="alt_text"
                                            type="text" class="form-control @error('alt_text') is-invalid @enderror"
                                            placeholder="Alt text" name="alt_text" required>
                                        <small class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="is_highlight">Is Highlight:</label>
                                            <select class="form-control" id="is_highlight"
                                                    name="is_highlight">
                                                <option value="1"> Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Deeplink</label>
                                            <input type="text" name="deeplink" class="form-control"
                                                   placeholder="Enter Valid Deeplink">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="image_url">Image url:</label>
                                        <input
                                            value="@if(old('image_url')) {{old('image_url')}} @endif"
                                            id="image_url"
                                            type="text"
                                            class="form-control @error('image_url') is-invalid @enderror"
                                            placeholder="Image URL" name="image_url">
                                        <small
                                            class="text-danger"> @error('image_url') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="tags">Tags </label>
                                            <div class="edit-on-delete form-control" id="tags"></div>
                                            <small class="info">Press Enter or Comma to create a new search tag,
                                                Backspace or Delete to remove the last one.</small>
                                        </div>
                                    </div>

                                    <div
                                        class="form-group col-md-6 mb-2 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                        <label for="title" class="">Android Version Code</label>
                                        <input type="text" name="android_version_code" class="form-control"
                                               placeholder="Enter Version Code">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('android_version_code'))
                                            <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                        @endif
                                    </div>
                                    <div
                                        class="form-group col-md-6 mb-2 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                        <label for="title" class="">iOS Version Code</label>
                                        <input type="text" name="ios_version_code" class="form-control"
                                               placeholder="Enter Version Code">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('ios_version_code'))
                                            <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                        @endif
                                    </div>
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
@endsection

@push('style')

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/tags/tagging.css')}}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
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
    <script src="{{asset('app-assets')}}/vendors/js/forms/tags/tagging.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/forms/tags/tagging.js" type="text/javascript"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>
        $('#my-bl-services-items').submit(function (event) {
            let tags = [];
            event.preventDefault();
            $("input[name='tag[]']").each(function () {
                let value = $(this).val();
                if (value) {
                    tags.push(value);
                }
            });
            $(this).unbind('submit').submit();
        });
    </script>

@endpush
