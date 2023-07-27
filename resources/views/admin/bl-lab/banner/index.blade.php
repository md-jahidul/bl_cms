@extends('layouts.admin')
@section('title', 'Bl Labs Banner')
@section('card_name', 'Bl Labs Banner')
@section('breadcrumb')
    <li class="breadcrumb-item ">Bl Labs Banner</li>
@endsection
@section('action')
{{--    <a href="{{ url("landing-page-component/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add New--}}
{{--    </a>--}}
@endsection
@section('content')
    @php
        $action = [
            'section_type' => "bl_lab_my_idea",
            'section_id' => 0,
            'section_name' => "My Idea",
        ];
        $banner = $bannerMyIdea;
    @endphp
    @include('admin.al-banner.section', $action)

    @php
        $action = [
            'section_type' => "bl_lab_application",
            'section_id' => 0,
            'section_name' => "Application Form"
        ];
        $banner = $bannerApplication;
    @endphp
    @include('admin.al-banner.section', $action)
@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        // Sortable URL
        var auto_save_url = "{{ url('landing-page-sortable') }}";

        // Image Dropify
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });
        });
    </script>
@endpush
