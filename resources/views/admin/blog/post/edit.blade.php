@extends('layouts.admin')
@section('title_en', 'Blog Post Edit')
@section('card_name', 'Blog Post')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('blog-post') }}">Blog Post List</a></li>
    <li class="breadcrumb-item active"> Blog Post Edit</li>
@endsection
@section('action')
    <a href="{{ url('blog-post') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('blog-post.update', $blogPost->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $blogPost->id }}">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ old("title_en") ? old("title_en") : $blogPost->title_en }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ old("title_bn") ? old("title_bn") : $blogPost->title_bn }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('date') ? ' error' : '' }}">
                                    <label for="date" class="required">Date</label>
                                    <input type="text" id="date" name="date" class="form-control" placeholder="YYYY-MM-DD"
                                           value="{{ old("date") ? old("date") : $blogPost->date }}"
                                           required data-validation-required-message="Enter date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('date'))
                                        <div class="help-block">  {{ $errors->first('date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image') ? ' error' : '' }}">
                                    <label for="thumbnail_image">Thumbnail Image</label>
                                    <input type="file" name="thumbnail_image" class="form-control dropify" data-height="90" placeholder="DD-MM-YYYY"
                                           data-default-file="{{ config('filesystems.file_base_url') . $blogPost->thumbnail_image }}"
                                           value="{{ old("thumbnail_image") ? old("thumbnail_image") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('media_news_category_id') ? ' error' : '' }}">
                                    <label for="media_news_category_id" class="required">Select Blog Category</label>
                                    <select class="form-control" name="media_news_category_id" aria-invalid="false">
                                        <option value="">Select a blog category</option>
                                        @foreach ( $categories as $category)
                                            <option value="{{$category->id}}" @if ($category->id === $blogPost->media_news_category_id)
                                                selected
                                            @endif>{{$category->title_en}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('media_news_category_id'))
                                        <div class="help-block">  {{ $errors->first('media_news_category_id') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('read_time') ? ' error' : '' }}">
                                    <label for="read_time" class="">Read Time</label>
                                    <input type="number" id="read_time" name="read_time" class="form-control" placeholder="Enter read time"
                                           value="{{ $blogPost->read_time }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('read_time'))
                                        <div class="help-block">  {{ $errors->first('read_time') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('short_details_en') ? ' error' : '' }}">
                                    <label for="short_details_en">Short Description En</label>
                                    <textarea type="text" name="short_details_en"  class="form-control summernote_editor"
                                              placeholder="Enter short description in English" required rows="3">{{ old("short_details_en") ? old("short_details_en") : $blogPost->short_details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_en'))
                                        <div class="help-block">  {{ $errors->first('short_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('short_details_bn') ? ' error' : '' }}">
                                    <label for="short_details_bn">Short Description BN</label>
                                    <textarea type="text" name="short_details_bn"  class="form-control summernote_editor"
                                              placeholder="Enter short description in Bangla" required rows="3">{{ old("short_details_bn") ? old("short_details_bn") : $blogPost->short_details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('short_details_bn'))
                                        <div class="help-block">  {{ $errors->first('short_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('details_btn_en') ? ' error' : '' }}">
                                    <label for="details_btn_en">Details Button En</label>
                                    <input type="text" name="details_btn_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ old("details_btn_en") ? old("details_btn_en") : $blogPost->details_btn_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_btn_en'))
                                        <div class="help-block">  {{ $errors->first('details_btn_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('details_btn_bn') ? ' error' : '' }}">
                                    <label for="details_btn_bn">Details Button Bn</label>
                                    <input type="text" name="details_btn_bn"  class="form-control" placeholder="Enter button label in Bangla"
                                           value="{{ old("details_btn_bn") ? old("details_btn_bn") : $blogPost->details_btn_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_btn_bn'))
                                        <div class="help-block">  {{ $errors->first('details_btn_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                    <label for="tag_en">Tag En</label>
                                    <input type="text" name="tag_en"  class="form-control" placeholder="Enter tag in English"
                                           value="{{ old("tag_en") ? old("tag_en") : $blogPost->tag_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_en'))
                                        <div class="help-block">  {{ $errors->first('tag_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                    <label for="tag_bn">Tag Bn</label>
                                    <input type="text" name="tag_bn"  class="form-control" placeholder="Enter tag in Bangla"
                                           value="{{ old("tag_bn") ? old("tag_bn") : $blogPost->tag_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_bn'))
                                        <div class="help-block">  {{ $errors->first('tag_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug_en') ? ' error' : '' }}">
                                    <label class="required"> URL EN</label>
                                    <input type="text" class="form-control slug-convert" name="url_slug_en"
                                           placeholder="URL EN" id="url_slug_en" value="{{ old("url_slug_en") ? old("url_slug_en") : $blogPost->url_slug_en }}">
                                    <small class="text-info">
                                        <strong>i.e:</strong> najat-app (no spaces and slash)<br>
                                    </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('url_slug_en'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('url_slug_en') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                    <label class="required"> URL BN </label>
                                    <input type="text" class="form-control slug-convert" name="url_slug_bn"
                                           placeholder="URL BN" value="{{ old("url_slug_bn") ? old("url_slug_bn") : $blogPost->url_slug_bn }}">
                                    <small class="text-info">
                                        <strong>i.e:</strong> নাজাত-অ্যাপ (no spaces and slash)<br>
                                    </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('url_slug_bn'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('url_slug_bn') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Page Header</label>
                                    <textarea name="page_header" class="form-control" rows="4">{{ isset($blogPost) ? $blogPost->page_header : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Page Header BN</label>
                                    <textarea name="page_header_bn" class="form-control" rows="4">{{ isset($blogPost) ? $blogPost->page_header_bn : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Schema Markup</label>
                                    <textarea name="schema_markup" class="form-control" rows="4">{{ isset($blogPost) ? $blogPost->schema_markup : '' }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" id="show_in_home">
                                        <label for="trending"></label><br>
                                        <input type="checkbox" name="show_in_home" id="showInHome"
                                               value="1" {{ $blogPost->show_in_home == 1 ? 'checked' : '' }}>
                                        <label for="showInHome" class="ml-1">Show In Home</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $blogPost->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive" {{ $blogPost->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
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
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
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
