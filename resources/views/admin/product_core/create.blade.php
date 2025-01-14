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
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Offer Name (English)</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter offer name in English"
                                           required data-validation-required-message="Enter offer name english"
                                           value="{{ old("name_en") ? old("name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('product_code') ? ' error' : '' }}">
                                    <label for="product_code" class="required">Product ID</label>
                                    <select id="product_core" name="product_code"
                                            data-url="{{ url('product-core/match') }}"
                                            required data-validation-required-message="Please select product code">
                                        <option value="">Select product code</option>
                                        @foreach($productCoreCodes as $productCodes)
                                            <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['product_code'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Offer Name (Bangla)</label>
                                    <input type="text" name="name_bn" id="name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                           required data-validation-required-message="Enter offer name in Bangla"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date" class="required">Start Date</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_date" id="start_date"
                                               value="{{ old("start_date") ? old("start_date") : '' }}"
                                               required data-validation-required-message="Please select start date"
                                               placeholder="Please select start date" />
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="activation_ussd">USSD Code (English)</label>
                                    <input type="text" name="activation_ussd" id="activation_ussd" class="form-control" placeholder="Enter offer ussd code in English"
                                           value="{{ old("activation_ussd") ? old("activation_ussd") : '' }}">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                           placeholder="Please select end date"
                                           value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="0">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd_bn">USSD Code (Bangla)</label>
                                    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd code in Bangla"
                                           value="{{ old("ussd_bn") ? old("ussd_bn") : '' }}">
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="price">Offer Price</label>
                                        <input type="text" name="price" id="price"  class="form-control" placeholder="Enter offer price in taka" step="0.001"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ old("price") ? old("price") : '' }}">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="price">Vat</label>
                                        <input type="text" name="vat" id="vat" class="form-control" placeholder="Enter offer price in taka" step="0.001"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ old("price") ? old("price") : '' }}">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option value="">---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>

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



                                <slot id="internet" data-offer-type="internet" style="display: none">
                                    @include('layouts.partials.products.internet')
                                </slot>
                                <slot id="packages" data-offer-type="packages" style="display: none">
                                    @include('layouts.partials.products.packages')
                                </slot>

                                <slot id="others" data-offer-type="others" style="display: none">
                                    @include('layouts.partials.products.other')
                                </slot>

                                @if( strtolower($type) == 'prepaid')
                                    <slot id="call_rate" data-offer-type="call_rate" style="display: none">
                                        @include('layouts.partials.products.call_rate')
                                    </slot>
                                    <slot id="voice" data-offer-type="voice" style="display: none">
                                        @include('layouts.partials.products.voice')
                                    </slot>
                                    <slot id="bundles" data-offer-type="bundles" style="display: none">
                                        @include('layouts.partials.products.bundle')
                                    </slot>
                                @endif

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="purchase_option" class="required">Purchase Option</label>
                                    <select class="form-control required" name="purchase_option" id="offer_type"
                                        required data-validation-required-message="Please select purchase option">
                                        <option data-alias="" value="">---Select Purchase Option---</option>
                                        <option value="recharge">Recharge</option>
                                        <option value="balance">Balance</option>
                                        <option value="all">All</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('purchase_option'))
                                        <div class="help-block">{{ $errors->first('purchase_option') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group" id="show_in_home">
                                        <label for="trending" class="mr-1">Trending Offer:</label>
                                        <input type="checkbox" name="show_in_home" value="1" id="trending">
                                    </div>
                                </div>

{{--                                TODO: Check Delete Recharge --}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="title" class="mr-1">Recharge</label>--}}
{{--                                        <input type="radio" name="is_recharge" value="1" id="yes">--}}
{{--                                        <label for="yes" class="mr-1">Yes</label>--}}
{{--                                        <input type="radio" name="is_recharge" value="0" id="no" checked>--}}
{{--                                        <label for="no">No</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}



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


