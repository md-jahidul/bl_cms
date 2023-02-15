@extends('layouts.admin')
@section('title', 'LMS Offer Category Add')
@section('card_name', 'LMS Offer Category Add')
@section('breadcrumb')
    <li class="breadcrumb-item active"> LMS Offer Category Add</li>
@endsection
@section('action')
    <a href="{{ url('lms-offer-category') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('tier.store') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('url_slug_en') ? ' error' : '' }}">--}}
{{--                                    <label> URL (English) <span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" name="url_slug_en" class="form-control" value="{{ old("url_slug_en") ? old("url_slug_en") : '' }}"--}}
{{--                                           required placeholder="Enter URL in English" id="url_slug">--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>--}}
{{--                                    </small>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('url_slug_en'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('url_slug_en') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">--}}
{{--                                    <label> URL (Bangla) <span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" name="url_slug_bn" class="form-control" value="{{ old("url_slug_bn") ? old("url_slug_bn") : '' }}"--}}
{{--                                           required placeholder="Enter URL in Bangla" id="url_slug">--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>--}}
{{--                                    </small>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('url_slug_bn'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Page Header (HTML)</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="page_header"></textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> Title, meta, canonical and other tags--}}
{{--                                    </small>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Page Header Bangla (HTML)</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="page_header_bn"></textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> Title, meta, canonical and other tags--}}
{{--                                    </small>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Schema Markup</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($data->schema_markup) ? $data->schema_markup : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> JSON-LD (Recommended by Google)--}}
{{--                                    </small>--}}
{{--                                </div>--}}
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
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
@endpush
@push('page-js')

@endpush






