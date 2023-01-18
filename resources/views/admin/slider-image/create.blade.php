@extends('layouts.admin')
@section('title', 'Slider Image Create')
@section('card_name', 'Slider Image Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('single-sliders')}}"> Slider List</a></li>
    <li class="breadcrumb-item active"> <a href="{{ route('slider_images', [$sliderId, $type]) }}"> Slider Image List</a></li>
    <li class="breadcrumb-item active"> Slider Image Create</li>
@endsection
@section('action')
    <a href="{{ route('slider_images', [$sliderId, $type]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title">{{ ucwords($type) }} sliders image create</h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('slider_image_store', [$sliderId, $type]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               placeholder="Please select start date" />
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                           placeholder="Please select end date"
                                           value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="off">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif

                                    <br>

                                    <div class="form-group {{ $errors->has('alt_text') ? ' error' : '' }}">
                                        <label for="alt_text" class="required">Alt Text EN</label>
                                        <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text en"
                                               required data-validation-required-message="Enter alt text en"
                                               value="{{ old("alt_text") ? old("alt_text") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('alt_text'))
                                            <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                        @endif
                                    </div>

                                </div>


                                <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Slider Image (Desktop View)</label>
                                    <div class="custom-file">
                                        <input type="file" name="image_url" class="custom-file-input dropify" data-height="80"  required data-validation-required-message="Slider Image (Desktop View) is required">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, .svg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('mobile_view_img') ? ' error' : '' }}">
                                    <label for="mobileImg">Slider Image (Mobile View)</label>
                                    <div class="custom-file">
                                        <input type="file" name="mobile_view_img" class="custom-file-input dropify" data-height="80" required data-validation-required-message="Slider Image (Mobile View) is required">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, .svg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('mobile_view_img'))
                                        <div class="help-block">  {{ $errors->first('mobile_view_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label class="required">Alt Text BN</label>
                                    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Enter alt text bn"
                                           required data-validation-required-message="Enter alt text bn"
                                           value="{{ old("alt_text_bn") ? old("alt_text_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('image_name') ? ' error' : '' }}">
                                    <label class="required">Image Name EN</label>
                                    <input type="text" name="image_name"  class="form-control" placeholder="Enter image name en"
                                           required data-validation-required-message="Enter image name en"
                                           value="{{ old("image_name") ? old("image_name") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name'))
                                        <div class="help-block">  {{ $errors->first('image_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label class="required">Image Name BN</label>
                                    <input type="text" name="image_name_bn"  class="form-control" placeholder="Enter image name en"
                                           required data-validation-required-message="Enter image name en"
                                           value="{{ old("image_name_bn") ? old("image_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>


                                @include('layouts.partials.slider_types.'.$type )

                                <div class="col-md-4">
                                    <label for="alt_text"></label>
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
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

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>
        $(function () {
            $("textarea#details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:150
            })

            $('.dropify').dropify({
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







