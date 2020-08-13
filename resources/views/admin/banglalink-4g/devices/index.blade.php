@extends('layouts.admin')
@section('title', 'Devices')
@section('card_name', '4G Devices')
@section('breadcrumb')
    <li class="breadcrumb-item ">Devices List</li>
@endsection
@section('action')
    <a href="{{ url("bl-4g-devices/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Device
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Devices List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Title</th>
                            <th width="10%">Logo</th>
                            <th width="25%">Thumbnail Image</th>
                            <th width="10%">Current Price</th>
                            <th width="10%" class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $device->title_en }}</td>
                                    <td><img src="{{ config('filesystems.file_base_url') . $device->card_logo }}" id="leftImg" height="80" width="150"></td>
                                    <td><img src="{{ config('filesystems.file_base_url') . $device->thumbnail_image }}" id="leftImg" height="80" width="150"></td>
                                    <td>{{ $device->current_price }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("bl-4g-devices/$device->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("bl-4g-devices/destroy/$device->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $device->id }}" title="Delete">
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





