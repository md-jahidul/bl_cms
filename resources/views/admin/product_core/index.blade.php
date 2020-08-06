@extends('layouts.admin')
@section('title', 'Product Core List')
@section('card_name', 'Product Core List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Product Core List</li>
@endsection
@section('action')
    <a href="" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Product
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong></strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="20%">Product Name</th>
                                <th width="4%">Product ID</th>
                                <th>USSD</th>
                                <th>Offer Type</th>
                                <th width="8%" class="text-center">Connection type</th>
                                <th width="5%" class="text-center">Status</th>
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sim_type = ['N/F', 'Prepaid', 'Postpaid', 'Propaid'];  
                            @endphp
                            @foreach($products as $product)
                                {{--@if($product->product != '')--}}
                                    @php $path = 'partner-offers-home'; @endphp
                                    <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->activation_ussd }}</td>
                                        <td>{{ $product->assetlite_offer_type }}</td>
                                        <td>{{ $sim_type[$product->sim_type] }}</td>
                                        <td>{{ ($product->status == 1) ? 'Active' : 'Inactive' }}</td>
                                        {{--<td>{{ $product->end_date ? '' : '' }} <span class="badge badge-success badge-pill mr-1"></td>--}}

                                        {{-- <td class="text-center"><input type="checkbox" {{ $product->show_in_home == 1 ? 'checked' : '' }} disabled></td>
                                        <td class="text-center">{{ ucfirst($product->purchase_option) }}</td> --}}
                                        
                                        <td>
                                            <a href="{{ route('product.core.edit', [$product->product_code]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            <a href="#" remove="{{ url("offers/$product->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $product->id }}" title="Delete">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                {{--@endif--}}
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

        $('#syncBtn').click(function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('#syncBtn').html(),
                showCancelButton: true,
                confirmButtonText: 'Yes, Sync it!'
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: 'Data Processing. Please Wait...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ route('core-product-mapping', strtolower('www'))}}',
                        type: 'Get',
                        success: function (result) {
                            if (result.success) {
                                swal.fire({
                                    title: 'Core Product Sync Successfully!',
                                    type: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                setTimeout(function () {
                                    window.location.replace(result.url);
                                }, 2000)
                            } else {
                                swal.close();
                                swal.fire({
                                    title: result.message,
                                    type: 'error',
                                });
                            }

                        },
                        error: function (data) {
                            swal.fire({
                                title: 'Failed to sync',
                                type: 'error',
                            });
                        }
                    });
                }
            });

        });

    </script>
@endpush





