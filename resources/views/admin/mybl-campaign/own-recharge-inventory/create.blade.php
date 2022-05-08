@extends('layouts.admin')
@section('title', 'Own Recharge Inventory Campaign')
@section('card_name',"Own Recharge Inventory Campaign" )
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('own-recharge-inventory.index') }}">Own Recharge Inventory Campaign List</a>
    </li>
    <li class="breadcrumb-item active">Create Campaign</li>
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
                    <h5 class="menu-title"><strong>Campaign Create Form</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form novalidate class="form" method="POST" action="{{route('own-recharge-inventory.store')}}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Campaign Name</label>
                                        <input required maxlength="250"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 250 Characters"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Title" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6" >
                                        <label  class="required">Purchase Eligibility : </label>
                                        <select name="purchase_eligibility" class="browser-default custom-select"
                                                id="purchase_eligibility" required data-validation-required-message="Please select Purchase Eligibility">
                                            <option value="recharge" >Recharge Only</option>
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('purchase_eligibility'))
                                            <div class="help-block">  {{ $errors->first('purchase_eligibility') }}</div>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                            <label for="partner_channel_names" class="required">Select Partner Channel Name</label>
                                            <div class="role-select">
                                                <select class="select2 form-control" multiple="multiple" name="partner_channel_names[]">
                                                    @foreach(config('constants.partnerChannelName') as $name)
                                                        <option value="{{ $name }}">{{$name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('partner_channel_names'))
                                            <div class="help-block">  {{ $errors->first('partner_channel_names') }}</div>
                                        @endif
                                    </div>
                                    <!-- Recurring schedule -->
                                    <div class="col-md-6">
                                        <label class="form-label">Recurring Schedule<span class="red">*</span></label>
                                        @php
                                            $recurringType = 'none';
                                            $denoType      = 'none';
                                            $page = 'create';
                                        @endphp
                                        <div class="">
                                            <ul class="list list-inline">
                                                <li class="list-inline-item">
                                                    <input type="radio" name="recurring_type" id="none" value="none"
                                                        {{$recurringType == 'none' ? 'checked' : ''}}>
                                                    <label for="none" class="small">None</label>
                                                </li>
                                                <li class="list-inline-item">
                                                    <input id="daily" type="radio" name="recurring_type" value="daily"
                                                        {{$recurringType == 'daily' ? 'checked' : ''}}>
                                                    <label for="daily" class="small">Daily</label>
                                                </li>
                                                <li class="list-inline-item">
                                                    <input id="weekly" type="radio" name="recurring_type" value="weekly"
                                                        {{$recurringType == 'weekly' ? 'checked' : ''}}>
                                                    <label for="weekly" class="small">Weekly</label>
                                                </li>
                                                <li class="list-inline-item">
                                                    <input id="monthly" type="radio" name="recurring_type" value="monthly"
                                                        {{$recurringType == 'monthly' ? 'checked' : ''}}>
                                                    <label for="monthly" class="small">Monthly</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <!-- Regular time period (When recurring type is none) -->
                                            <div class="col-md-12">
                                                <div class="form-group" id="time_period">
                                                    <label class="small">Date Range</label>
                                                    <div class='input-group'>
                                                        <input type='text'
                                                            class="form-control datetime"
                                                            value="{{ $page == 'edit' ? $dateRange : old('display_period') }}"
                                                            name="display_period"
                                                            id="display_period"/>
                                                        @if($errors->has('display_period'))
                                                            <p class="text-left">
                                                                <small class="danger text-muted">
                                                                    {{ $errors->first('display_period') }}
                                                                </small>
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Weekday Picker -->
                                            <div class="col-md-12">
                                                @php
                                                    $weekdays = isset($popup) ? explode(',', optional($popup->schedule)->weekdays) ?? [] : [];
                                                @endphp

                                                <div class="weekDays-selector" id="weekday_selector"
                                                    @if($recurringType != 'weekly')
                                                        style="display: none"
                                                    @endif>
                                                    <input name="weekdays[]" value="sun" type="checkbox" id="weekday-sun"
                                                        class="weekday" {{in_array('sun', $weekdays) ? 'checked' : ''}}/>
                                                    <label for="weekday-sun">SU</label>
                                                    <input name="weekdays[]" value="mon" type="checkbox" id="weekday-mon"
                                                        {{in_array('mon', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                    <label for="weekday-mon">MO</label>
                                                    <input name="weekdays[]" value="tue" type="checkbox" id="weekday-tue"
                                                        {{in_array('tue', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                    <label for="weekday-tue">TU</label>
                                                    <input name="weekdays[]" value="wed" type="checkbox" id="weekday-wed"
                                                        {{in_array('wed', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                    <label for="weekday-wed">WE</label>
                                                    <input name="weekdays[]" value="thu" type="checkbox" id="weekday-thu"
                                                        {{in_array('thu', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                    <label for="weekday-thu">TH</label>
                                                    <input name="weekdays[]" value="fri" type="checkbox" id="weekday-fri"
                                                        {{in_array('fri', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                    <label for="weekday-fri">FR</label>
                                                    <input name="weekdays[]" value="sat" type="checkbox" id="weekday-sat"
                                                        {{in_array('sat', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                    <label for="weekday-sat">SA</label>
                                                </div>
                                                <br>
                                            </div>

                                            <!-- Month dates selector -->
                                            <div class="col-md-12" id="dates"
                                                @if($recurringType != 'monthly')
                                                style="display: none"
                                                @endif>
                                                <div class="form-group">
                                                    @php
                                                        $dates = isset($popup) ? explode(',', optional($popup->schedule)->month_dates) ?? [] : [];
                                                    @endphp
                                                    <select name="month_dates[]" id="month_dates" class="form-control"
                                                            multiple>
                                                        @for($i = 1; $i < 32; $i++)
                                                            <option
                                                                value="{{$i}}" {{in_array($i, $dates) ? 'selected' : ''}}>
                                                                {{$i}}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Time slot/hour selector -->
                                            <div class="col-md-12" id="time_slot"
                                                @if($recurringType == 'none')
                                                    style="display: none"
                                                @endif>
                                                <div class="form-group">
                                                    @php
                                                        $slots = isset($popup) ? $popup->timeSlots->each(function ($item) {
                                                            return $item->slot = date('h:i A', strtotime($item->start_time))
                                                            . ' - ' . date('h:i A', strtotime($item->end_time));
                                                            })->pluck('slot')->toArray() ?? [] : [];
                                                    @endphp
                                                    <select class="form-control" name="time_ranges[]" id="time_range"
                                                            multiple>
                                                        <option value=""></option>
                                                        @foreach($hourSlots as $slot)
                                                            <option
                                                                value="{{$slot}}" {{in_array($slot, $slots) ? 'selected' : ''}}>
                                                                {{$slot}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Campaign Image</label>
                                        <input type="file" name="banner" class="dropify" required data-validation-required-message="Please select Banner Image"/>
                                        <div class="help-block"></div>
                                        @if($errors->has('banner'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('banner') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Thumbnail Image</label>
                                        <input type="file"  name="thumbnail_image" class="dropify1" required data-validation-required-message="Please select Thumbnail Image"/>
                                        <div class="help-block"></div>
                                        @if($errors->has('thumbnail_image'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('thumbnail_image') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="description_en" >Write Campaign Description (EN) :</label>
                                        <textarea
                                        required
                                        data-validation-required-message="Description (EN) is required"
                                        class="form-control @error('description_en') is-invalid @enderror" placeholder="Enter body description....." id="description_en" name="description_en" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('description_en') {{ $message }} @enderror </small>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="description_bn" >Write Campaign Description (BN) :</label>
                                        <textarea
                                        data-validation-required-message="Description (BN) is required"
                                        class="form-control @error('description_bn') is-invalid @enderror" placeholder="Enter body description....." id="description_bn" name="description_bn" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('description_bn') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <!-- Product Info Row Plus -->
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0 pl-0"><h5><strong>Product Selection Section</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                </div>

                                <!-- Product Selection Start -->
                                <div class="row report-repeater" id="productSection" data-repeater-list="product-group">
                                    <div class="form-group col-md-8">
                                        <div class="form-group {{ $errors->has('deno_type') ? ' error' : '' }}">
                                            <input type="radio" name="deno_type" value="selective" id="input-radio-15">
                                            <label for="input-radio-15" class="mr-3">Selective Deno</label>
                                            <input type="radio" name="deno_type" value="all" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">All Deno</label>
                                            <input type="radio" name="" value="" id="disable-radio-button" >
                                            <label for="input-radio-16" class="mr-3">Product Category</label>
                                            <input type="radio" name="" value="" id="disable-radio-button1" >
                                            <label for="input-radio-16" class="mr-3">Selective Category</label>
                                            @if ($errors->has('deno_type'))
                                                <div class="help-block">  {{ $errors->first('deno_type') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    @include('admin.mybl-campaign.own-recharge-inventory.partials.product-element', ['denoType' => $denoType])
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <button data-repeater-create id="repeater-button" type="button"
                                                class="btn-sm btn-success cursor-pointer float-right">
                                            <i class="la la-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Selection End -->

                                {{-- WINNING LOGIC & CAPPING --}}
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0 pl-0"><h5><strong>WINNING LOGIC & CAPPING</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                    {{-- <div class="form-group col-md-4">
                                        <label for="winning_type">Winning Type: </label>
                                        <div class="form-group {{ $errors->has('winning_type') ? ' error' : '' }}">
                                            <input type="radio" name="winning_type" value="first_recharge" id="input-radio-15">
                                            <label for="input-radio-15" class="mr-3">First Recharge/Purchase</label> <br>
                                            <input type="radio" name="winning_type" value="highest_recharge" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">Highest Recharge/Purchase</label>
                                            @if ($errors->has('winning_type'))
                                                <div class="help-block">  {{ $errors->first('winning_type') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="winner_count">Highest Recharge/Purchase Winner Check</label>
                                        <input required type="number" name="winner_count" class="form-control"
                                            placeholder="Please Enter Highest Recharge/Purchase Winner Check"
                                            >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="winning_time_period_type">Winning Time Period Type: </label>
                                        <div class="form-group {{ $errors->has('winning_time_period_type') ? ' error' : '' }}">
                                            <input type="radio" name="winning_time_period_type" value="min" id="input-radio-15">
                                            <label for="input-radio-15" class="mr-3">MIN</label>
                                            <input type="radio" name="winning_time_period_type" value="hour" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">HOUR</label>
                                            <input type="radio" name="winning_time_period_type" value="day" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">Day</label>
                                            @if ($errors->has('winning_time_period_type'))
                                                <div class="help-block">  {{ $errors->first('winning_time_period_type') }}</div>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="form-group col-md-4">
                                        <label for="reward_getting_type">Reward Getting Type: </label>
                                        <div class="form-group {{ $errors->has('reward_getting_type') ? ' error' : '' }}">
                                            <input type="radio" name="reward_getting_type" class="reward_getting_type" value="single_time" id="input-radio-15">
                                            <label for="input-radio-15" class="mr-3">Single Time</label>
                                            <input type="radio" name="reward_getting_type" class="reward_getting_type" value="multiple_time" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">Multiple Time</label>
                                            @if ($errors->has('reward_getting_type'))
                                                <div class="help-block">  {{ $errors->first('reward_getting_type') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" id="max_amount_for_campaign">
                                        <label for="max_amount">Max Cash Back Amount</label>
                                        <input  type="number" name="max_amount" class="form-control"
                                            placeholder="Please Enter Max Cash Back Amount For Campaign"
                                            >
                                    </div>
                        
                                    <div class="form-group col-md-4" id="number_of_apply_times_for_campaign">
                                        <label for="number_of_apply_times">No of apply times</label>    
                                        <input  type="number" name="number_of_apply_times" class="form-control"
                                            placeholder="Please Enter No of Apply Times For Campaign"
                                            >
                                    </div>
                                    {{-- <div class="form-group col-md-4">
                                        <label for="max_no_of_winnig_times">Enter Maximum No. of Winning</label>    
                                        <input required type="number" name="max_no_of_winnig_times" class="form-control"
                                            placeholder="Please Enter Maximum No. of Winning"
                                            >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="max_cash_back_winning_amount">Max Cash Back Amount</label>
                                        <input required type="number" name="max_cash_back_winning_amount" class="form-control"
                                            placeholder="Please Enter Max Cash Back Amount"
                                            >
                                    </div> --}}
                                    {{-- <div class="form-group col-md-6 mb-2">
                                        <label for="communication_message_en" >Write Communication Message (EN):</label>
                                        <textarea
                                        class="form-control @error('communication_message_en') is-invalid @enderror" placeholder="Enter body description....." id="communication_message_en" name="communication_message_en" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('communication_message_en') {{ $message }} @enderror </small>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="communication_message_bn" >Write Communication Message (BN):</label>
                                        <textarea
                                        class="form-control @error('communication_message_bn') is-invalid @enderror" placeholder="Enter body description....." id="communication_message_bn" name="communication_message_bn" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('communication_message_bn') {{ $message }} @enderror </small>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0 pl-0"><h5><strong>Select User Group</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                    <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                        <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12">
                                                <input  type="radio" name="campaign_user_type" value="all" class="campaign_user_type" id="all"
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
                                </div>
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
@endsection

@push('style')

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script>
        $(document).ready(function () {
            document.getElementById("disable-radio-button").disabled = true;
            document.getElementById("disable-radio-button1").disabled = true;
            $('.dropify').dropify({
                height: 70,
                messages: {
                    'default': 'Add Banner Here',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                }
            });

            $('.dropify1').dropify({
                height: 70,
                messages: {
                    'default': 'Add Thumbnail Image Here',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                }
            });
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
            });

            $('.campaign_user_type').click(function () {
                if ($(this).val() !== "segment_wise"){
                    $('#base_msisdn').addClass('d-none')
                } else {
                    $('#base_msisdn').removeClass('d-none')
                }
            });

            dateTime(campaignStart)
            dateTime(campaignEnd)
            dateTime(productStart)
            dateTime(productEnd)
            var date;
            // Date & Time
            date = new Date();
            date.setDate(date.getDate());
            $('input[name=recurring_type]').change(function () {
            pickerFormat();
            });

            $('input[name=recurring_type]').ready(function () {
                pickerFormat();
            })
            function pickerFormat()
            {
                recurringType = $('input[name=recurring_type]:checked').val();
                console.log(recurringType);

                if (recurringType != 'none') {
                    $('.datetime').daterangepicker({
                        timePicker: false,
                        minDate: date,
                        locale: {
                            format: 'YYYY/MM/DD'
                        }
                    });
                } else {
                    $('.datetime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 5,
                        minDate: date,
                        locale: {
                            format: 'YYYY/MM/DD hh:mm A'
                        }
                    });
                }
            }
            $("#month_dates").select2({
                placeholder: 'Choose dates'
            });

            $("#time_range").select2({
                placeholder: 'Time slots'
            });

            $('.form').submit(function () {
                if ($('input[name=recurring_type]:checked').val() != 'none') {
                    let dateRange = $('#display_period').val().split("-");
                    var start = dateRange[0] + ' 12:00 AM';
                    var end = dateRange[1] + ' 11:59 PM';
                    $('#display_period').val(start + ' - ' + end);
                }
            });
    
            $('input[name=deno_type]').change(function () {
                denoType      = $('input[name=deno_type]:checked').val();
                if(denoType == 'all') {
                    $('.cash_back_amount_for_product').addClass('d-none');
                    $('.number_of_apply_times_for_product').addClass('d-none');
                }
                else {
                    $('.cash_back_amount_for_product').removeClass('d-none');
                    $('.number_of_apply_times_for_product').removeClass('d-none');
                }
            });
            $('.reward_getting_type').click(function () {
                if ($(this).val() == "single_time"){
                    $('#max_amount_for_campaign').addClass('d-none');
                    $('#number_of_apply_times_for_campaign').addClass('d-none');
                    
                } else {
                    $('#max_amount_for_campaign').removeClass('d-none');
                    $('#number_of_apply_times_for_campaign').removeClass('d-none');
                }
            });
        });
    </script>

@endpush
