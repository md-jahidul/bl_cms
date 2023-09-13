@extends('layouts.admin')
@section('title', 'CSR Landing Page Component')
@section('card_name', 'CSR Landing Page')
@section('breadcrumb')
    <li class="breadcrumb-item ">CSR Landing Page Component</li>
@endsection
@section('action')
    <a href="{{ url("csr-landing-page-component/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Components List</strong></h4>
                    <table class="table table-striped table-bordered"> <!--Datatable class: zero-configuration-->
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="10%">Title</th>
                            <th width="8%">Component Type</th>
                            <th width="3%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($componentList as $data)
                            <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{{ str_replace('_', ' ', ucwords($data->component_type)) }}</td>
                                <td width="12%" class="text-right">
                                    <a href="{{ url("csr-landing-page-component/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("csr-landing-page-component/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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

    @php
        $action = [
            'dynamic_route_key' => "csr_landing_page",
            'redirect_to' => "csr-landing-page-component",
        ];
    @endphp
    @include('admin.meta-tag.create-or-update', $action)
@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
@endpush
