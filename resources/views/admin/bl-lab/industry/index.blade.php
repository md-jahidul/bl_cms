@extends('layouts.admin')
@section('title', 'Industry List')
@section('card_name', 'Industry List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('bl-labs/industry') }}"> Industry List</a></li>
@endsection
@section('action')
    <a href="{{ url("bl-labs/industry/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Industry List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Name</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr data-index="{{ $item->id }}" data-position="{{ $item->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name_en }} {!! $item->status == 0 ? '<span class="text-danger"> ( Inactive )</span> <br>' : '' !!}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("bl-labs/industry/$item->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("bl-labs/industry/destroy/$item->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $item->id }}" title="Delete">
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
    {{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

@endpush





