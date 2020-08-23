@extends('layouts.admin')
@section('title', 'Be A Partner')
@section('card_name', 'Be A Partner')
@section('breadcrumb')
    <li class="breadcrumb-item ">Be A Partner Landing Page</li>
@endsection
@section('action')
{{--    <a href="{{ url("landing-page-component/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add New--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Be a Partner Fixed Section</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="5%">Title</th>
                            <th width="8%">Description</th>
                            <th width="12%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $beAPartner->title_en }}</td>
                                <td>{{ $beAPartner->description_en  }}</td>
                                <td class="text-right">
                                    <a href="{{ route("be-a-partner.edit", $beAPartner->id) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
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
