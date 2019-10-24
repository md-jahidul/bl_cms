@extends('layouts.admin')
@section('title', 'Offer Category List')
@section('card_name', 'Offer Category List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('offer-categories') }}"> Offer Categories List</a></li>
@endsection
@section('action')
{{--    <a href="{{ route("offer-categories.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Offer--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Offer Categories</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Name</th>
{{--                            <th class="">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($offerCategories as $offerCategory)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr data-index="{{ $offerCategory->id }}" data-position="{{ $offerCategory->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $offerCategory->name }}</td>
{{--                                    <td width="12%" class="text-center">--}}
{{--                                        <a href="{{ url("offer-category/$offerCategory->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>--}}
{{--                                        <a href="#" remove="{{ url("offer-category/destroy/$offerCategory->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $offerCategory->id }}" title="Delete">--}}
{{--                                            <i class="la la-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
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





