@extends('layouts.admin')
@section('title', 'Component List')
@section('card_name', 'Component List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('pages') }}">Page List</a></li>
    <li class="breadcrumb-item ">Component List</li>
@endsection
@section('action')

<a href="{{ route("page-components-create", $pageId) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>Add Component</a>

@endsection
@section('content')
    @php

        $action = [
            'edit' => 'dynamic-pages/component/edit',
            'destroy' => 'dynamic-pages/component/delete',
            'componentSort' => 'dynamic-pages/component-sortable',
            'section_id' => $pageId
        ];

    @endphp
    @include('admin.components.index', $action)

{{--    @php--}}
{{--    --}}
{{--        $action = [--}}
{{--            'section_type' => $pageType,--}}
{{--            'section_id' => $page->id--}}
{{--        ];--}}

{{--    @endphp--}}
{{--    @include('admin.al-banner.section', $action)--}}

@stop

@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>

        var auto_save_url = "{{ url('dynamic-pages/component-sortable') }}";

        $(function () {

            //show dropify for  photo
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for File/Photo',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        });
    </script>
@endpush





