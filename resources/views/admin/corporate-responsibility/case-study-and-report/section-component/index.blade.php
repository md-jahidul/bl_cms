@extends('layouts.admin')
@section('title', 'Case Study & Report Component')
@section('card_name', 'Case Study & Report Component')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('case-study-section.index') }}">Section List</a></li>
    <li class="breadcrumb-item ">Component List</li>
@endsection
@section('action')
    @if($section->section_type == "top_image_button_text" || $count == 0)
        <a href="{{ route("case-study-component.create", $section->id) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
            Add New
        </a>
    @endif
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ $section->title_en }} Component List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="20%">Title</th>
                            <th width="15%">Image</th>
                            <th width="20%">Short Description</th>
                            <th width="10%"></th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($components as $data)
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                    <td><img src="{{ isset($data->other_attributes['thumbnail_image']) ? config('filesystems.file_base_url') . $data->other_attributes['thumbnail_image'] : '' }}" height="100" width="270"></td>
                                    <td>{!! $data->details_en !!}</td>
                                    <td>
                                        <a href="{{ route("case-study-details.index", $data->id) }}" role="button" class="btn btn-warning">Details</a>
                                    </td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ route("case-study-component.edit", [$section->id, $data->id]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("corporate/case-study-component/$section->id/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
        var auto_save_url = "{{ url('corporate/case-study-section-sort') }}";
    </script>
@endpush
