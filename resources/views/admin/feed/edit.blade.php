@extends('layouts.admin')
@section('title', 'Edit Feed')
@section('card_name',"Feed" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Feed</li>
@endsection
@section('action')
    <a href="{{route('feeds.index')}}" class="btn btn-primary btn-glow px-2">
        Back To Feed list
    </a>
@endsection

@php
    $general = \App\Enums\FeedType::GENERAL;
    $youtube = \App\Enums\FeedType::YOUTUBE;
    $facebook = \App\Enums\FeedType::FACEBOOK;
@endphp

@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="mb-1">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="radio" name="feed_type" value="general" id="general" {{ $feed->type === 'general' ? 'checked' : 'disabled' }}>
                                <label for="general" class="mr-3">General</label>
                                <input type="radio" name="feed_type" value="youtube" id="youtube" {{ $feed->type === 'youtube' ? 'checked' : 'disabled' }}>
                                <label for="youtube" class="mr-3">Youtube</label>
                                <input type="radio" name="feed_type" value="facebook" id="facebook" {{ $feed->type === 'facebook' ? 'checked' : 'disabled' }}>
                                <label for="facebook" class="mr-3">Facebook</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="feed-form" novalidate class="form row" action="{{route('feeds.update', $feed->id)}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="type" name="type" value="{{\App\Enums\FeedType::GENERAL}}">
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="category">Category:</label>
                                        <select id="category" name="category_id"
                                                class="browser-default custom-select">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $feed->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title" class="required">Title:</label>
                                        <input required
                                               maxlength="200"
                                               data-validation-required-message="Title is required" data-validation-maxlength-message="Title can not be more then 200 Characters"

                                               value="{{ old('title') ? old('title') : $feed->title }}" id="title"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Title" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>


                                    <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                        <label for="start-date">Start Date:</label>
                                        <div class='input-group'>
                                            <input type='text' class="form-control" name="start_date" id="start-date"
                                                   placeholder="Please select start date"
                                                   value="{{ $feed->start_date->toDateTimeString() }}"
                                                   autocomplete="off"/>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('start_date'))
                                            <div class="help-block">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                        <label for="end-date">End Date:</label>
                                        <input type="text" name="end_date" id="end-date" class="form-control"
                                               placeholder="Please select end date"
                                               value="{{ $feed->end_date ?  $feed->end_date->toDateTimeString() : '' }}" autocomplete="off">
                                        <div class="help-block"></div>
                                        @if ($errors->has('end_date'))
                                            <div class="help-block">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>

                                    <div id="video-input" class="form-group col-md-6 mb-2">
                                        <label for="video_url">Video Url: </label>
                                        <input data-validation-regex-regex="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$" data-validation-regex-message="Please insert valid url" value="{{ old("video_url") ? old("video_url") : $feed->video_url }}" id="video_url"
                                               type="text" class="form-control @error('video_url') is-invalid @enderror"
                                               placeholder="Video Url" name="video_url">
                                        <small
                                            class="text-danger"> @error('video_url') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div id="audio-input" class="form-group col-md-6 mb-2">
                                        <label for="audio_url">Audio Url: </label>
                                        <input data-validation-regex-regex="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$" data-validation-regex-message="Please insert valid url" value="{{ old("audio_url") ? old("audio_url") : $feed->audio_url }}" id="audio_url"
                                               type="text" class="form-control @error('audio_url') is-invalid @enderror"
                                               placeholder="Audio Url" name="audio_url">
                                        <small
                                            class="text-danger"> @error('audio_url') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div id="image-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_url">Upload Image :</label>
                                            <input type="file"
                                                   id="image_url"
                                                   name="image_url"
                                                   class="dropify_image"
                                                   data-allowed-file-extensions="png jpg gif"
                                                   data-default-file="{{ asset($feed->image_url) }}"/>
                                            <div class="help-block"></div>
                                            <small
                                                class="text-danger"> @error('image_url') {{ $message }} @enderror </small>
                                            <small id="massage"></small>
                                        </div>
                                    </div>
                                    {{--<div id="file-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="file">Upload File :</label>
                                            <input type="file"
                                                   id="file"
                                                   name="file"
                                                   data-allowed-file-extensions="pdf doc docx xlx"
                                                   class="dropify_file" data-default-file="{{ asset($feed->file) }}"/>
                                            <div class="help-block"></div>
                                            <small class="text-danger"> @error('file') {{ $message }} @enderror </small>
                                            <small id="massage"></small>
                                        </div>
                                    </div>--}}

                                    <div id="post-input" class="form-group col-md-6 mb-2">
                                        <label for="post_url" class="required">Video Url: </label>
                                        <input data-validation-regex-regex="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$" data-validation-regex-message="Please insert valid url" value="{{ old("post_url") ? old("post_url") : $feed->post_url }}" id="post_url"
                                               type="text" class="form-control @error('post_url') is-invalid @enderror"
                                               placeholder="Video Url" name="post_url">
                                        <small
                                            class="text-danger"> @error('post_url') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="description">Description: </label>
                                        <textarea required rows="10" id="description" name="description"
                                                  class="form-control js_editor_box @error('description') is-invalid @enderror"
                                                  placeholder="Description"
                                                  name="order">{{ old('description') ? old('description') : $feed->description }}</textarea>
                                        <small
                                            class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    {{--<div class="form-group col-md-6 mb-2">
                                        <label for="availability_input">Availability: </label>
                                        <div
                                            class="form-group {{ $errors->has('availability') ? ' error' : '' }}">

                                            @foreach(\App\Enums\FeedAvailability::toArray() as $key => $value)
                                                <label style="margin-right: 10px">
                                                    @if($key === 'GUEST')
                                                        <input minchecked="1"
                                                               data-validation-minchecked-message="Please choose minimum one"
                                                               type="checkbox" name="availability[]"
                                                               value="{{$value}}" class="custom-input">
                                                        {{$key}}
                                                    @else
                                                        <input type="checkbox" name="availability[]"
                                                               value="{{$value}}" class="custom-input">
                                                        {{$key}}
                                                    @endif
                                                </label>
                                            @endforeach

                                            @if ($errors->has('availability'))
                                                <div
                                                    class="help-block">  {{ $errors->first('availability') }}</div>
                                            @endif
                                            <div class="help-block"></div>
                                        </div>
                                    </div>--}}

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input">Status: </label>
                                        <div
                                            class="form-group {{ $errors->has('status') ? ' error' : '' }}">

                                            <input type="radio" name="status" value="1" id="input-radio-15" {{ $feed->status == 1 ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input type="radio" name="status" value="0" id="input-radio-16" {{ $feed->status == 0 ? 'checked' : '' }}>
                                            <label for="input-radio-16" class="mr-3">Inactive</label>

                                            @if ($errors->has('status'))
                                                <div
                                                    class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button style="float: right" type="submit" id="submitForm"
                                                class="btn btn-success round px-2">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>
                                        <button style="float: right; margin-right: 20px;" type="reset" id="resetForm"
                                                class="btn btn-warning round px-2">
                                            <i class="la la-rotate-left"></i> Reset
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
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

    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script>
        $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#start-date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
            });
            $('#end-date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false,
                showClose: true,
            });
        });

        $("#post-input").hide();
        $(document).ready(function(){
            formHandler();

            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });

            $('.dropify_file').dropify({
                messages: {
                    'default': 'Browse for an File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct File'
                },
                error: {
                    'imageFormat': 'The file must be valid format'
                }
            });

            $('.js_editor_box').each(function(k, v){
                $(this).summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        // ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen', 'codeview']]
                    ],
                    height:200
                });
            });
        });
        function formHandler() {
            let type = $("input[name='feed_type']:checked").val();

            if (type === 'general') {
                let mainType = "{{ $general }}";
                $("#type").val(mainType);
                $("#image-input").show();
                $("#file-input").show();
                $("#video-input").show();
                $("#audio-input").show();
                $("#post-input").hide();
            }
            if (type === 'youtube') {
                let mainType = "{{ $youtube }}";
                $("#type").val(mainType);
                $("#video-input").show();
                $("#image-input").hide();
                $("#file-input").hide();
                $("#audio-input").hide();
                $("#post-input").hide();
            }
            if (type === 'facebook') {
                let mainType = "{{ $facebook }}";
                $("#type").val(mainType);
                $("#image-input").show();
                $("#file-input").hide();
                $("#video-input").hide();
                $("#audio-input").hide();
                $("#post-input").show();
            }
        }
    </script>

@endpush
