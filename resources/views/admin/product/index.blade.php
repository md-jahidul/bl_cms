@php
    function match($productId, $relatedProducts, $type){

        $relatedProducts = isset($relatedProducts[$type . "_related_product_id"]) ? $relatedProducts[$type . "_related_product_id"] : null;

        if ($relatedProducts){
            foreach ($relatedProducts as $relatedProduct){
                if ($productId == $relatedProduct){
                    return true;
                }
            }
        }
        return false;
    }
@endphp

@extends('layouts.admin')
@section('title', 'Product List')
@section('card_name', 'Product List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Product List</li>
@endsection
@section('action')
    <a href="{{ route("product.create", strtolower($type)) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Product
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords($type." ". "Offers") }}</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="10%">Product Name</th>
                                <th width="4%">Product ID</th>
                                <th width="6%">USSD</th>
                                <th width="2%">Offer Type</th>
                                <th width="8%" class="text-center">Details</th>
                                <th width="4%" class="text-center">Trending Offer</th>
                                <th width="10%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                    @php $path = 'partner-offers-home'; @endphp
                                    <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name_en }}{!! $product->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_core['activation_ussd'] }}</td>
                                        <td>{{ $product->offer_category->name_en }} {{ $product->is_four_g_offer == 1 ? "(4G Offer)" : ''}}</td>
                                        <td class="text-center">
{{--                                            // Other Details ==============================================--}}
                                            @if(strtolower( $product->offer_category->name_en) == "others" || $product->offer_category->name_en == 'Packages')
                                                <a href="{{ route('section-list', [$type, $product->id]) }}"
                                                    class="btn-sm btn-outline-primary border">Details</a>
                                            @else
                                                <a href="{{ route('product.details', [strtolower($type), $product->product_code, strtolower( $product->offer_category->name_en)]) }}"
                                                   class="btn-sm btn-outline-primary border">Details</a>
                                            @endif
                                        </td>
                                        <td class="text-center"><input type="checkbox" {{ $product->show_in_home == 1 ? 'checked' : '' }} disabled></td>
                                        <td>
{{--                                            <a href="{{ route('product.show', [$type, $product->id]) }}" role="button" class="btn-sm btn-outline-secondary border-0"><i class="la la-eye" aria-hidden="true"></i></a>--}}
                                            <a href="{{ route('product.edit', [$type, $product->product_code]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            <a href="#" remove="{{ url("offers/$type/$product->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $product->id }}" title="Delete">
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

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Package Related Product</strong></h4><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("package/related-product/store") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                    <div class="form-group select-role col-md-12 mb-0 {{ $errors->has('related_product_id') ? ' error' : '' }}">
                                        <label for="related_product_id">Related Product</label>
                                        <div class="role-select">
                                            <select class="select2 form-control" multiple="multiple" name="other_attributes[{{$type}}_related_product_id][]">
                                                @foreach($products as $product)
                                                    @if(strtolower($product->offer_category->name_en) == 'packages')
                                                        <option value="{{ $product->id }}" {{ match($product->id, $packageRelatedProduct['other_attributes'], $type) ? 'selected' : '' }}>{{$product->name_en." / ".$product->product_code}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('related_product_id'))
                                            <div class="help-block">  {{ $errors->first('related_product_id') }}</div>
                                        @endif
                                    </div>
                                    <input type="hidden" name="type" value="{{ $type }}">
                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')

@endpush

@push('page-js')

@endpush





