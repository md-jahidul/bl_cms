@extends('layouts.admin')
@section('title', 'Partner Offer List')
@section('card_name', 'Partner Offer List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('partners') }}"> Partner List</a></li>
    <li class="breadcrumb-item ">Partner Offer List</li>
@endsection
@section('action')
    <a href="{{ url("partner-offer/$parentId/$partnerName/offer/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Offer
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords($partnerName." ". "Offers") }}</strong></h4>
                    {{--<table class="table table-striped table-bordered alt-pagination no-footer dataTable"--}}
                           {{--id="Example1" role="grid" aria-describedby="Example1_info" style="">--}}
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="4%">Company Logo</th>
                            <th width="20%">Offer Title</th>
{{--                            <th>Offer Unit</th>--}}
{{--                            <th>Offer Value</th>--}}
                            <th width="20%">Validity</th>
                            <th>Get Send SMS</th>
                            <th class="text-center" width="2%">Offer Details</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partnerOffers as $index=>$partnerOffer)
{{--                            @php $path = 'partner-offers-home'; @endphp--}}
                            <tr data-index="{{ $partnerOffer->id }}" data-position="{{ $partnerOffer->display_order }}">
                                <td width="3%">{{ $index + 1 }}</td>
                                <td><img class="" src="{{ config('filesystems.file_base_url') . $partnerOffer->partner->company_logo }}" alt="Slider Image" height="40" width="50" /></td>
                                <td>{{ $partnerOffer->other_attributes['free_text_value_en'] ?? null }}</td>
{{--                                <td>{{ $partnerOffer->offer_scale  }}</td>--}}
{{--                                <td>{{ $partnerOffer->offer_value  }} ({{ $partnerOffer->offer_unit }})</td>--}}

                                <td>{{ $partnerOffer->validity_en }} {!! $partnerOffer->is_active == 0 ? '<span class="text-danger"> ( Inactive )</span>' : '' !!}</td>
                                <td>{!! $partnerOffer->get_offer_msg_en !!}</td>
                                <td class="text-center"><a href="{{ route('offer.details', [$partnerName, $partnerOffer->id]) }}" class="btn-sm btn-outline-primary border">Details</a></td>
                                <td class="action" width="12%">
                                    <a href="{{ route('partner_offer_edit', [ $partnerOffer->partner_id, $partnerName, $partnerOffer->id] ) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("partner-offer/$partnerOffer->partner_id/$partnerName/offer/$partnerOffer->id/destroy/destroy") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $partnerOffer->id }}" title="Delete">
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
    {{--<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('/partner-offer/sortable') }}";
    </script>
@endpush





