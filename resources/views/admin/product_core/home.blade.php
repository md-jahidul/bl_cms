@extends('layouts.admin')
@section('title', 'Trending Offer List')
@section('card_name', 'Trending Offer List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('multiple-sliders') }}">Slider List</a></li>
    <li class="breadcrumb-item ">Trending Offer List</li>
@endsection
@section('action')
{{--    <a href="{{ route("product.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Product--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Trending Offer</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="25%">Product Name</th>
                            <th>Total Price</th>
                            <th>USSD</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($trendingHomeOffers as $trendingHomeOffer)
                            @php $path = 'partner-offers-home'; @endphp
                            <tr data-index="{{ $trendingHomeOffer->id }}" data-position="{{ $trendingHomeOffer->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $trendingHomeOffer->name_en }}{!! $trendingHomeOffer->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{{ $trendingHomeOffer->product_core->mrp_price }} Tk</td>
                                <td>{{ $trendingHomeOffer->product_core->activation_ussd }}</td>
                                <td width="15%">
{{--                                    <a href="{{route('product.show', [$trendingHomeOffer->sim_category->alias,$trendingHomeOffer->id])}}" role="button" class="btn-sm btn-outline-secondary border-0"><i class="la la-eye" aria-hidden="true"></i></a>--}}
                                    <a href="{{ route('product.edit',[$trendingHomeOffer->sim_category->alias,$trendingHomeOffer->product_code]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
{{--                                    <a href="#" remove="{{ url("offers/$trendingHomeOffer->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $trendingHomeOffer->id }}" title="Delete">--}}
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
            padding-top: 7px !important;
            padding-bottom: 7px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('/trending-home/sortable') }}";
    </script>
@endpush





