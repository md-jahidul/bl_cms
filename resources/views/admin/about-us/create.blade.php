@extends('layouts.admin')
@section('title', 'About Banglalink')
@section('card_name', 'About Banglalink')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('about-us') }}"> About Banglalink</a></li>
    <li class="breadcrumb-item active"> About Banglalink</li>
@endsection
@section('action')
    <a href="{{ url('about-us') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        @if(isset($about))
                            <form novalidate action="{{ route('about-us.update',$about->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @else
                                    <form novalidate action="{{ route('about-us.store') }}" method="post"
                                          enctype="multipart/form-data">
                                        @endif

                                        @csrf
                                        @if(isset($about))
                                            @method('put')

                                            @php

                                                $banglalink_info = $about->banglalink_info;
                                                $banglalink_info_bn = $about->banglalink_info_bn;
                                                $details_en = $about->details_en;
                                                $details_bn = $about->details_bn;

                                            @endphp
                                        @else
                                            @method('post')

                                            @php

                                                $banglalink_info = '';
                                                $banglalink_info_bn = '';
                                                $details_en = '';
                                                $details_bn = '';

                                            @endphp
                                        @endif


                                        <div class="row">

                                            <div
                                                class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                                <label for="title">Title (English)</label>
                                                <input type="text" name="title" class="form-control"
                                                       placeholder="Enter Title in English"
                                                       value="@if(isset($about)){{$about->title}} @elseif(old("title")) {{old("title")}} @endif">
                                                <div class="help-block"></div>
                                                @if ($errors->has('title'))
                                                    <div class="help-block">  {{ $errors->first('title') }}</div>
                                                @endif
                                            </div>

                                            <div
                                                class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                <label for="title_bn">Title (Bangla)</label>
                                                <input type="text" name="title_bn" class="form-control"
                                                       placeholder="Enter Title in Bangla"
                                                       value="@if(isset($about)){{$about->title_bn}} @elseif(old("title_bn")) {{old("title_bn")}} @endif">
                                                <div class="help-block"></div>
                                                @if ($errors->has('title_bn'))
                                                    <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                                @endif
                                            </div>

                                            <div
                                                class="form-group col-md-6 {{ $errors->has('banglalink_info') ? ' error' : '' }}">
                                                <label for="banglalink_info" class="required">Short Description
                                                    (EN)</label>
                                                <textarea required
                                                          data-validation-required-message="Description (English) is required"
                                                          class="form-control" name="banglalink_info"
                                                          placeholder="Enter Description in English"
                                                          id="banglalink_info"
                                                          rows="4">{{ old("banglalink_info") ? old("banglalink_info") : $banglalink_info  }}</textarea>

                                                <div class="help-block"></div>
                                                @if ($errors->has('banglalink_info'))
                                                    <div
                                                        class="help-block">  {{ $errors->first('banglalink_info') }}</div>
                                                @endif
                                            </div>


                                            <div
                                                class="form-group col-md-6 {{ $errors->has('banglalink_info_bn') ? ' error' : '' }}">
                                                <label for="banglalink_info_bn" class="required">Short Description
                                                    (BN)</label>
                                                <textarea
                                                    required
                                                    data-validation-required-message="Description (Bangla) is required"
                                                    class="form-control" name="banglalink_info_bn"
                                                    placeholder="Enter Description in Bangla" id="banglalink_info_bn"
                                                    rows="4">{{ old("banglalink_info_bn") ? old("banglalink_info_bn") : $banglalink_info_bn }}</textarea>

                                                <div class="help-block"></div>
                                                @if ($errors->has('banglalink_info_bn'))
                                                    <div
                                                        class="help-block">  {{ $errors->first('banglalink_info_bn') }}</div>
                                                @endif
                                            </div>


                                            <div
                                                class="form-group col-md-6 {{ $errors->has('banglalink_info_bn') ? ' error' : '' }}">
                                                <label for="Details">Details (EN)</label>
                                                <textarea class="form-control summernote_editor"
                                                          name="details_en">{{ old("details_en") ? old("details_en") : $details_en }}</textarea>
                                                <div class="help-block"></div>
                                                @if ($errors->has('details_en'))
                                                    <div class="help-block">  {{ $errors->first('details_en') }}</div>
                                                @endif
                                            </div>

                                            <div
                                                class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                                <label for="Details">Details (BN)</label>
                                                <textarea class="form-control summernote_editor"
                                                          name="details_bn">{{ old("details_bn") ? old("details_bn") : $details_bn }}</textarea>

                                                <div class="help-block"></div>
                                                @if ($errors->has('details_bn'))
                                                    <div class="help-block">  {{ $errors->first('details_bn') }}</div>
                                                @endif
                                            </div>


                                            <div
                                                class="form-group col-md-4 {{ $errors->has('content_image') ? ' error' : '' }}">
                                                <label for="alt_text">Content Image</label>
                                                <div class="custom-file">
                                                    <input type="file" name="content_image"
                                                           class="custom-file-input dropify" id="profile_image"
                                                           data-height="80"
                                                           data-default-file="{{ isset($about->content_image) ?  config('filesystems.file_base_url') . $about->content_image : null  }}">
                                                </div>
                                                <span class="text-primary">Please given file type (.png, .jpg)</span>
                                                <div class="help-block"></div>
                                                {{--@if ($errors->has('alt_text'))
                                                    <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                                @endif--}}
                                            </div>

                                            <div class="form-group col-md-6 {{ $errors->has('content_img_name') ? ' error' : '' }}">
                                    <label>Content Image Name EN</label>
                                    <input type="text" class="form-control" placeholder="Content image name en" name="content_img_name"
                                           value="@if(isset($about)){{$about->content_img_name}}@else {{old("content_img_name")}} @endif">
                                    @if($errors->has('content_img_name'))
                                        <div class="help-block text-danger">{{ $errors->first('content_img_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('content_img_name_bn') ? ' error' : '' }}">
                                    <label>Content Image Name BN</label>
                                    <input type="text" class="form-control" placeholder="Content image name bn" name="content_img_name_bn"
                                           value="@if(isset($about)){{$about->content_img_name_bn}}@else {{old("content_img_name_bn")}} @endif">
                                    @if($errors->has('content_img_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('content_img_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Content Alt Text En</label>
                                    <input type="text" class="form-control" placeholder="Content alt text en" name="content_img_alt_text"
                                           value="@if(isset($about)){{$about->content_img_alt_text}}@else {{old("content_img_alt_text")}} @endif">
                                    @if($errors->has('content_img_alt_text'))
                                        <div class="help-block text-danger">{{ $errors->first('content_img_alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Content Alt Text Bn</label>
                                    <input type="text" class="form-control" placeholder="Content alt text bn" name="content_img_alt_text_bn"
                                           value="@if(isset($about)){{$about->content_img_alt_text_bn}}@else {{old("content_img_alt_text_bn")}} @endif">
                                    @if($errors->has('content_img_alt_text_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('content_img_alt_text_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-4 {{ $errors->has('banner_image') ? ' error' : '' }}">
                                    <label for="alt_text">Banner Image (Web)</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_web_img"
                                               value="@if(isset($about)){{$about->banner_image}} @elseif(old("old_web_img")) {{old("old_web_img")}} @endif">
                                        <input type="file" name="banner_image"
                                               class="custom-file-input dropify" id="image" data-height="80"
                                               data-default-file="{{ isset($about->banner_image) ?  config('filesystems.file_base_url') . $about->banner_image : null  }}">
                                        {{--                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>--}}
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    {{--@if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif--}}
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('banner_image_mobile') ? ' error' : '' }}">
                                    <span>Banner image (Mobile)</span>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_mob_img"
                                               value="@if(isset($about)){{$about->banner_image_mobile}} @elseif(old("old_mob_img")) {{old("old_mob_img")}} @endif">
                                        <input type="file" name="banner_image_mobile"
                                               class="custom-file-input dropify"
                                               data-height="80"
                                               data-default-file="{{ isset($about->banner_image_mobile) ?  config('filesystems.file_base_url') . $about->banner_image_mobile : null  }}">
                                        {{--                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" name="alt_text" class="form-control"
                                           placeholder="Enter image alter text"
                                           value="@if(isset($about)){{$about->alt_text}} @else {{old("alt_text")}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="alt_text">Alt Text BN</label>
                                    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Enter image alter text bn"
                                           value="@if(isset($about)){{$about->alt_text_bn}} @else {{old("alt_text_bn")}} @endif">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name') ? ' error' : '' }}">
                                    <label>Banner Photo Name</label>
                                    <input type="hidden" name="old_banner_name" value="@if(isset($about)){{$about->banner_name}} @else {{old("old_banner_name")}} @endif">
                                    <input type="text" class="form-control" name="banner_name"
                                           value="@if(isset($about)){{$about->banner_name}} @else {{old("banner_name")}} @endif" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-us (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                    @if($errors->has('banner_name'))
                                        <div class="help-block text-danger">{{ $errors->first('banner_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                    <label>Banner Photo Name BN</label>
                                    <input type="text" class="form-control" name="banner_name_bn"
                                           value="@if(isset($about)){{$about->banner_name_bn}} @else {{old("banner_name_bn")}} @endif" placeholder="Photo Name Bn">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-us (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                    @if($errors->has('banner_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="name" class="required">Select Slug:</label>
                                    <select name="slug" required
                                            data-validation-required-message="Slug is required"
                                            class="browser-default custom-select">
                                        @if(isset($about))
                                            <option value="about-banglalink"
                                                    @if($about->slug == "about-banglalink") selected="selected" @endif>
                                                about-banglalink
                                            </option>
                                            <option value="about-veon"
                                                    @if($about->slug == "about-veon") selected="selected" @endif>
                                                about-veon
                                            </option>
                                        @else
                                            <option value="about-banglalink">about-banglalink</option>
                                            <option value="about-veon">about-veon</option>
                                        @endif

                                    </select>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Banner Photo Name</label>
                                    <input type="hidden" name="old_banner_name"
                                           value="@if(isset($about)){{$about->banner_name}} @else {{old("old_banner_name")}} @endif">
                                    <input type="text" class="form-control" name="banner_name"
                                           value="@if(isset($about)){{$about->banner_name}} @else {{old("banner_name")}} @endif"
                                           placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-us (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                    <label> URL EN (url slug) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                           value="@if(isset($about)){{$about->url_slug}} @else {{old("url_slug")}} @endif"
                                           required name="url_slug" placeholder="URL EN">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-us (no spaces)<br>
                                    </small>
                                    @if ($errors->has('url_slug'))
                                        <div
                                            class="help-block text-danger">{{ $errors->first('url_slug') }}</div>
                                    @endif
                                </div>

                                <div
                                    class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                    <label> URL BN (url slug) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                           value="@if(isset($about)){{$about->url_slug_bn}}@else{{old("url_slug_bn")}}@endif"
                                           required name="url_slug_bn" placeholder="URL BN">
                                    <small class="text-info">
                                        <strong>i.e:</strong> আমাদের-সম্পর্কে (no spaces)<br>
                                    </small>
                                    @if ($errors->has('url_slug_bn'))
                                        <div
                                            class="help-block text-danger">{{ $errors->first('url_slug_bn') }}</div>
                                    @endif
                                </div>

                                <div
                                    class="form-group col-md-4 {{ $errors->has('page_header') ? ' error' : '' }}">
                                    <label>Page Header EN (HTML)</label>
                                    <textarea class="form-control" rows="7"
                                              name="page_header">@if(isset($about)){{$about->page_header}} @else {{old("page_header")}} @endif</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div
                                    class="form-group col-md-4 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                    <label>Page Header BN (HTML)</label>
                                    <textarea class="form-control" rows="7"
                                              name="page_header_bn">@if(isset($about)){{$about->page_header_bn}}@else {{old("page_header_bn")}} @endif </textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div
                                    class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7"
                                              name="schema_markup">@if(isset($about)){{$about->schema_markup}} @else {{old("schema_markup")}}@endif</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" id="submitForm" style="width:100%"
                                                class="btn @if(isset($about)) btn-success @else btn-info @endif ">
                                            @if(isset($about)) <i class="la la-check-square-o"></i>
                                            Update @else <i class="la la-check-square-o"></i> SAVE @endif
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script>
        $(function () {

            $('.dropify').dropify({
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







