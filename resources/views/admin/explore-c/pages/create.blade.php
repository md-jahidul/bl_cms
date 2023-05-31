@extends('layouts.admin')

@section('title', "Create/Edit 6C's Page")
@section('card_name', "Create/Edit 6C's Page")
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('explore-c-pages') }}"> Other Page List</a></li>
<li class="breadcrumb-item active">Create/Edit</li>
@endsection
@section('action')
<a href="{{ url("explore-c-pages") }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i> Back </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h5 class="menu-title"><strong>Create Dynamic Page</strong></h5><hr>
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ url('explore-c-pages/save') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <?php
                            $pageId = "";
                            $nameEn = "";
                            $nameBn = "";
                            $pageContentEn = "";
                            $pageContentBn = "";
                            $urlSlug = "";
                            $urlSlugBn = "";
                            $pageHeader = "";
                            $pageHeaderBn = "";
                            $schemaMarkup = "";
                            if (!empty($page)) {
                                $pageId = $page->id;
                                $nameEn = $page->page_name_en;
                                $nameBn = $page->page_name_bn;
                                $pageContentEn = $page->page_content_en;
                                $pageContentBn = $page->page_content_bn;
                                $urlSlug = $page->url_slug;
                                $urlSlugBn = $page->url_slug_bn;
                                $pageHeader = $page->page_header;
                                $pageHeaderBn = $page->page_header_bn;
                                $schemaMarkup = $page->schema_markup;
                            }
                            ?>

                            <input type="hidden" name="page_id" value="{{$pageId}}">

                            <div class="form-group col-md-3">
                                <label class="required">Page Name (EN)</label>
                                <input type="text" name="page_name_en" required value="{{$nameEn}}"  class="form-control">
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="required">Page Name (BN)</label>
                                <input type="text" name="page_name_bn" required value="{{$nameBn}}"  class="form-control">
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                <label>English URL (url slug) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control slug-convert" value="{{ $urlSlug }}" name="url_slug"
                                       required placeholder="URL">
                                <div class="help-block"></div>
                                <small class="text-info">
                                    <strong>i.e:</strong> page-name (no spaces)<br>
                                </small>
                                @if ($errors->has('url_slug'))
                                    <div class="help-block">  {{ $errors->first('url_slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                <label>Bangla URL (url slug) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $urlSlugBn }}" name="url_slug_bn"
                                       required placeholder="URL bangla">
                                <div class="help-block"></div>
                                <small class="text-info">
                                    <strong>i.e:</strong> page-name (no spaces)<br>
                                </small>
                                @if ($errors->has('url_slug_bn'))
                                    <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-6 {{ $errors->has('page_content_en') ? ' error' : '' }}">
                                <label for="page_content_en">Description (English)</label>
                                <textarea type="text" name="page_content_en" id="page_content_en" rows="5"
                                          class="form-control summernote_editor"
                                          placeholder="Enter page description in English"
                                >{{ $pageContentEn }}</textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('page_content_en'))
                                    <div class="help-block">{{ $errors->first('page_content_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('page_content_bn') ? ' error' : '' }}">
                                <label for="page_content_bn">Description (Bangla)</label>
                                <textarea type="text" name="page_content_bn" rows="5" id="page_content_bn"
                                          class="form-control summernote_editor"
                                          placeholder="Enter page description in Bangla"
                                >{{ $pageContentBn }}</textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('page_content_bn'))
                                    <div class="help-block">{{ $errors->first('page_content_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                <label for="alt_text">Search Special Keyword En</label>
                                <textarea name="tag_en" id="tag_en" class="form-control" rows="4"
                                          placeholder="Enter keywords en"
                                >{{ $page->searchableFeature->tag_en ?? '' }}</textarea>
                                <small class="warning"><strong>Example: Internet Packs, Tier Based Tenure, Eligible Customers, Point Status</strong></small>
                                <div class="help-block"></div>
                                @if ($errors->has('tag_en'))
                                    <div class="help-block">{{ $errors->first('tag_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                <label for="alt_text">Search Special Keyword Bn</label>
                                <textarea type="text" name="tag_bn" id="alt_text" class="form-control" rows="4"
                                          placeholder="Enter keywords bn">{{ $page->searchableFeature->tag_bn ?? '' }}</textarea>
                                <small class="warning"><strong>Example: পয়েন্ট স্ট্যাটাস, টিয়ার সিস্টেম, অরেঞ্জ ক্লাব এর সদস্য</strong></small>
                                <div class="help-block"></div>
                                @if ($errors->has('tag_bn'))
                                    <div class="help-block">{{ $errors->first('tag_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{ $pageHeader }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{ $pageHeaderBn }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{ $schemaMarkup }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

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
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
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






