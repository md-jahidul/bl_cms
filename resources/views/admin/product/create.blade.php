@extends('layouts.admin')
@php $type = ucfirst($type)  @endphp
@section('title', "$type Offer Create")
@section('card_name', "$type Offer Create")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
    <li class="breadcrumb-item active"> {{ $type }} Offer Create</li>
@endsection
@section('action')
    <a href="{{ route('product.list', $type) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>{{ $type }} Offer Create</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('product.store', strtolower($type)) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer Type</label>
                                    <select class="form-control required" name="offer_category_id" id="offer_type"
                                            required data-validation-required-message="Please select offer">
                                        <option data-alias="" value="">---Select Offer Type---</option>
                                        @foreach($offers as $offer)
                                            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}">{{ $offer->name_en }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en">Offer Name (English)</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter offer name in English"
                                           value="{{ old("name_en") ? old("name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Offer Name (Bangla)</label>
                                    <input type="text" name="name_bn" id="name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <slot id="others" data-offer-type="others" style="display: none">
                                    @include('layouts.partials.products.other')
                                </slot>

                                <slot id="packages" data-offer-type="packages" style="display: none">
                                    @include('layouts.partials.products.packages')
                                </slot>

                                <slot id="internet" data-offer-type="internet" style="display: none">
                                    @include('layouts.partials.products.common-field.product_code')
                                    @include('layouts.partials.products.internet')
                                    @include('layouts.partials.products.common-field.price_vat_mrp')
                                    @include('layouts.partials.products.common-field.start_end_date')
                                    @include('layouts.partials.products.common-field.ussd_code')
                                    @include('layouts.partials.products.common-field.balance_check')
                                    @include('layouts.partials.products.common-field.tag')
                                </slot>

                                @if( strtolower($type) == 'prepaid')
                                    <slot id="call_rate" data-offer-type="call_rate" style="display: none">
                                        @include('layouts.partials.products.common-field.product_code')
                                        @include('layouts.partials.products.call_rate')
                                        @include('layouts.partials.products.common-field.call_rate_unit')
                                        @include('layouts.partials.products.common-field.price_vat_mrp')
                                        @include('layouts.partials.products.common-field.start_end_date')
                                        @include('layouts.partials.products.common-field.ussd_code')
                                        @include('layouts.partials.products.common-field.tag')
                                    </slot>
                                    <slot id="voice" data-offer-type="voice" style="display: none">
                                        @include('layouts.partials.products.common-field.product_code')
                                        @include('layouts.partials.products.voice')
                                        @include('layouts.partials.products.common-field.price_vat_mrp')
                                        @include('layouts.partials.products.common-field.start_end_date')
                                        @include('layouts.partials.products.common-field.ussd_code')
                                        @include('layouts.partials.products.common-field.balance_check')
                                        @include('layouts.partials.products.common-field.tag')
                                    </slot>
                                    <slot id="bundles" data-offer-type="bundles" style="display: none">
                                        @include('layouts.partials.products.common-field.product_code')
                                        @include('layouts.partials.products.bundle')
                                        @include('layouts.partials.products.common-field.price_vat_mrp')
                                        @include('layouts.partials.products.common-field.start_end_date')
                                        @include('layouts.partials.products.common-field.ussd_code')
                                        @include('layouts.partials.products.common-field.balance_check')
                                        @include('layouts.partials.products.common-field.tag')
                                    </slot>
                                @endif

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group" id="show_in_home">
                                        <label for="trending" class="mr-1">Trending Offer:</label>
                                        <input type="checkbox" name="show_in_home" value="1" id="trending">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="special_product" class="mr-1">Is Special Product:</label>
                                        <input type="checkbox" name="special_product" value="1" id="special_product">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button id="save" class="btn btn-primary"><i
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
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>

    <script>
        $(function () {
            $('#product_core').selectize({
                create: true,
            });
        })
    </script>
@endpush


