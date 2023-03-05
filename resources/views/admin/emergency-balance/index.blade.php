@extends('layouts.admin')
@section('title', 'Emergency Balance')
@section('card_name', 'Emergency Balance')
@section('breadcrumb')
    <li class="breadcrumb-item ">Emergency Balance</li>
@endsection
@section('action')

@endsection
@section('content')

    @php
    
        $action = [
            'section_type' => $pageType,
            'section_id' => 0
        ];

    @endphp
    @include('admin.al-banner.section', $action)

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





