@extends('layouts.admin')

@section('title', "Create/Edit Dynamic Page")
@section('card_name', "Create/Edit Dynamic Page")
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('dynamic-pages') }}"> Other Page List</a></li>
<li class="breadcrumb-item active">Create/Edit</li>
@endsection
@section('action')
<a href="{{ url("dynamic-pages") }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i> Back </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h5 class="menu-title"><strong>Create Dynamic Page</strong></h5><hr>
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ url('dynamic-pages/save') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <?php
                            $pageId = "";
                            $nameEn = "";
                            $nameBn = "";
                            $urlSlug = "";
                            $desktopImg = null;
                            $mobileImg = null;
                            $altText = "";
                            $photoName = "";
                            $pageHeader = "";
                            $pageHeaderBn = "";
                            $schemaMarkup = "";
                            if (!empty($page)) {
                                $pageId = $page->id;
                                $nameEn = $page->page_name_en;
                                $nameBn = $page->page_name_bn;
                                $urlSlug = $page->url_slug;
                                $desktopImg = $page->banner_image_url;
                                $mobileImg = $page->banner_mobile_view;
                                $altText = $page->alt_text;
                                $photoName = $page->banner_name;
                                $pageHeader = $page->page_header;
                                $pageHeaderBn = $page->page_header_bn;
                                $schemaMarkup = $page->schema_markup;
                            }
                            ?>

                            <input type="hidden" name="page_id" value="{{$pageId}}">

                            <div class="form-group col-md-4">
                                <label class="required">Page Name (EN)</label>
                                <input type="text" name="page_name_en" required value="{{$nameEn}}"  class="form-control">
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="required">Page Name (BN)</label>
                                <input type="text" name="page_name_bn" required value="{{$nameBn}}"  class="form-control">
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                <label> URL (url slug) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $urlSlug }}" name="url_slug"
                                       required placeholder="URL">
                                <div class="help-block"></div>
                                <small class="text-info">
                                    <strong>i.e:</strong> page-name (no spaces)<br>
                                </small>
                                @if ($errors->has('url_slug'))
                                    <div class="help-block">  {{ $errors->first('url_slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                <label for="mobileImg">Desktop View Image</label>
                                <div class="custom-file">
                                    <input type="hidden" name="old_web_img" value="{{ isset($desktopImg) ? $desktopImg : null }}">
                                    <input type="file" name="banner_image_url" class="dropify" data-height="80" id="image"
                                           data-default-file="{{ isset($desktopImg) ?  config('filesystems.file_base_url') . $desktopImg : null  }}">
                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>
                                <div class="help-block"></div>
                                @if ($errors->has('banner_image_url'))
                                    <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                <label for="mobileImg">Mobile View Image</label>
                                <div class="custom-file">
                                    <input type="hidden" name="old_mob_img" value="{{ isset($mobileImg) ? $mobileImg : null }}">
                                    <input type="file" name="banner_mobile_view" class="dropify" data-height="80" id="image"
                                           data-default-file="{{ isset($mobileImg) ?  config('filesystems.file_base_url') . $mobileImg : null  }}">
                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>

                                <div class="help-block"></div>
                                @if ($errors->has('banner_mobile_view'))
                                    <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label for="alt_text">Alt Text</label>
                                <input type="text" name="alt_text" id="alt_text" class="form-control" placeholder="Enter offer name in English"
                                       value="{{ $altText }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text'))
                                    <div class="help-block">{{ $errors->first('alt_text') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Banner Photo Name</label>
                                <input type="hidden" name="old_banner_name" value="{{ $photoName }}">
                                <input type="text" class="form-control" name="banner_name" value="{{ $photoName }}"
                                       placeholder="Photo Name">
                                <small class="text-info">
                                    <strong>i.e:</strong> app-and-service-banner (no spaces)<br>
                                    <strong>Note: </strong> Don't need MIME type like jpg,png
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{ $pageHeader }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{ $pageHeaderBn }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{ $schemaMarkup }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                                {{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="details_bn" class="required">Page HTML/Content (EN)</label>--}}
{{--                                <textarea type="text" name="page_content_en"  class="form-control tinymce">{{$contentEn}}</textarea>--}}
{{--                                <div class="help-block"></div>--}}

{{--                            </div>--}}
{{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="details_bn" class="required">Page HTML/Content (BN)</label>--}}
{{--                                <textarea type="text" name="page_content_bn"  class="form-control tinymce">{{$contentBn}}</textarea>--}}
{{--                                <div class="help-block"></div>--}}
{{--                            </div>--}}

                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button type="submit" id="save" class="btn btn-primary"><i
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
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

    function readURL(input, imgField) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(imgField).css('display', 'block');
                $(imgField).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageLeft").change(function () {
        var imgField = '#leftImg';
        readURL(this, imgField);
    });

    $("#imageRight").change(function () {
        var imgField = '#rightImg';
        readURL(this, imgField);
    });
})
</script>
@endpush






