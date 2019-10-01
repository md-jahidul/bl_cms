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
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Company Logo</th>
                            <th width="25%">Validity</th>
                            <th>Get Send SMS</th>
                            <th>Offer Percentage</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partnerOffers as $index=>$partnerOffer)
                            <tr data-index="{{ $partnerOffer->id }}" data-position="{{ $partnerOffer->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td><img class="" src="{{ $partnerOffer->partner->company_logo }}" alt="Slider Image" height="50" width="50" /></td>
                                <td>{{ $partnerOffer->validity_en }} {!! $partnerOffer->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{ $partnerOffer->get_offer_msg_en }}</td>
                                <td>{{ $partnerOffer->offer_en }}</td>
                                <td class="action" width="8%">
                                    <a href="{{ route('partner_offer_edit', [ $partnerOffer->partner_id, $partnerName, $partnerOffer->id ] ) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("partner-offer/$partnerOffer->partner_id/$partnerName/offer/destroy/$partnerOffer->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $partnerOffer->id }}" title="Delete">
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
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>

    <script>
        var auto_save_url = "{{ url('/partner-offer/sortable') }}";
    </script>
@endpush





