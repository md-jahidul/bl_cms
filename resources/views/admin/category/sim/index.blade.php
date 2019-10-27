@extends('layouts.admin')
@section('title', 'Sim Category List')
@section('card_name', 'Sim Category List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('sim-categories') }}"> Sim Categories List</a></li>
@endsection
@section('action')
{{--    <a href="{{ route("sim-categories.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Sim--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Sim Categories</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Name</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($simCategories as $simCategory)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr data-index="{{ $simCategory->id }}" data-position="{{ $simCategory->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $simCategory->name }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("sim-category/$simCategory->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("sim-category/destroy/$simCategory->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $simCategory->id }}" title="Delete">
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





