@extends('layouts.admin')
@section('title', 'Tag Category List')
@section('card_name', 'Tag Category List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('tag-category') }}"> Tag Categories List</a></li>
@endsection
@section('action')
    <a href="{{ url("tag-category/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Event List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Name</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr data-index="{{ $tag->id }}" data-position="{{ $tag->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td style="color: {{ $tag->tag_color }}">{{ $tag->name_en }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("tag-category/$tag->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("tag-category/destroy/$tag->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $tag->id }}" title="Delete">
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





