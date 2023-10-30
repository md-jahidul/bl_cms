@extends('layouts.admin')

@section('title', "Create/Edit Page")
@section('card_name', "Create/Edit Page")
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('pages') }}"> Other Page List</a></li>
<li class="breadcrumb-item active">Create/Edit</li>
@endsection
@section('action')
<a href="{{ url("pages") }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i> Back </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h5 class="menu-title"><strong>Create Page</strong></h5><hr>
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ url('pages') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <?php
                                $pageId = "";
                                $nameEn = "";
                                $urlSlug = "";
                                $urlSlugBn = "";
                                $pageHeader = "";
                                $pageHeaderBn = "";
                                $schemaMarkup = "";
                                $status = "";
                                if (!empty($page)) {
                                    $pageId = $page->id;
                                    $nameEn = $page->name;
                                    $urlSlug = $page->url_slug;
                                    $urlSlugBn = $page->url_slug_bn;
                                    $pageHeader = $page->page_header_en;
                                    $pageHeaderBn = $page->page_header_bn;
                                    $schemaMarkup = $page->schema_markup;
                                    $status = $page->status;
                                }
                            ?>

                            <input type="hidden" name="page_id" value="{{$pageId}}">

                            <div class="form-group col-md-6">
                                <label class="required">Page Name</label>
                                <input type="text" name="name" required value="{{ old("name") ? old("name") : $nameEn ?? '' }}"  class="form-control">
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                <label>URL<span class="text-danger">*</span></label>
                                <input type="text" class="form-control slug-convert" value="{{ old("url_slug") ? old("url_slug") : $urlSlug ?? '' }}" name="url_slug"
                                       required placeholder="URL">
                                <div class="help-block"></div>
                                <small class="text-info">
                                    <strong>i.e:</strong> page-name (no spaces)<br>
                                </small>
                                <div class="help-block"></div>
                                @if ($errors->has('url_slug'))
                                    <div class="help-block">  {{ $errors->first('url_slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('page_header_en') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_en">{{ old("page_header_en") ? old("page_header_en") : $pageHeader ?? '' }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{ old("page_header_bn") ? old("page_header_bn") : $pageHeaderBn ?? '' }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('schema_markup') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{ old("schema_markup") ? old("schema_markup") : $schemaMarkup??'' }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="title" class="mr-1">Status:</label>
                                    <input type="radio" name="status" value="1" id="active" {{ $status == 1 ? 'checked' : '' }}>
                                    <label for="active" class="mr-1">Active</label>

                                    <input type="radio" name="status" value="0" id="inactive" {{ $status == 0 ? 'checked' : '' }}>
                                    <label for="inactive">Inactive</label>
                                </div>
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
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
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






