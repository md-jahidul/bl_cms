@extends('layouts.admin')
@section('title', 'App Service Product List')
@section('card_name', 'App Service Product List')
@section('breadcrumb')
    <li class="breadcrumb-item ">App Service Product List</li>
@endsection
@section('action')
{{--    <a href="#" id="syncBtn" class="btn btn-outline-blue-grey round btn-glow px-2">--}}
{{--        Sync Core Product--}}
{{--    </a>--}}
    <a href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Product
    </a>
    <a href="{{ route("app-service-search-sync") }}" class="btn btn-blue-grey  round btn-glow px-2"><i class="la la-refresh"></i>
        Sync Search
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Product List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="15%">Product Title</th>
{{--                                <th width="15%">Product Description</th>--}}
                                <th width="5%">Price</th>
{{--                                <th width="5%">USSD</th>--}}
                                <th width="5%">Tab</th>
                                <th>Category</th>
                                <th class="text-center" width="8%">Details</th>
                                <th width="5%" class="text-center">Can Active</th>
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($appServiceProduct as $product)
                                {{--@if($product->product != '')--}}
                                    @php $path = 'partner-offers-home'; @endphp
                                    <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name_en }}{!! $product->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
{{--                                        <td width="15%">{!! $product->description_en !!}</td>--}}
                                        <td>{{ $product->price_tk }}</td>
{{--                                        <td>{{ $product->ussd_en }}</td>--}}
                                        <td>{{ $product->appServiceTab->name_en }}</td>
                                        <td>@if(isset($product->appServiceCat->title_en)){{ $product->appServiceCat->title_en }}@endif</td>
                                        <td class="text-center">
                                             <a href="{{ route( "app_service.details.list", ['type' => $product->appServiceTab->alias, 'id' => $product->id] ) }}" class="btn-sm btn-outline-warning border">Details</a>
                                        </td>
                                        <td class="text-center"><input type="checkbox" {{ $product->can_active == 1 ? 'checked' : '' }} disabled></td>
                                        <td>

{{--                                            <a href="--}}{{--{{ route('product.show', [$product->id]) }}--}}{{--" role="button" class="btn-sm btn-outline-secondary border-0"><i class="la la-eye" aria-hidden="true"></i></a>--}}
                                            <a href="{{ url("app-service-product/$product->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            <a href="#" remove="{{ url("app-service/product/destroy/$product->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $product->id }}" title="Delete">
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
                        {{--url: '{{ route('core-product-mapping', strtolower($type))}}',--}}
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





