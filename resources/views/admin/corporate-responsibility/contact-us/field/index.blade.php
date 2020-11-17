@extends('layouts.admin')
@section('title', 'Contact Us Page Field')
@section('card_name', 'Contact Us Page Field')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('contact-us-field.index', $page->id) }}">Page List</a></li>
    <li class="breadcrumb-item ">Field List</li>
@endsection
@section('action')
    <a href="{{ route("contact-us-field.create", $page->id) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ str_replace('_', ' ', ucfirst($page->page_type)) }} Field List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="10%">Input Label</th>
                            <th width="20%">Field Type</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($fields as $data)
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $data->input_label_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                    <td width="3%">{{ ucfirst($data->type) }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ route("contact-us-field.edit", [$page->id, $data->id]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("corporate/contact-us-field/$page->id/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
{{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('corporate/cr-strategy-section-sort') }}";
    </script>
@endpush
