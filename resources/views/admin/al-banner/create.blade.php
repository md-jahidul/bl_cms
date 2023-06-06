@extends('layouts.admin')
@section('title', 'Al Banner Create/Edit')
@section('card_name', 'Al Banner Tabs')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('al-banner.index') }}">Al Banner List</a></li>
<li class="breadcrumb-item active"> Al Banner Create/Edit</li>
@endsection
@section('action')
<a href="{{ route('al-banner.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')

    @php
    
        $action = [
            'section_type' => '',
            'section_id' => 0,
            'from_generic' => true,
        ];

    @endphp
    @include('admin.al-banner.section', $action)

@endsection

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


