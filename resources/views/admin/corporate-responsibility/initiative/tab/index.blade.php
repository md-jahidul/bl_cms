@extends('layouts.admin')
@section('title', 'Initiative Tabs')
@section('card_name', 'Initiative Tabs')
@section('breadcrumb')
    <li class="breadcrumb-item ">Initiative Tabs List</li>
@endsection
@section('action')
    <a href="{{ route("initiative-tab.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Tab List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="20%">Title</th>
                            <th width="20%">URL Slug</th>
                            <th width="20%"></th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($tabs as $data)
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                    <td>{{ $data->url_slug_en }}</td>
                                    <td>
                                        <a href="{{ url("corporate/cr-strategy-component/$data->id/list") }}" role="button" class="btn btn-info">Components</a>
                                    </td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("corporate/initiative-tab/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("corporate/initiative-tab/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
        var auto_save_url = "{{ url('corporate/initiative-tab-sort') }}";
    </script>
@endpush
