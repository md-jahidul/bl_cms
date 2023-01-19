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
                            <th width="20%">Title En</th>
                            <th width="20%">Title Bn</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogCategories as $data)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $data->title_en }}</td>
                                <td>{{ $data->title_bn }}</td>

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
