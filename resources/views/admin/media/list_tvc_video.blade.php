@extends('layouts.admin')
@section('title', 'Press News Event')
@section('card_name', 'Press News Event')
@section('breadcrumb')
    <li class="breadcrumb-item ">Press News Event List</li>
@endsection
@section('action')
    <a href="{{ url("press-news-event/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Press News Event List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="5%">Title</th>
                            <th width="8%">Image</th>
                            <th width="25%">Short Description</th>
                            <th width="25%">Long Description</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pressNewsEvents as $data)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $data->title_en }}</td>
                                <td><img src="{{ config('filesystems.file_base_url') . $data->image_url }}" height="50" width="70"></td>
                                <td>{{ $data->short_details_en }}</td>
                                <td>{!! $data->long_details_en !!}</td>
                                <td width="12%" class="text-center">
                                    <a href="{{ url("press-news-event/$data->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("press-news-event/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
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
