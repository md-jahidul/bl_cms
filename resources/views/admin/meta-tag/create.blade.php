@extends('layouts.admin')
@section('title', 'Meta Tag Edit')
@section('card_name', 'Meta Tag Tabs')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('meta-tag.index') }}">Meta Tag List</a></li>
<li class="breadcrumb-item active"> Meta Tag Edit</li>
@endsection
@section('action')
<a href="{{ route('meta-tag.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    @php
        $action = [
            'dynamic_route_key' => null,
            'redirect_to' => route('meta-tag.index'),
        ];
    @endphp
    @include('admin.meta-tag.create-or-update', $action)
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


