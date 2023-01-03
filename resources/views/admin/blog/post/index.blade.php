@extends('layouts.admin')
@section('title', 'Blog Post List')
@section('card_name', 'Blog')
@section('breadcrumb')
    <li class="breadcrumb-item ">Blog Post List</li>
@endsection
@section('action')
    <a href="{{ url("blog-post/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Blog Post List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="20%">Title</th>
                            <th width="20%">Date</th>
                            <th width="8%">Image</th>
                            <th width="25%">Short Description</th>
                            <th width="8%">Details</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogPosts as $data)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $data->title_en }} {!! $data->status == 0 ? '<span class="danger pl-1"><strong> (Inactive)</strong></span>' : '' !!}
                                    {!! $data->show_in_home == 1 ? '<span class="success pl-1"><strong> (Show In Home)</strong></span>' : '' !!}</td>
{{--                                <td>{{ str_replace('_', ' ', ucfirst($data->type)) }}</td>--}}
                                <td><img src="{{ config('filesystems.file_base_url') . $data->thumbnail_image }}" height="90" width="150"></td>
                                <td>{{ $data->short_details_en }}</td>
                                <td class="text-center">
                                    <a href="{{ route( "blog-component.list", ['id' => $data->id] ) }}" class="btn-sm btn-outline-warning border">Details</a>
                                </td>

                                <td>{{ $data->date }}</td>
                                <td width="12%" class="text-center">
                                    <a href="{{ url("blog-post/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("blog-post/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
@endpush

@push('page-js')
@endpush
