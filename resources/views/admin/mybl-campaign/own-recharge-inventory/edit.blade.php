@extends('layouts.admin')
@section('title', 'Own Recharge Invetory Edit')
@section('card_name',"Own Recharge Invetory Edit" )
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('own-recharge-inventory.index') }}">Own Recharge Inventory Campaign List</a>
    </li>
@endsection
@section('action')
    <a href="{{ route('own-recharge-inventory.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i>
        Cancel
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Campaign Edit Form</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form id="feed-form" novalidate class="form row"
                              action="{{ route('own-recharge-inventory.update', $campaign->id)}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                        <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12">
                                                <input type="radio" name="campaign_user_type" value="all" class="campaign_user_type" id="all"
                                                    {{ (isset($campaign) && $campaign->campaign_user_type == "all") ? 'checked' : '' }}>
                                                <label for="all">All</label>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <input type="radio" name="campaign_user_type" value="prepaid" class="campaign_user_type" id="prepaid"
                                                    {{ (isset($campaign) && $campaign->campaign_user_type == "prepaid") ? 'checked' : '' }}>
                                                <label for="prepaid">Prepaid</label>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <input type="radio" name="campaign_user_type" value="postpaid" class="campaign_user_type" id="postpaid"
                                                    {{ isset($campaign) && $campaign->campaign_user_type == "postpaid" ? 'checked' : '' }}>
                                                <label for="postpaid">Postpaid</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="radio" name="campaign_user_type" value="segment_wise" class="campaign_user_type" id="segment_wise"
                                                    {{ isset($campaign) && $campaign->campaign_user_type == "segment_wise" ? 'checked' : '' }} {{ isset($campaign) ? '' : 'checked' }}>
                                                <label for="segment_wise">Segment Wise (Base Msisdn)</label>
                                            </div>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('type'))
                                            <div class="help-block">  {{ $errors->first('type') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="title" class="required">Campaign Name</label>
                                        <input required maxlength="250"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 250 Characters"
                                               value="{{$campaign->title}}"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Title" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-4 {{ $errors->has('start_date') ? ' error' : '' }}">
                                        <label for="start_date">Start Date</label>
                                        <div class='input-group'>
                                            <input type='text' class="form-control" name="start_date" id="start_date"
                                                   placeholder="Please select start date"
                                                   value = {{ $campaign->start_date }}
                                                   autocomplete="off"/>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('start_date'))
                                            <div class="help-block">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('end_date') ? ' error' : '' }}">
                                        <label for="end_date">End Date</label>
                                        <input type="text" name="end_date" id="end_date" class="form-control"
                                               value = {{ $campaign->end_date }}
                                               placeholder="Please select end date"
                                               >
                                        <div class="help-block"></div>
                                        @if ($errors->has('end_date'))
                                            <div class="help-block">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 mb-2 {{ isset($campaign) && $campaign->campaign_user_type != "segment_wise" ? 'd-none' : '' }}" id="base_msisdn">
                                        <label for="redirect_url" class="required">Base Msisdn</label>
                                        <select id="base_msisdn_groups_id" name="base_msisdn_groups_id"
                                                class="browser-default custom-select">
                                            <option value="">Select Action</option>
                                            @foreach ($baseMsisdnGroups as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    {{ isset($campaign) && $campaign->base_msisdn_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-4" >
                                        <label  class="required">Purchase Eligibility : </label>
                                        <select name="purchase_eligibility" class="browser-default custom-select"
                                                id="purchase_eligibility" required data-validation-required-message="Please select Purchase Eligibility">
                                            <option value="">Select Purchase Eligibility</option>
                                            <option value="all" @if($campaign->purchase_eligibility == 'all') selected @endif>MA + Recharge</option>
                                            <option value="recharge" @if($campaign->purchase_eligibility == 'recharge') selected @endif>Recharge Only</option>
                                            <option value="ma" @if($campaign->purchase_eligibility == 'ma') selected @endif>MA Only</option>
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('purchase_eligibility'))
                                            <div class="help-block">  {{ $errors->first('purchase_eligibility') }}</div>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                            <label for="partner_channel_names" class="required">Select Partner Channel Name</label>
                                            <div class="role-select">
                                                <select class="select2 form-control" multiple="multiple" name="partner_channel_names[]"
                                                        required data-validation-required-message="Please Select Partner Channel Name">
                                                    @foreach(config('constants.partnerChannelName') as $name)
                                                        <option value="{{ $name }}" @if(in_array($name, $partnerChannelNames)) selected @endif>{{$name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('partner_channel_names'))
                                            <div class="help-block">  {{ $errors->first('partner_channel_names') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Campaign Image</label>
                                        <input type="file"
                                            id="banner"
                                            name="banner"
                                            class="dropify"
                                            data-default-file="{{ url($campaign->banner) }}"
                                       />
                                        @if($errors->has('banner'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('banner') }}</small>
                                            </p>
                                        @endif
                                    </div>
    
                                    <div class="form-group col-md-6">
                                        <label>Thumbnail Image</label>
                                        <input type="file"
                                            id="thumbnail_image"
                                            name="thumbnail_image"
                                            class="dropify"
                                            data-default-file="{{ url($campaign->thumbnail_image) }}"
                                       />
                                        @if($errors->has('thumbnail_image'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('thumbnail_image') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="body" class="required">Write Campaign Description (EN) :</label>
                                        <textarea
                                        required
                                        data-validation-required-message="Title is required"
                                        class="form-control @error('body') is-invalid @enderror" placeholder="Enter body description....." id="description_en" name="description_en" rows="10">{{$campaign->description_en}}</textarea>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('body') {{ $message }} @enderror </small>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="body" class="required">Write Campaign Description (BN) :</label>
                                        <textarea
                                        required
                                        data-validation-required-message="Title is required"
                                        class="form-control @error('body') is-invalid @enderror" placeholder="Enter body description....." id="description_bn" name="description_bn" rows="10">{{$campaign->description_bn}}</textarea>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('body') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <!-- Product Info Row Plus -->
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0 pl-0"><h5><strong>Product Selection Section</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                    <div class="form-group col-md-12 mb-0">
                                        <button data-repeater-create id="repeater-button" type="button"
                                                class="btn-sm btn-success cursor-pointer float-right">
                                            <i class="la la-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Selection Start -->
                                <div class="row report-repeater" id="productSection" data-repeater-list="product-group">
                                        @foreach($campaign->cashBackProducts as $product)
                                            @include('admin.mybl-campaign.own-recharge-inventory.partials.product-element', ['product' => $product])
                                        @endforeach
                                </div>

                                <!-- Product Selection End -->

                                <div class="row">
                                    <div class="form-actions col-md-12 mt-0 text-danger"></div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input">Campaign Status: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input type="radio" name="status" value="1" id="input-radio-15"
                                                {{ (isset($campaign->status) && $campaign->status == 1) ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input type="radio" name="status" value="0" id="input-radio-16"
                                                {{ (isset($campaign->status) && $campaign->status == 0) ? 'checked' : '' }}
                                                {{ isset($campaign->status) ? '' : 'checked' }}>
                                            <label for="input-radio-16" class="mr-3">Inactive</label>
                                            @if ($errors->has('status'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
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

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(".product-list").select2()
            $('.report-repeater').repeater();

            let campaignStart = $('#start_date');
            let campaignEnd = $('#end_date');
            let productStart = $('.product_start_date');
            let productEnd = $('.product_end_date');

            function dateTime(element){
                var date = new Date();
                date.setDate(date.getDate());
                element.datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
            }

            $('#repeater-button').click(function (){
                $(".product-list").select2()
                var date = new Date();
                date.setDate(date.getDate());
                $('.product_start_date').datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
                $('.product_end_date').datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
            })
            $('.campaign_user_type').click(function () {
                if ($(this).val() !== "segment_wise"){
                    $('#base_msisdn').addClass('d-none')
                } else {
                    $('#base_msisdn').removeClass('d-none')
                }
            })
            dateTime(campaignStart)
            dateTime(campaignEnd)
            dateTime(productStart)
            dateTime(productEnd)

            function initiateDropify(selector) {
                $(selector).dropify({
                    messages: {
                        'default': 'Browse for an Image to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    }
                });
            }
            initiateDropify('.dropify');
        });
    </script>

@endpush
