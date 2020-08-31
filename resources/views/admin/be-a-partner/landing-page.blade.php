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
                                <td>{!! $beAPartner->description_en !!}</td>
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



{{--    <a href="{{ url("landing-page-component/create") }}" class="btn btn-primary pull-right round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Component--}}
{{--    </a>--}}
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1 pull-left"><strong>Components List</strong></h4>
                    <h4 class="pb-1 pull-right">
                        <a href="{{ url("be-a-partner/component-create") }}" class="btn btn-primary pull-right round btn-glow px-2"><i class="la la-plus"></i>
                                <strong>Add Component</strong>
                        </a>
                    </h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="5%">Component Type</th>
                            <th width="8%">Title</th>
                            <th width="12%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($components as $list)
                            <tr data-index="{{ $list->id }}" data-position="{{ $list->component_order }}">
                                <td><i class="icon-cursor-move icons"></i></td>
                                <td>{{ ucwords(str_replace('_', ' ', $list->component_type)) }} {!! $list->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{ $list->title_en  }}</td>
                                <td class="text-right">
                                    <a href="{{ url("be-a-partner/component-edit/$list->id") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ route('be_a_partner.component.delete', $list->id) }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $list->id }}" title="Delete">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
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
