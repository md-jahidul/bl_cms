@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', 'Edit Item Info')

@section('action')
    <a href="{{route('my-bl-services.items.index',$itemInfo->service->id)}}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row" id="my-bl-services-items"
                              action="{{ route("my-bl-services.items.update",$itemInfo->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" hidden value="{{$itemInfo->id}}" name="id">
                            <div class="form-group col-md-6">
                                <label for="title_en">Title En: <small
                                        class="text-danger">*</small> </label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title_en')?old('title_en'):$itemInfo->title_en}}" required
                                    id="title_en"
                                    type="text"
                                    class="form-control @error('title_en') is-invalid @enderror"
                                    placeholder="Title En" name="title_en">
                                <small
                                    class="text-danger"> @error('title_en') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_bn">Title Bn: <small
                                        class="text-danger">*</small> </label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title_bn')?old('title_bn'):$itemInfo->title_bn}}" required
                                    id="title_bn"
                                    type="text"
                                    class="form-control @error('title_bn') is-invalid @enderror"
                                    placeholder="Title Bn" name="title_bn">
                                <small
                                    class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>


                            <div class="form-group col-md-6 mb-2">
                                <label for="alt_text" class="required">Alt Text: </label>
                                <input required
                                       maxlength="200"
                                       data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                       data-validation-regex-message="Alt Text must start with alphabets"
                                       data-validation-maxlength-message="Alt Text can not be more then 200 Characters"
                                       value="{{$itemInfo->alt_text}}" id="alt_text" type="text"
                                       class="form-control @error('alt_text') is-invalid @enderror"
                                       placeholder="Alt text" name="alt_text">
                                <small
                                    class="text-danger"> @error('alt_text') {{ $message }} @enderror </small>
                                <div class="help-block"></div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select value="{{$itemInfo->status}}"
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($itemInfo->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($itemInfo->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="is_highlight">Is Highlight:</label>
                                    <select value="{{$itemInfo->status}}"
                                            class="form-control" id="is_highlight"
                                            name="is_highlight">
                                        <option value="1"
                                                @if($itemInfo->is_highlight == "1") selected @endif>
                                            True
                                        </option>
                                        <option value="0"
                                                @if($itemInfo->is_highlight == "0") selected @endif>
                                            False
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="deeplink" class="required">Deeplink</label>
                                    <input type="text" name="deeplink" class="form-control" required
                                           value="{{ $itemInfo->deeplink }}" placeholder="Enter Valid Deeplink">
                                    <small
                                        class="text-danger"> @error('deeplink') {{ $message }} @enderror </small>
                                    <small id="message"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image"> Icon url :</label>
                                    <input
                                        value="{{old('image_url')?old('image_url'):$itemInfo->image_url}}"
                                        id="image_url"
                                        type="text" class="form-control @error('image_url') is-invalid @enderror"
                                        placeholder="Image URL" name="image_url">
                                    <small
                                        class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                    <small id="message"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tags">Tags </label>
                                    <div class="edit-on-delete form-control">
                                        {{ $itemInfo->tags }}
                                    </div>
                                    <small class="info">Press Enter or Comma to create a new search tag, Backspace or
                                        Delete to remove the last one.</small>
                                </div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                <label for="title" class="">Android Version Code</label>
                                <input type="text" name="android_version_code" class="form-control"
                                       placeholder="Enter Version Code" value="{{ $itemInfo->android_version_code }}">
                                <div class="help-block"></div>
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                <div class="help-block"></div>
                                @if ($errors->has('android_version_code'))
                                    <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                <label for="title" class="">iOS Version Code</label>
                                <input type="text" name="ios_version_code" class="form-control"
                                       placeholder="Enter Version Code" value="{{ $itemInfo->ios_version_code }}">
                                <div class="help-block"></div>
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                <div class="help-block"></div>
                                @if ($errors->has('ios_version_code'))
                                    <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
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

    @if(!$itemInfo)
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
    <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/tags/tagging.css')}}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/tags/tagging.css')}}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('app-assets')}}/vendors/js/forms/tags/tagging.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/forms/tags/tagging.js" type="text/javascript"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
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
