@extends('layouts.admin')
@section('title', 'New Campaign Modality')
@section('card_name',"New Campaign Modality" )
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('new-campaign-modality.index') }}">Campaign List</a>
    </li>
    <li class="breadcrumb-item active">Create Campaign</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Campaign Create Form</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form novalidate class="form" method="POST" action="{{ route('new-campaign-modality.update', $campaign->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!--MyBL Campaign Section-->
                                <div class="form-group col-12">
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Campaign Section</strong></h5></div>
                                        <div class="form-actions col-md-12 mt-0"></div>

                                        <div class="form-group col-md-6" >
                                            <label  class="required">Select Campaign Tab </label>
                                            <select name="mybl_campaign_section_id" class="browser-default custom-select"
                                                    id="campaignTab" required data-validation-required-message="Please select campaign type">
                                                <option value="" >--Select Tap Section--</option>
                                                @foreach($campaignSection as $tab)
                                                    <option value="{{ $tab->id }}" {{ $campaign->mybl_campaign_section_id == $tab->id ? 'selected' : "" }} >{{ $tab->title_en }}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                            @if ($errors->has('type'))
                                                <div class="help-block">  {{ $errors->first('type') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="max_amount"></label>
                                            <a href="{{ route('mybl-campaign-section.create') }}" class="btn btn-outline-success mt-2"><i class="la la-plus"></i> Create New Section Tap</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--MyBL Campaign Details-->
                            <div class="row">
                                <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Campaign Details</strong></h5></div>
                                <div class="form-actions col-md-12 mt-0"></div>

                                <div class="form-group col-md-6">
                                    <label for="title" class="required">Campaign Name</label>
                                    <input required maxlength="250"
                                           data-validation-required-message="Title is required"
                                           data-validation-maxlength-message="Title can not be more then 250 Characters"
                                           type="text" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ $campaign->name }}"
                                           placeholder="Title" name="name">
                                    <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6" >
                                    <label  class="required">Select Campaign Type </label>
                                    <select name="type" class="browser-default custom-select"
                                            id="campaign-type" required data-validation-required-message="Please select campaign type">
                                        <option value="" >--Select Type--</option>
                                        @foreach($campaignType as $key => $type)
                                            <option value="{{ $key }}" {{ $campaign->type == $key ? 'selected' : "" }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Recurring Schedule<span class="red">*</span></label>
                                    @php
                                        $recurringType = $campaign->recurring_type;
                                        $denoType      = $campaign->deno_type;
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
                                                $weekdays = isset($campaign) ? explode(',', optional($campaign->schedule)->weekdays) ?? [] : [];
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
                                                    $dates = isset($campaign) ? explode(',', optional($campaign->schedule)->month_dates) ?? [] : [];
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
                                                    $slots = isset($campaign) ? $campaign->timeSlots->each(function ($item) {
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
                                    <label for="reward_getting_type">Purchase Eligibility</label>
                                    <div class="form-group {{ $errors->has('purchase_eligibility') ? ' error' : '' }}">
                                        <input type="radio" name="purchase_eligibility" value="ma_plus_recharge" id="maPlusRecharge"
                                            {{ $campaign->purchase_eligibility == 'ma_plus_recharge' ? 'checked' : '' }}>
                                        <label for="maPlusRecharge" class="mr-3">MA + Recharge</label>
                                        <input type="radio" name="purchase_eligibility" value="recharge" id="recharge"
                                            {{ $campaign->purchase_eligibility == 'recharge' ? 'checked' : '' }}>
                                        <label for="recharge" class="mr-3">Recharge Only</label>
                                        <input type="radio" name="purchase_eligibility" value="ma" id="ma"
                                            {{ $campaign->purchase_eligibility == 'ma' ? 'checked' : '' }}>
                                        <label for="ma" class="mr-3">MA Only</label>
                                        @if ($errors->has('purchase_eligibility'))
                                            <div class="help-block">  {{ $errors->first('purchase_eligibility') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Product Selection Section -->
                            <div class="row">
                                <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Product Selection Section</strong></h5></div>
                                <div class="form-actions col-md-12 mt-0"></div>
                            </div>

                            <div class="row">
                                <!--Deno Type-->
                                <div class="col-md-12 denoSection">
                                    <div class="form-group">
                                        <input type="radio" name="deno_type" value="selective_deno" id="selective_deno"
                                            {{ $campaign->deno_type == 'selective_deno' ? 'checked' : '' }}>
                                        <label for="selective_deno" class="mr-3">Selective Deno</label>

                                        <input type="radio" name="deno_type" value="all_deno" id="all_deno"
                                            {{ $campaign->deno_type == 'all_deno' ? 'checked' : '' }}>
                                        <label for="all_deno" class="mr-3">All Deno</label>

                                        <input type="radio" name="deno_type" value="selective_product" id="selective_product"
                                            {{ $campaign->deno_type == 'selective_product' ? 'checked' : '' }}>
                                        <label for="selective_product" class="mr-3">Selective Product</label>

                                        <input type="radio" name="deno_type" value="product_categories" id="product_categories"
                                            {{ $campaign->deno_type == 'product_categories' ? 'checked' : '' }}>
                                        <label for="product_categories" class="mr-3">Product Categories</label>
                                    </div>
                                </div>

                                <!--Product Section-->
                                {{--                                        <slot data-repeater-list="group-a" data-repeater-item>--}}
                                {{--                                            <div id="image-input" class="form-group col-md-6">--}}
                                {{--                                                <div class="form-group">--}}
                                {{--                                                    <label for="image_url">Thumbnail Image</label>--}}
                                {{--                                                    <input type="file" id="image_url" name="thumbnail_img" class="dropify" data-height="77"/>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                            <div id="image-input" class="form-group col-md-6 ">--}}
                                {{--                                                <div class="form-group">--}}
                                {{--                                                    <label for="image_url">Offer Card Image</label>--}}
                                {{--                                                    <input type="file" id="image_url" name="thumbnail_img" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"/>--}}
                                {{--                                                    <div class="help-block"></div>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                            <div class="form-group col-md-6">--}}
                                {{--                                                <label for="desc_en" class="required">Description En</label>--}}
                                {{--                                                <textarea rows="3" id="desc_en" name="desc_en" class="form-control" placeholder="Enter description in English"></textarea>--}}
                                {{--                                            </div>--}}

                                {{--                                            <div class="form-group col-md-6 ">--}}
                                {{--                                                <label for="desc_bn" class="required">Description Bn</label>--}}
                                {{--                                                <textarea rows="3" id="desc_bn" name="desc_bn"--}}
                                {{--                                                          class="form-control"--}}
                                {{--                                                          placeholder="Enter description in Bangla"></textarea>--}}
                                {{--                                            </div>--}}
                                {{--                                            @php--}}
                                {{--                                                $productType = '<span class="text-success">(Prepaid) </span>'--}}
                                {{--                                            @endphp--}}

                                {{--                                                <div class="form-group col-md-3">--}}
                                {{--                                                    <label for="start_date">Start Date</label>--}}
                                {{--                                                    <div class='input-group'>--}}
                                {{--                                                        <input type='text' class="form-control product_start_date" name="start_date" placeholder="Please select start date" autocomplete="off"/>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}

                                {{--                                                <div class="form-group col-md-3">--}}
                                {{--                                                    <label for="end_date">End Date</label>--}}
                                {{--                                                    <input type="text" name="end_date" class="form-control product_end_date" placeholder="Please select end date" autocomplete="off">--}}
                                {{--                                                </div>--}}

                                {{--                                                <div class="form-group col-md-3">--}}
                                {{--                                                    <label for="product_code" class="required">Product Code</label>--}}
                                {{--                                                    <select id="product_code" name="product_code" class="custom-select product-list">--}}
                                {{--                                                        <option value="">Select Product</option>--}}
                                {{--                                                        @foreach ($products as $key => $value)--}}
                                {{--                                                            <option value="{{ $value->product_code }}"{{ isset($product) && $product->product_code == $value->product_code ? 'selected' : '' }}--}}
                                {{--                                                            >{!! ($value->sim_type == 1 ? $productType : "(Postpaid) ") . $value->commercial_name_en . " / " . $value->product_code  !!}</option>--}}
                                {{--                                                        @endforeach--}}
                                {{--                                                    </select>--}}
                                {{--                                                </div>--}}

                                {{--                                                <div class="form-group col-md-3 mb-2" id="cta_action">--}}
                                {{--                                                    <label for="redirect_url">Product Status</label>--}}
                                {{--                                                    <select id="navigate_action" name="status" class="browser-default custom-select">--}}
                                {{--                                                        <option value="">Select Status</option>--}}
                                {{--                                                        <option class="text-success" value="1">Enable</option>--}}
                                {{--                                                        <option class="text-danger" value="0">Disable</option>--}}
                                {{--                                                    </select>--}}
                                {{--                                                    <div class="help-block"></div>--}}
                                {{--                                                </div>--}}

                                {{--                                            <!-- Product Row Delete -->--}}
                                {{--                                            <div class="form-group col-md-12 mb-1">--}}
                                {{--                                                <button data-repeater-delete type="button"--}}
                                {{--                                                        class="btn-sm btn-danger cursor-pointer float-right">--}}
                                {{--                                                    <i class="la la-trash"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </div>--}}
                                {{--                                        </slot>--}}

                                <!--Recharge Section-->

                                <!--All Deno-->
                                <slot class="allDeno">
                                    <div class="col-md-4" >
                                        <div class="form-group">
                                            <label class="required">Cashback Type : </label>
                                            <select name="cash_back_type" class="browser-default custom-select" id="cash_back_type" required>
                                                <option value="">Select Cashback Type</option>
                                                <option value="fixed_amount">Fixed Amount</option>
                                                <option value="percentage">Percentage</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 cash_back_amount_for_product">
                                        <label for="max_amount">Max Cash Back Amount</label>
                                        <input type="number" name="max_amount" class="form-control" placeholder="Please Enter Max Amount">
                                    </div>
                                </slot>

                                <!--Other Deno-->
                                <slot class="otherDeno" data-repeater-list="group-a" data-repeater-item>
                                    <div class="col-md-4">
                                        <label for="cash_back_amount">Enter Fixed/Percentage amount of Cashback</label>
                                        <input required type="number" name="cash_back_amount" id="cash_back_amount" class="form-control"
                                               placeholder="Enter The Fixed/Percentage of Cashback">
                                    </div>

                                    <div class="form-group col-md-4 }}">
                                        <label for="recharge_amount">Recharge Amount</label>
                                        <div class='input-group'>
                                            <input type='number' class="form-control" name="recharge_amount" required placeholder="Please select recharge amount" autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 number_of_apply_times_for_product">
                                        <label for="number_of_apply_times">No of apply times</label>
                                        <input type="number" name="number_of_apply_times" class="form-control" placeholder="Please Enter Max Amount">
                                    </div>

                                    <div class="form-group col-md-4 mb-2" id="cta_action">
                                        <label for="redirect_url">Cashback Status</label>
                                        <select id="navigate_action" name="status"
                                                class="browser-default custom-select">
                                            <option value="">Select Status</option>
                                            <option class="text-success" value="1">Enable</option>
                                            <option class="text-danger" value="0">Disable</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </slot>

                                <div class="form-group col-md-6">
                                    <label for="reward_getting_type">Show product as</label>
                                    <div class="form-group">
                                        <input type="radio" name="show_product_as" value="bottom_sheet" id="bottomSheet">
                                        <label for="bottomSheet" class="mr-3">Bottom Sheet</label>
                                        <input type="radio" name="show_product_as" value="recharge" id="popUp">
                                        <label for="popUp" class="mr-3">Pop-up</label>
                                        <input type="radio" name="show_product_as" value="campaign_only"
                                               id="campaign_only" checked>
                                        <label for="campaign_only" class="mr-3">Campaign Section only</label>
                                    </div>
                                </div>

                                <!-- Product Row Delete -->
                                {{--                                <div class="form-group col-md-12">--}}
                                {{--                                    <label for="redirect_url"></label>--}}
                                {{--                                    <button data-repeater-delete type="button"--}}
                                {{--                                            class="btn-sm btn-danger cursor-pointer float-right">--}}
                                {{--                                        <i class="la la-trash"></i>--}}
                                {{--                                    </button>--}}
                                {{--                                </div>--}}
                            </div>

                            <div class="row">
                                <slot id="productSection"></slot>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button id="repeater-button" type="button"
                                            class="btn-sm btn-success cursor-pointer float-right">
                                        <i class="la la-plus"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- WINNING LOGIC & CAPPING --}}
                            <div class="row">
                                <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>WINNING LOGIC & CAPPING</strong></h5></div>


                                <div class="form-actions col-md-12 mt-0"></div>
                                <div class="form-group col-md-4">
                                    <label for="winning_type">Winning Type: </label>
                                    <div class="form-group {{ $errors->has('winning_type') ? ' error' : '' }}">
                                        <input type="radio" name="winning_type" value="first_recharge" id="input-radio-15"
                                            {{ $campaign->winning_type == 'first_recharge' ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-3">First Recharge/Purchase</label> <br>
                                        <input type="radio" name="winning_type" value="highest_recharge" id="input-radio-16"
                                            {{ $campaign->winning_type == 'highest_recharge' ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Highest Recharge/Purchase</label>
                                        @if ($errors->has('winning_type'))
                                            <div class="help-block">  {{ $errors->first('winning_type') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="winning_interval">Highest Recharge/Purchase Winner Check</label>
                                    <input required type="number" name="winning_interval" class="form-control"
                                           value="{{ $campaign->winning_interval }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="winning_interval_unit">Winning Time Period Type: </label>
                                    <div class="form-group {{ $errors->has('winning_interval_unit') ? ' error' : '' }}">
                                        <input type="radio" name="winning_interval_unit" value="min" id="input-radio-15"
                                            {{ $campaign->winning_interval_unit == 'min' ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-3">MIN</label>
                                        <input type="radio" name="winning_interval_unit" value="hour" id="input-radio-16"
                                            {{ $campaign->winning_interval_unit == 'hour' ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">HOUR</label>
                                        <input type="radio" name="winning_interval_unit" value="day" id="input-radio-16"
                                            {{ $campaign->winning_interval_unit == 'day' ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Day</label>
                                        @if ($errors->has('winning_interval_unit'))
                                            <div class="help-block">  {{ $errors->first('winning_interval_unit') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="winning_massage_en" >Winning Communication Message (EN):</label>
                                    <textarea
                                        class="form-control @error('winning_massage_en') is-invalid @enderror" placeholder="Enter body description....." id="winning_massage_en"
                                        name="winning_massage_en" rows="5">{{ $campaign->winning_massage_en }}</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('winning_massage_en') {{ $message }} @enderror </small>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="winning_massage_bn" >Winning Communication Message (BN):</label>
                                    <textarea
                                        class="form-control @error('winning_massage_bn') is-invalid @enderror" placeholder="Enter body description....." id="winning_massage_bn"
                                        name="winning_massage_bn" rows="5">{{ $campaign->winning_massage_bn }}</textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('winning_massage_bn') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Reward Getting Type</strong></h5></div>
                                <div class="form-actions col-md-12 mt-0"></div>

                                <div class="form-group col-md-4">
                                    <label for="reward_getting_type">Reward Getting Type: </label>
                                    <div class="form-group {{ $errors->has('reward_getting_type') ? ' error' : '' }}">
                                        <input type="radio" name="reward_getting_type" class="reward_getting_type" value="single_time" id="singleTime"
                                            {{ $campaign->reward_getting_type == 'single_time' ? 'checked' : '' }}>
                                        <label for="singleTime" class="mr-3">Single Time</label>
                                        <input type="radio" name="reward_getting_type" class="reward_getting_type"
                                               value="multiple_time" id="multipleTime" {{ $campaign->reward_getting_type == 'multiple_time' ? 'checked' : '' }}>
                                        <label for="multipleTime" class="mr-3">Multiple Time</label>
                                        @if ($errors->has('reward_getting_type'))
                                            <div class="help-block">  {{ $errors->first('reward_getting_type') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-4" id="max_amount_for_campaign">
                                    <label for="max_amount">Max Cash Back Amount</label>
                                    <input  type="number" name="max_amount" class="form-control"
                                           value = "{{ $campaign->max_amount }}">
                                </div>

                                <div class="form-group col-md-4" id="number_of_apply_times_for_campaign">
                                    <label for="number_of_apply_times">No of apply times</label>
                                    <input  type="number" name="number_of_apply_times" class="form-control"
                                            value = "{{ $campaign->number_of_apply_times }}">
                                </div>

                                {{-- Select User Group --}}
                                <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Select User Group</strong></h5></div>
                                <div class="form-actions col-md-12 mt-0"></div>
                                <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                    <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12">
                                            <input  type="radio" name="user_group_type" value="all" class="campaign_user_type" id="all"
                                                {{ (isset($campaign) && $campaign->user_group_type == "all") ? 'checked' : '' }}>
                                            <label for="all">All</label>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <input type="radio" name="user_group_type" value="prepaid" class="campaign_user_type" id="prepaid"
                                                {{ (isset($campaign) && $campaign->user_group_type == "prepaid") ? 'checked' : '' }}>
                                            <label for="prepaid">Prepaid</label>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <input type="radio" name="user_group_type" value="postpaid" class="campaign_user_type" id="postpaid"
                                                {{ isset($campaign) && $campaign->user_group_type == "postpaid" ? 'checked' : '' }}>
                                            <label for="postpaid">Postpaid</label>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <input type="radio" name="user_group_type" value="segment_wise" class="campaign_user_type" id="segment_wise"
                                                {{ isset($campaign) && $campaign->user_group_type == "segment_wise" ? 'checked' : '' }} {{ isset($campaign) ? '' : 'checked' }}>
                                            <label for="segment_wise">Segment Wise (Base Msisdn)</label>
                                        </div>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 mb-2 {{ isset($campaign) && $campaign->user_group_type != "segment_wise" ? 'd-none' : '' }}" id="base_msisdn">
                                    <label for="redirect_url" class="required">Base Msisdn</label>
                                    <select id="base_groups_id" name="base_groups_id"
                                            class="browser-default custom-select">
                                        <option value="">Select Action</option>
                                        @foreach ($baseMsisdnGroups as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ isset($campaign) && $campaign->base_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-4 mb-2" id="exclude_base_groups_id">
                                    <label for="redirect_url" class="required">Exclude User Group</label>
                                    <select id="exclude_base_groups_id" name="exclude_base_groups_id"
                                            class="browser-default custom-select">
                                        <option value="">Select Action</option>
                                        @foreach ($baseMsisdnGroups as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ isset($campaign) && $campaign->exclude_base_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .section-row {
            background-color: #d0d1e1;
        }
        .section-row h5 {
            padding-top: 10px;
            padding-left: 10px;
        }
    </style>
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
    <script>
        $(document).ready(function () {
            // document.getElementById("disable-radio-button").disabled = true;
            // document.getElementById("disable-radio-button1").disabled = true;

            function dropify(){
                $('.dropify').dropify({
                    height: 70,
                    messages: {
                        'default': 'Add Banner Here',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    }
                });
            }

            dropify()

            let productElement = `<slot data-repeater-list="group-a" data-repeater-item>
                                        <div id="image-input" class="form-group col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="image_url">Thumbnail Image</label>
                                                <input type="file" id="image_url" name="thumbnail_img" class="dropify" data-height="77"/>
                                            </div>
                                        </div>

                                        <div id="image-input" class="form-group col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="image_url">Offer Card Image</label>
                                                <input type="file" id="image_url" name="thumbnail_img" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"/>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 mb-2">
                                            <label for="desc_en" class="required">Description En</label>
                                            <textarea rows="3" id="desc_en" name="desc_en" class="form-control" placeholder="Enter description in English"></textarea>
                                        </div>

                                        <div class="form-group col-md-4 mb-2">
                                            <label for="desc_bn" class="required">Description Bn</label>
                                            <textarea rows="3" id="desc_bn" name="desc_bn"
                                                      class="form-control"
                                                      placeholder="Enter description in Bangla"></textarea>
                                        </div>
                                        @php
                $productType = '<span class="text-success">(Prepaid) </span>'
            @endphp
            <div class="form-group col-md-4 mb-2" id="cta_action">
                <label for="product_code" class="required">Product Code</label>
                <select id="product_code" name="product_code" class="browser-default custom-select product-list">
                    <option value="">Select Product</option>
@foreach ($products as $key => $value)
            <option value="{{ $value->product_code }}"{{ isset($product) && $product->product_code == $value->product_code ? 'selected' : '' }}
            >{!! ($value->sim_type == 1 ? $productType : "(Postpaid) ") . $value->commercial_name_en . " / " . $value->product_code  !!}</option>
                                            @endforeach
            </select>
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-3">
            <label for="start_date">Start Date</label>
            <div class='input-group'>
                <input type='text' class="form-control product_start_date" name="start_date" placeholder="Please select start date" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group col-md-3">
            <label for="end_date">End Date</label>
            <input type="text" name="end_date" class="form-control product_end_date" placeholder="Please select end date" autocomplete="off">
        </div>

        <div class="form-group col-md-2 mb-2" id="cta_action">
            <label for="redirect_url">Product Status</label>
            <select id="navigate_action" name="status" class="browser-default custom-select">
                <option value="">Select Status</option>
                <option class="text-success" value="1">Enable</option>
                <option class="text-danger" value="0">Disable</option>
            </select>
            <div class="help-block"></div>
        </div>

        <!-- Product Row Delete -->
        <div class="form-group col-md-12 mb-1">
            <button data-repeater-delete type="button"
                    class="btn-sm btn-danger cursor-pointer float-right">
                <i class="la la-trash"></i>
            </button>
        </div>
    </slot>`

            let denoType = ``

            let allDeno = `
<slot class="allDeno">
    <div class="col-md-4" >
        <div class="form-group">
            <label class="required">Cashback Type : </label>
            <select name="cash_back_type" class="browser-default custom-select" id="cash_back_type" required>
                <option value="">Select Cashback Type</option>
                <option value="fixed_amount">Fixed Amount</option>
                <option value="percentage">Percentage</option>
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 cash_back_amount_for_product">
        <label for="max_amount">Max Cash Back Amount</label>
        <input type="number" name="max_amount" class="form-control" placeholder="Please Enter Max Amount">
    </div>

    <div class="form-group col-md-6">
        <label for="reward_getting_type">Show product as</label>
        <div class="form-group">
            <input type="radio" name="show_product_as" value="bottom_sheet" id="bottomSheet">
            <label for="bottomSheet" class="mr-3">Bottom Sheet</label>
            <input type="radio" name="show_product_as" value="recharge" id="popUp">
            <label for="popUp" class="mr-3">Pop-up</label>
            <input type="radio" name="show_product_as" value="campaign_only" checked>
            <label class="mr-3">Campaign Section only</label>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="redirect_url"></label>
        <button data-repeater-delete type="button" id="item-delete"
                class="btn-sm btn-danger cursor-pointer float-right">
            <i class="la la-trash"></i>
        </button>
    </div>
</slot>`

            let rechargeElement = `
<!--Recharge Section-->
<!--All Deno-->
<slot>
<slot class="allDeno">
    <div class="col-md-4" >
        <div class="form-group">
            <label class="required">Cashback Type : </label>
            <select name="cash_back_type" class="browser-default custom-select" id="cash_back_type" required>
                <option value="">Select Cashback Type</option>
                <option value="fixed_amount">Fixed Amount</option>
                <option value="percentage">Percentage</option>
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 cash_back_amount_for_product">
        <label for="max_amount">Max Cash Back Amount</label>
        <input type="number" name="max_amount" class="form-control" placeholder="Please Enter Max Amount">
    </div>
</slot>
<!--Other Deno-->
<slot class="otherDeno" data-repeater-list="group-a" data-repeater-item>
    <div class="col-md-4">
        <label for="cash_back_amount">Enter Fixed/Percentage amount of Cashback</label>
        <input required type="number" name="cash_back_amount" id="cash_back_amount" class="form-control"
               placeholder="Enter The Fixed/Percentage of Cashback">
    </div>

    <div class="form-group col-md-4 }}">
        <label for="recharge_amount">Recharge Amount</label>
        <div class='input-group'>
            <input type='number' class="form-control" name="recharge_amount" required placeholder="Please select recharge amount" autocomplete="off"/>
        </div>
    </div>

    <div class="form-group col-md-4 number_of_apply_times_for_product">
        <label for="number_of_apply_times">No of apply times</label>
        <input type="number" name="number_of_apply_times" class="form-control" placeholder="Please Enter Max Amount">
    </div>

    <div class="form-group col-md-4 mb-2" id="cta_action">
        <label for="redirect_url">Cashback Status</label>
        <select id="navigate_action" name="status"
                class="browser-default custom-select">
            <option value="">Select Status</option>
            <option class="text-success" value="1">Enable</option>
            <option class="text-danger" value="0">Disable</option>
        </select>
        <div class="help-block"></div>
    </div>
    <div class="form-group col-md-6">
        <label for="reward_getting_type">Show product as</label>
        <div class="form-group">
            <input type="radio" name="show_product_as" value="bottom_sheet" id="bottomSheet">
            <label for="bottomSheet" class="mr-3">Bottom Sheet</label>
            <input type="radio" name="show_product_as" value="recharge" id="popUp">
            <label for="popUp" class="mr-3">Pop-up</label>
            <input type="radio" name="show_product_as" value="campaign_only" checked>
            <label class="mr-3">Campaign Section only</label>
        </div>
    </div>

</slot>
<div class="form-group col-md-12">
    <label for="redirect_url"></label>
    <button data-repeater-delete type="button" id="item-delete"
            class="btn-sm btn-danger cursor-pointer float-right">
        <i class="la la-trash"></i>
    </button>
</div>
</slot>
`;

            $('input[name=deno_type]').change(function () {
                let denoType = $(this).val()
                if (denoType === "all_deno") {
                    // $('.allDeno').removeClass('d-none')
                    $('.otherDeno').addClass('d-none')
                    // $('#productSection').empty()
                    // $('#productSection').append(denoType + rechargeElement)
                } else if (denoType === "selective_deno") {
                    // $('.denoSection').addClass('d-none')
                    $('.allDeno').removeClass('d-none')
                    $('.otherDeno').removeClass('d-none')
                    // $('#productSection').empty()
                    // $('#productSection').append(productElement)
                    dropify()
                }
            })

            $(".product-list").select2()
            // $('.report-repeater').repeater();

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
                let denoType =  $('input[name=deno_type]:checked').val();
                if (denoType === "selective_deno"){
                    $('#productSection').append(rechargeElement)
                }else if (denoType === "all_deno") {
                    $('#productSection').append(allDeno)
                }
                // else {
                //     $('#productSection').append(productElement)
                // }

                // $(".product-list").select2()
                // var date = new Date();
                // date.setDate(date.getDate());
                // $('.product_start_date').datetimepicker({
                //     format : 'YYYY-MM-DD HH:mm:ss',
                //     showClose: true,
                // });
                // $('.product_end_date').datetimepicker({
                //     format : 'YYYY-MM-DD HH:mm:ss',
                //     showClose: true,
                // });
                // dropify()
            });

            // Campaign Section
            $('input[name=type]').change(function () {
                if($(this).val() === "ma_plus_recharge")
                    $('#maPlusRecharge').prop('disabled', 'disabled')
            })

            $("body").on("click", "#item-delete", function(){
                $(this).parent().parent().remove()
            })

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
                denoType = $('input[name=deno_type]:checked').val();
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
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
@endpush
