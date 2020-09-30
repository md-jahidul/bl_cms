@extends('layouts.admin')
@section('title', 'Case Study & Repost Section')
@section('card_name', 'Case Study & Repost Section')
@section('breadcrumb')
    <li class="breadcrumb-item ">Section List</li>
@endsection
@section('action')
    <a href="{{ route("case-study-section.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Section List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="20%">Title</th>
                            <th width="20%">Type</th>
                            <th width="20%"></th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($sections as $data)
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                    <td>{{ str_replace('_', ' ', ucfirst($data->section_type)) }}</td>
                                    <td>
                                        <a href="{{ url("corporate/case-study-component/$data->id/list") }}" role="button" class="btn btn-info">Components</a>
                                    </td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("corporate/case-study-section/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("corporate/case-study-section/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('corporate/case-study-section-sort') }}";
    </script>
@endpush
