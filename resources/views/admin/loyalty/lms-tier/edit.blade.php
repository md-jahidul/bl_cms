@extends('layouts.admin')
@section('title', 'Edit|Lms Tier List')
@section('card_name', 'LMS Tier')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('loyalty/tier') }}">Loyalty Tier List</a></li>
    <li class="breadcrumb-item active"> Tier Edit</li>
@endsection
@section('action')
    <a href="{{ url('loyalty/tier') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("tier.update", $lmsTier->id) }}" method="POST" novalidate>
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $lmsTier->id }}">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ $lmsTier->title_en }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ $lmsTier->title_bn }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('url_slug_en') ? ' error' : '' }}">--}}
{{--                                    <label> URL (English) <span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" name="url_slug_en" class="form-control" value="{{ isset($lmsTier->url_slug_en) ? $lmsTier->url_slug_en : null }}"--}}
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
{{--                                    <input type="text" name="url_slug_bn" class="form-control" value="{{ isset($lmsTier->url_slug_bn) ? $lmsTier->url_slug_bn : null }}"--}}
{{--                                           required placeholder="Enter URL in Bangla" id="url_slug">--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>--}}
{{--                                    </small>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('url_slug_bn'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                {{ dd($errors->all()) }}--}}
{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Page Header (HTML)</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="page_header">{{ isset($lmsTier->page_header) ? $lmsTier->page_header : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> Title, meta, canonical and other tags--}}
{{--                                    </small>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Page Header Bangla (HTML)</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($lmsTier->page_header_bn) ? $lmsTier->page_header_bn : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> Title, meta, canonical and other tags--}}
{{--                                    </small>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Schema Markup</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($lmsTier->schema_markup) ? $lmsTier->schema_markup : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> JSON-LD (Recommended by Google)--}}
{{--                                    </small>--}}
{{--                                </div>--}}
                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input" class="required">Status: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input required type="radio" name="status" value="1"
                                               data-validation-required-message="Please select status"
                                               id="input-radio-15" {{ ($lmsTier->status) ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-3">Active</label>
                                        <input required type="radio" name="status" value="0"
                                               data-validation-required-message="Please select status"
                                               id="input-radio-16" {{ ($lmsTier->status == 0) ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Inactive</label>
                                        @if ($errors->has('status'))
                                            <div class="help-block"> {{ $errors->first('status') }}</div>
                                        @endif
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
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop




