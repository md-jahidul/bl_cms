@extends('layouts.admin')
@section('title', 'Product List')
@section('card_name', 'Product List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('partners') }}"> Product List</a></li>
    <li class="breadcrumb-item ">Partner Offer List</li>
@endsection
@section('action')
    <a href="{{ route("product.create", [$type, $simTypeId]) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Product
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords('Prepaid'." ". "Offers") }}</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Product Name</th>
                            <th>Price</th>
                            <th>USSD</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @php $path = 'partner-offers-home'; @endphp
                            <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}">
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}{!! $product->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{ $product->price_tk }} Tk</td>
                                <td>{{ $product->ussd }}</td>
                                <td width="15%">
                                    <a href="#" role="button" class="btn-sm btn-outline-secondary border-0"><i class="la la-eye" aria-hidden="true"></i></a>
                                    <a href="#" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" {{--remove="{{ url("partner-offer/$product->partner_id/$partnerName/offer/destroy/$product->id") }}--}} class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $product->id }}" title="Delete">
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
    <script>
        var auto_save_url = "{{ url('/partner-offer/sortable') }}";
    </script>
@endpush





