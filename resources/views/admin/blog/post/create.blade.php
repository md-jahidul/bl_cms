@extends('layouts.admin')
@section('title_en', 'Blog Post Create')
@section('card_name', 'Blog')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('press-news-event') }}">Blog Post List</a></li>
    <li class="breadcrumb-item active"> Blog Post Create</li>
@endsection
@section('action')
    <a href="{{ url('press-news-event') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('blog-post.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('type') ? ' error' : '' }}">--}}
{{--                                    <label for="type" class="required">Type</label>--}}
{{--                                    <select class="form-control" name="type" id="offer_type"--}}
{{--                                            required data-validation-required-message="Please select type">--}}
{{--                                        <option value="">---Select Type---</option>--}}
{{--                                        <option data-alias="latest_news" value="latest_news">Latest News</option>--}}
{{--                                        <option data-alias="featured_topics" value="featured_topics">Featured Topics</option>--}}
{{--                                        <option data-alias="news_archive" value="news_archive">News Archive</option>--}}
{{--                                    </select>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('type'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('type') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('date') ? ' error' : '' }}">
                                    <label for="date" class="required">Date</label>
                                    <input type="text" id="date" name="date" class="form-control" placeholder="YYYY-MM-DD"
                                           value="{{ old("date") ? old("date") : '' }}"
                                           required data-validation-required-message="Enter date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('date'))
                                        <div class="help-block">  {{ $errors->first('date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image') ? ' error' : '' }}">
                                    <label for="thumbnail_image" class="required">Thumbnail Image</label>
                                    <input type="file" name="thumbnail_image" class="form-control dropify" data-height="90" placeholder="DD-MM-YYYY"
                                           value="{{ old("thumbnail_image") ? old("thumbnail_image") : '' }}"
                                           required data-validation-required-message="Enter thumbnail_image">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">--}}
{{--                                    <label for="alt_text_en" class="">Alt Text</label>--}}
{{--                                    <input type="text" id="alt_text_en" name="alt_text_en" class="form-control" placeholder="Enter alt text"--}}
{{--                                           value="{{ old("alt_text_en") ? old("alt_text_en") : '' }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('alt_text_en'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('short_details_en') ? ' error' : '' }}">
                                    <label for="short_details_en" class="required">Short Description En</label>
                                    <textarea type="text" name="short_details_en"  class="form-control summernote_editor" placeholder="Enter short description in English" required rows="3"
                                              data-validation-required-message="Enter short description in English">{{ old("short_details_en") ? old("short_details_en") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_en'))
                                        <div class="help-block">  {{ $errors->first('short_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_bn') ? ' error' : '' }}">
                                    <label for="short_details_bn" class="required">Short Description BN</label>
                                    <textarea type="text" name="short_details_bn"  class="form-control summernote_editor" placeholder="Enter short description in Bangla" required rows="3"
                                              data-validation-required-message="Enter short description in Bangla">{{ old("short_details_bn") ? old("short_details_bn") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_bn'))
                                        <div class="help-block">  {{ $errors->first('short_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" id="show_in_home">
                                        <label for="trending"></label><br>
                                        <input type="checkbox" name="show_in_home" value="1" id="trending">
                                        <label for="trending" class="ml-1">Show In Home</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
{{--    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            var date = new Date();
            date.setDate(date.getDate());
            $('#date').datetimepicker({
                format : 'YYYY-MM-DD',
                showClose: true,
            });
        });
    </script>
@endpush






