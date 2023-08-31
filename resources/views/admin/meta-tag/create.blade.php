@extends('layouts.admin')
@section('title', 'Meta Tag Create')
@section('card_name', 'Meta Tag Tabs')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('meta-tag.index') }}">Meta Tag List</a></li>
<li class="breadcrumb-item active"> Meta Tag Create</li>
@endsection
@section('action')
<a href="{{ route('meta-tag.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h5 class="menu-title"><strong>Create</strong></h5><hr>
                <div class="card-body card-dashboard">
                    <form id="product_form" role="form" action="{{ route('meta-tag.store') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                <label for="title" class="required">Title (English)</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"
                                       value="{{ old("title") ? old("title") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title'))
                                <div class="help-block">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('dynamic_route_key') ? ' error' : '' }}">
                                <label class="required"> Key</label>
                                <input type="text" class="form-control slug-convert required" name="dynamic_route_key" placeholder="Key" value="{{ old("dynamic_route_key") ? old("dynamic_route_key") : '' }}">
                                <small class="text-info">
                                    <strong>i.e:</strong> page-name (no spaces)<br>
                                </small>
                                @if ($errors->has('dynamic_route_key'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('dynamic_route_key') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="page_header">Page Header (HTML)</label>
                                <textarea type="text" name="page_header" rows="7" class="form-control">{{ old("page_header") ? old("page_header") : '' }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="page_header_bn">Page Header Bangla (HTML)</label>
                                <textarea type="text" name="page_header_bn" rows="7" class="form-control">{{ old("page_header_bn") ? old("page_header_bn") : '' }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="schema_markup">Schema Markup</label>
                                <textarea type="text" name="schema_markup" rows="7" class="form-control">{{ old("schema_markup") ? old("schema_markup") : '' }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button id="save" class="btn btn-primary"><i
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

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">


@endpush
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

@endpush


