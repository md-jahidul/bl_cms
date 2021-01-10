@extends('layouts.admin')
@section('title', 'Campaign Offer List')
@section('card_name', 'Campaign Offer List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('partners') }}"> Partners</a></li>
    <li class="breadcrumb-item ">Campaign Offer List</li>
@endsection
@section('action')
{{--    <a href="{{ url("partner-offer/$parentId/$campaignOffer/offer/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Offer--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    {{--<h4 class="pb-1"><strong>Campaign Offer List</strong></h4>--}}
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Company Logo</th>
                            <th>Campaign Image</th>
                            <th width="25%">Validity</th>
                            <th>Get Send SMS</th>
                            <th>Offer Percentage</th>
{{--                            <th class="text-right">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($campaignOffers as $campaignOffer)
                            {{--@php $campaignOffer = strtolower(str_replace(' ', '-', $campaignOffer->partner->company_name_en)) @endphp--}}
                            <tr data-index="{{ $campaignOffer->id }}" data-position="{{ $campaignOffer->campaign_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td><img class="" src="{{ isset($campaignOffer->partner->company_logo) ? config('filesystems.file_base_url') . $campaignOffer->partner->company_logo : '' }}" alt="Slider Image" height="50" width="50" /></td>
                                <td><img class="" src="{{ isset($campaignOffer->campaign_img) ? config('filesystems.file_base_url') . $campaignOffer->campaign_img : '' }}" alt="Slider Image" height="50" width="50" /></td>
                                <td>{{ $campaignOffer->validity_en }} {!! $campaignOffer->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{ $campaignOffer->get_offer_msg_en }}</td>
                                <td>{{ $campaignOffer->offer_en }}</td>
                                <td class="action" width="8%">
                                    <a href="{{ route('partner_offer_edit', [ $campaignOffer->partner_id, $campaignOffer, $campaignOffer->id, 'campaign-offers'] ) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
{{--                                    <a href="#" remove="{{ url("partner-offer/$campaignOffer->partner_id/$campaignOffer/offer/destroy/$campaignOffer->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $campaignOffer->id }}" title="Delete">--}}
{{--                                        <i class="la la-trash"></i>--}}
{{--                                    </a>--}}
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('/campaign-offer/sortable') }}";
    </script>
@endpush





