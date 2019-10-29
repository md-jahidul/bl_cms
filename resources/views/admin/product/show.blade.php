@extends('layouts.admin')
@section('title', 'Product Details')
@section('card_name', 'Product Details')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('partners') }}"> Product List</a></li>
    <li class="breadcrumb-item active">Product Details</li>
@endsection
@section('action')
    <a href="{{ route('product.list', $type) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Back </a>
@endsection
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="striped-row-layout-card-center"><i class="la la-th-list"></i> <strong>Product Details</strong></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <hr class="mb-0">
                <div class="card-content collpase show">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th class="text-right" width="30%">Product Name</th>
                                    <td>{{ $productDetails->name_en }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Product Name</th>
                                    <td>{{ $productDetails->name_bn }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Offer Price</th>
                                    <td>{{ $productDetails->price_tk }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Price Vat Included</th>
                                    <td>{{ $productDetails->price_vat_included }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">SMS Volume</th>
                                    <td>{{ $productDetails->sms_volume }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Minute Volume</th>
                                    <td>{{ $productDetails->min_volume }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Internet Volume MB</th>
                                    <td>{{ $productDetails->internet_volume_mb }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Bonus</th>
                                    <td>{{ $productDetails->bonus }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Show In Home</th>
                                    <td><input type="checkbox" {{ $productDetails->show_in_home == 1 ? 'checked' : '' }} disabled></td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">USSD Code</th>
                                    <td>{{ $productDetails->ussd }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Point</th>
                                    <td>{{ $productDetails->point }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">Status</th>
                                    <td>
                                        <strong class="{{ $productDetails->status == 1 ? 'success' : 'danger' }}">
                                            {{ $productDetails->status == 1 ? 'Active' : 'Inactive' }}
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="30%"></th>
                                    <td>
                                        <a href="{{ route('product.edit', [$type, $productDetails->id]) }}" class="btn btn-outline-primary mr-1 border-0"><i class="la la-pencil-square"></i> Edit</a>
                                        <a href="{{ route('product.list', $type) }}" class="btn btn-outline-warning border-0"><i class="la la-arrow-circle-left"></i> Back</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


{{--<style>--}}
{{--    .profile-pic {--}}
{{--        position: relative;--}}
{{--        display: inline-block;--}}
{{--    }--}}
{{--    .profile-pic:hover .edit {--}}
{{--        display: block;--}}
{{--    }--}}
{{--    .edit {--}}
{{--        display: none;--}}
{{--    }--}}
{{--</style>--}}

@push('page-js')

@endpush





