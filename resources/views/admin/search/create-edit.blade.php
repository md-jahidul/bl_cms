@extends('layouts.admin')
@section('title', 'Single Search Add')
@section('card_name', 'Single Search')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('search-single-page.index') }}">App & Service Tabs List</a></li>
    <li class="breadcrumb-item active"> Single Search Add</li>
@endsection
@section('action')
    <a href="{{ route('search-single-page.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ isset($searchSinglePage) ? route("search-single-page.update", $searchSinglePage->id) : route("search-single-page.store") }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @if(isset($searchSinglePage)) {{method_field('PUT')}} @else {{method_field('POST')}} @endif
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('page_title_en') ? ' error' : '' }}">
                                    <label for="page_title_en" class="required">Page Title (English)</label>
                                    <input type="text" name="page_title_en"  class="form-control" placeholder="Enter page title in english"
                                           value="{{ $searchSinglePage->page_title_en ?? "" }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('page_title_en'))
                                        <div class="help-block">  {{ $errors->first('page_title_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('page_title_bn') ? ' error' : '' }}">
                                    <label for="page_title_bn" class="required">Page Title (Bangla)</label>
                                    <input type="text" name="page_title_bn"  class="form-control" placeholder="Enter page title in bangla"
                                           value="{{ $searchSinglePage->page_title_bn ?? "" }}" required data-validation-required-message="Enter page title in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('page_title_bn'))
                                        <div class="help-block">  {{ $errors->first('page_title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                    <label for="alt_text">Search Special Keyword En</label>
                                    <textarea name="tag_en" id="tag_en" class="form-control" rows="4"
                                              placeholder="Enter keywords en"
                                    >{{ $searchSinglePage->tag_en ?? '' }}</textarea>
                                    <small class="warning"><strong>Example: Internet Packs, Tier Based Tenure, Eligible Customers, Point Status</strong></small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_en'))
                                        <div class="help-block">{{ $errors->first('tag_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                    <label for="alt_text">Search Special Keyword Bn</label>
                                    <textarea type="text" name="tag_bn" id="alt_text" class="form-control" rows="4"
                                              placeholder="Enter keywords bn">{{ $searchSinglePage->tag_bn ?? '' }}</textarea>
                                    <small class="warning"><strong>Example: পয়েন্ট স্ট্যাটাস, টিয়ার সিস্টেম, অরেঞ্জ ক্লাব এর সদস্য</strong></small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_bn'))
                                        <div class="help-block">{{ $errors->first('tag_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug_en') ? ' error' : '' }}">
                                    <label> URL English <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" value="{{ $searchSinglePage->url_slug_en ?? "" }}" required name="url_slug_en" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> apps (no spaces and slash)<br>
                                    </small>
                                    @if ($errors->has('url_slug_en'))
                                        <div class="help-block">  {{ $errors->first('url_slug_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                    <label> URL Bangla <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" value="{{ $searchSinglePage->url_slug_bn ?? "" }}" required name="url_slug_bn" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> অ্যাপ (no spaces and slash)<br>
                                    </small>
                                    @if ($errors->has('url_slug_bn'))
                                        <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ (isset($searchSinglePage) && $searchSinglePage->status == 1) ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ (isset($searchSinglePage) && $searchSinglePage->status == 0) ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6"></div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> {{ isset($searchSinglePage) ? "UPDATE" : "SAVE" }}
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
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
@endpush
