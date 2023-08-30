@extends('layouts.admin')
@section('title', 'Mybl Products')

@section('card_name', "Product Create")

@section('action')
    <a href="{{ route('mybl-plan.products') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back To Product List
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong> Product Create Form</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        @if ($page == "edit")
                            <form class="form"
                                  action="{{ route('mybl-plan.products.update', $product->id)}}"
                                  enctype="multipart/form-data"
                                  method="POST"
                                  id="commentForm">
                                @csrf
                                @method('PUT')
                        @else
                            <form class="form"
                                action="{{ route('mybl-plan.products.store')}}"
                                enctype="multipart/form-data"
                                method="POST"
                                id="commentForm">
                                @csrf
                        @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sim_type" class="required">SIM Type</label>
                                        <select name="sim_type" required class="form-control">
                                            <option value="prepaid" @if($page == "edit" && $product->sim_type == "prepaid") selected @endif>PREPAID</option>
                                            <option value="postpaid" @if($page == "edit" && $product->sim_type == "postpaid") selected @endif>POSTPAID</option>
                                        </select>
                                    </div>
                                </div>

                                @php $types = ['data', 'mix', 'voice', 'sms']; @endphp

                                <div class="form-group col-md-4 {{ $errors->has('content_type') ? ' error' : '' }}">
                                    <label for="content_type">Content Type</label>
                                    <select name="content_type" class="form-control filter" id="content_type">
                                        <option value="">---Select Content Type---</option>
                                        @foreach ($types as $type)
                                        <option value="{{$type}}"
                                            @if($page == "edit" && $product->content_type == $type) selected @endif>
                                            {{strtoupper($type)}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('content_type'))
                                        <div class="help-block">{{ $errors->first('content_type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('product_code') ? ' error' : '' }}">
                                    <label for="product_code" class="required">Product Code</label>
                                    <input class="form-control" name="product_code" required
                                           data-validation-required-message="Please enter product code",
                                           placeholder="Enter Product Code"
                                           value="@if($page == "edit"){{ $product->product_code}}@else{{
                                                    old("product_code") ? old("product_code") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('product_code'))
                                        <div class="help-block">{{ $errors->first('product_code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('renew_product_code') ? ' error' : '' }}">
                                    <label for="renew_product_code">Renew Product Code</label>
                                    <input class="form-control" name="renew_product_code"
                                           placeholder="Enter Renew Product Code"
                                           value="@if($page == "edit"){{ $product->renew_product_code }}@else{{
                                                    old("renew_product_code") ? old("renew_product_code") : '' }}@endif">

                                    <div class="help-block"></div>
                                    @if ($errors->has('renew_product_code'))
                                        <div class="help-block">{{ $errors->first('renew_product_code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('recharge_product_code') ? ' error' : '' }}">
                                    <label for="recharge_product_code">Recharge Product Code</label>
                                    <input class="form-control" name="recharge_product_code"
                                             placeholder="Enter Recharge Product Code"
                                           value="@if($page == "edit"){{$product->recharge_product_code}}@else{{
                                                    old("recharge_product_code") ? old("recharge_product_code") : '' }}@endif">

                                    <div class="help-block"></div>
                                    @if ($errors->has('recharge_product_code'))
                                        <div class="help-block">{{ $errors->first('recharge_product_code') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>SMS Volume</label>
                                        <input type="number" class="form-control" name="sms_volume"
                                        placeholder="Enter SMS Volume"
                                        value="@if($page == "edit"){{ $product->sms_volume }}@else{{
                                                    old("sms_volume") ? old("sms_volume") : '' }}@endif">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Minute Volume</label>
                                        <input type="number" class="form-control" name="minute_volume"
                                        placeholder="Enter Minute Volume"
                                               value="@if($page == "edit"){{ $product->minute_volume}}@else{{
                                                old("minute_volume") ? old("minute_volume") : '' }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data Volume</label>
                                        <input type="number" class="form-control" name="data_volume"
                                        placeholder="Enter Data Volume"
                                               value="@if($page == "edit"){{ $product->data_volume}}@else {{
                                                    old("data_volume") ? old("data_volume") : '' }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data Volume Unit</label>
                                        <select name="data_volume_unit" class="form-control" name="" id="">
                                            <option value="">---Select Data Unit---</option>
                                            <option value="mb" @if($page == "edit" && $product->data_volume_unit == "mb") selected @endif>MB</option>
                                            <option value="gb" @if($page == "edit" && $product->data_volume_unit == "gb") selected @endif>GB</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="required">Validity</label>
                                        <input type="number" required data-validation-required-message="Please enter validity"
                                         class="form-control" name="validity"
                                        placeholder="Enter Validity"
                                               value="@if($page == "edit"){{ $product->validity}}@else{{
                                                    old("validity") ? old("validity") : '' }}@endif">
                                        <div class="help-block"></div>
                                        @if ($errors->has('validity'))
                                            <div class="help-block">{{ $errors->first('validity') }}</div>
                                        @endif
                                    </div>

                                </div>

                                @php
                                   $validityUnits = ['day', 'days', 'hour', 'hours', 'month', 'months', 'year', 'years'];
                                @endphp

                                <div class="form-group col-md-4 {{ $errors->has('validity_unit') ? ' error' : '' }}">
                                    <label for="validity_unit" class="validity_unit required">Validity Unit</label>
                                    <select class="form-control required duration_categories" required
                                        data-validation-required-message="Please select validity unit" name="validity_unit"
                                            id="validity_unit" required>
                                        <option value="">---Select Validity Unit---</option>
                                        @foreach($validityUnits as $value)
                                            <option value="{{ $value }}" @if ($page == "edit" && $product->validity_unit == $value) selected
                                                        @else {{ old("validity_unit") == $value ? 'selected' : '' }} @endif>
                                                        {{ ucfirst($value) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('validity_unit'))
                                        <div class="help-block">{{ $errors->first('validity_unit') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label class="required">Market Price</label>
                                        <input type="number" class="form-control" required
                                        data-validation-required-message="Please enter market price" name="market_price"
                                        placeholder="Enter MRP Price"
                                               value="@if($page == "edit"){{ $product->market_price}}@else{{
                                                    old("market_price") ? old("market_price") : '' }} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('market_price'))
                                        <div class="help-block">{{ $errors->first('market_price') }}</div>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label class="required">Discount Price</label>
                                        <input type="number" class="form-control" required
                                        data-validation-required-message="Please enter discount price" name="discount_price"
                                        placeholder="Enter Discount Price"
                                               value="@if($page == "edit"){{ $product->discount_price}}@else{{
                                                    old("discount_price") ? old("discount_price") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('discount_price'))
                                        <div class="help-block">{{ $errors->first('discount_price') }}</div>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('discount_percentage') ? ' error' : '' }}">
                                    <label class="required">Discount Percentage (%)</label>
                                    <input type="number" class="form-control" required
                                     name="discount_percentage" data-validation-required-message="Please enter discount percentage"
                                    placeholder="Enter Discount Percentage"
                                           value="@if($page == "edit"){{ $product->discount_percentage}}@else{{
                                                old("discount_percentage") ? old("discount_percentage") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('discount_percentage'))
                                        <div class="help-block">{{ $errors->first('discount_percentage') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('points') ? ' error' : '' }}">
                                    <label>Points</label>
                                    <input type="number" class="form-control" name="points"
                                    placeholder="Enter Points"
                                           value="@if($page == "edit"){{ $product->points}}@else {{ old("points") ? old("points") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('points'))
                                        <div class="help-block">{{ $errors->first('points') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('tag') ? ' error' : '' }}">
                                    <label>Tag</label>
                                    <input type="text" class="form-control" name="tag"
                                        placeholder="Enter Tag"
                                           value="@if($page == "edit") {{ $product->tag}}@else{{ old("tag") ? old("tag") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag'))
                                        <div class="help-block">{{ $errors->first('tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('display_sd_vat_tax_en') ? ' error' : '' }}">
                                    <label class="required">Display SD Vat Tax EN</label>
                                    <input class="form-control" name="display_sd_vat_tax_en"
                                        placeholder="Enter Display SD Vat Tax EN"
                                        required data-validation-required-message="Please enter discount percentage en"
                                        value="@if($page == "edit"){{ $product->display_sd_vat_tax_en}}@else{{
                                                    old("display_sd_vat_tax_en") ? old("display_sd_vat_tax_en") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('display_sd_vat_tax_en'))
                                        <div class="help-block">{{ $errors->first('display_sd_vat_tax_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('display_sd_vat_tax_bn') ? ' error' : '' }}">
                                    <label class="required">Display SD Vat Tax BN</label>
                                    <input class="form-control" name="display_sd_vat_tax_bn" required
                                        data-validation-required-message="Please enter discount percentage bn"
                                        placeholder="Enter Display SD Vat Tax BN"
                                        value="@if($page == "edit"){{ $product->display_sd_vat_tax_bn }}@else{{
                                                old("display_sd_vat_tax_bn") ? old("display_sd_vat_tax_bn") : '' }}@endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('display_sd_vat_tax_bn'))
                                        <div class="help-block">{{ $errors->first('display_sd_vat_tax_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('status') ? ' error' : '' }}">
                                    <label>Status</label>
                                    <select class="form-control" name="is_active">
                                        <option value="">---Select Status---</option>
                                        <option value="1" @if($page == "create") selected @endif
                                                @if($page == "edit" && $product->is_active == 1) selected @endif>Active</option>
                                        <option value="0" @if($page == "edit" && $product->is_active == 0) selected @endif>Inactive</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('status'))
                                        <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 icheck_minimal skin mt-2">
                                    <fieldset style='margin-top: 15px'>
                                        <input type="checkbox" @if($page == "edit" && $product->is_default == 1) checked @endif id="is_default" value="1" name="is_default">
                                        <label for="is_default">Is Default Product?</label>
                                    </fieldset>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button class="btn btn-primary"><i
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
@endsection

@push('style')
    <style>
        .form-group .help-block ul {
            padding-left: 0; !important;
        }
        .error {
            color: red !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="{{asset('app-assets')}}/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(function () {
            $("#commentForm").validate();
        })
    </script>
@endpush
