@extends('layouts.admin')
@section('title', 'Refer And Earn')
@section('card_name',"Refer And Earn" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Refer And Earn Campaign</li>
@endsection
@section('action')
    <a href="{{ route('mybl-refer-and-earn.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i>
        Cancel
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Refer Card Information</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form id="refer_form"  class="form row"
                              action="{{ (isset($campaign)) ? route('mybl-refer-and-earn.update', $campaign->id) : route('mybl-refer-and-earn.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @if(isset($campaign))
                                @method('put')
                            @else
                                @method('post')
                            @endif
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="campaign_title" class="required">Campaign Name</label>
                                        <input required
                                               maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->campaign_title : old('campaign_title') }}" id="campaign_title"
                                               type="text" class="form-control @error('campaign_title') is-invalid @enderror"
                                               placeholder="Title" name="campaign_title">
                                        <small class="text-danger"> @error('campaign_title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>


                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_title" class="required">Card Title En</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->dashboard_card_title : old('dashboard_card_title') }}"
                                               id="dashboard_card_title"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Enter title in English" name="dashboard_card_title">
                                        <small class="text-danger"> @error('dashboard_card_title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_title_bn" class="required">Card Title Bn</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->dashboard_card_title_bn : old('dashboard_card_title_bn') }}"
                                               id="dashboard_card_title_bn"
                                               type="text" class="form-control"
                                               placeholder="Enter title in English" name="dashboard_card_title_bn">
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_sub_title">Description En</label>
                                        <textarea rows="4" id="dashboard_card_sub_title"
                                                  name="dashboard_card_sub_title"
                                                  class="form-control @error('dashboard_card_sub_title') is-invalid @enderror"
                                                  placeholder="Enter dashboard in English">{{ isset($campaign) ? $campaign->dashboard_card_sub_title : old('dashboard_card_sub_title') }}</textarea>
                                        <small class="text-danger"> @error('dashboard_card_sub_title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_sub_title_bn">Description Bn</label>
                                        <textarea rows="4" id="dashboard_card_sub_title_bn"
                                                  name="dashboard_card_sub_title_bn"
                                                  class="form-control @error('dashboard_card_sub_title_bn') is-invalid @enderror"
                                                  placeholder="Enter dashboard in Bangla">{{ isset($campaign) ? $campaign->dashboard_card_sub_title_bn : old('dashboard_card_sub_title_bn') }}</textarea>
                                        <small
                                            class="text-danger"> @error('dashboard_card_sub_title_bn') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>


                                    <div class="form-group col-md-6 {{ $errors->has('product_code') ? ' error' : '' }}">
                                        <label for="product_code" class="required">Referrer Prepaid Product Code</label>
                                        @if(isset($campaign))
                                            <input required maxlength="200"
                                                   data-validation-required-message="Please select product code"
                                                   data-validation-maxlength-message="Title can not be more then 200 Characters"
                                                   value="{{ isset($campaign) ? $campaign->referrer_product_code : old('dashboard_card_title_bn') }}"
                                                   id="dashboard_card_title_bn"
                                                   type="text" class="form-control"
                                                   placeholder="Please select product code" name="referrer_product_code">
                                        @else
                                            <select class="product_code" name="referrer_product_code"
                                                    data-url="{{ url('product-core/match') }}"
                                                    required data-validation-required-message="Please select product code">
                                                <option value="">Select product code</option>
    {{--                                            {{ dd($campaign->referrer_product_code) }}--}}
                                                @foreach($products as $productCodes)
                                                    <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['commercial_name_en'] . " / " . $productCodes['product_code'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-warning">If product exists in the list, select dropdown. otherwise, type then enter</span>
                                        @endif
                                        <div class="help-block"></div>
                                        @if ($errors->has('referrer_product_code'))
                                            <div class="help-block">{{ $errors->first('referrer_product_code') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('referee_product_code') ? ' error' : '' }}">
                                        <label for="referee_product_code" class="required">Referee Prepaid Product Code</label>
                                        @if(isset($campaign))
                                            <input required maxlength="200"
                                                   data-validation-required-message="Please select product code"
                                                   data-validation-maxlength-message="Title can not be more then 200 Characters"
                                                   value="{{ isset($campaign) ? $campaign->referee_product_code : old('dashboard_card_title_bn') }}"
                                                   id="dashboard_card_title_bn"
                                                   type="text" class="form-control"
                                                   placeholder="Please select product code" name="referee_product_code">
                                        @else
                                            <select class="product_code" name="referee_product_code"
                                                    data-url="{{ url('product-core/match') }}"
                                                    required data-validation-required-message="Please select product code">
                                                <option value="">Select product code</option>
                                                @foreach($products as $productCodes)
                                                    <option
                                                        value="{{ $productCodes['product_code'] }}">{{ $productCodes['commercial_name_en'] . " / " . $productCodes['product_code'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-warning">If product exists in the list, select dropdown. otherwise, type then enter</span>
                                        @endif
                                        <div class="help-block"></div>
                                        @if ($errors->has('referee_product_code'))
                                            <div class="help-block">{{ $errors->first('referee_product_code') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('product_code') ? ' error' : '' }}">
                                        <label for="product_code" class="required">Referrer Postpaid Product Code</label>
                                        @if(isset($campaign))
                                            <input required maxlength="200"
                                                   data-validation-required-message="Please select product code"
                                                   data-validation-maxlength-message="Title can not be more then 200 Characters"
                                                   value="{{ isset($campaign) ? $campaign->referrer_product_code_postpaid : old('dashboard_card_title_bn') }}"
                                                   id="dashboard_card_title_bn"
                                                   type="text" class="form-control"
                                                   placeholder="Please select product code" name="referrer_product_code_postpaid">
                                        @else
                                            <select class="product_code" name="referrer_product_code_postpaid"
                                                    data-url="{{ url('product-core/match') }}"
                                                    required data-validation-required-message="Please select product code">
                                                <option value="">Select product code</option>
                                                {{--                                            {{ dd($campaign->referrer_product_code_postpaid) }}--}}
                                                @foreach($products as $productCodes)
                                                    <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['commercial_name_en'] . " / " . $productCodes['product_code'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-warning">If product exists in the list, select dropdown. otherwise, type then enter</span>
                                        @endif
                                        <div class="help-block"></div>
                                        @if ($errors->has('referrer_product_code_postpaid'))
                                            <div class="help-block">{{ $errors->first('referrer_product_code_postpaid') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('referee_product_code_postpaid') ? ' error' : '' }}">
                                        <label for="referee_product_code_postpaid" class="required">Referee Postpaid Product Code</label>
                                        @if(isset($campaign))
                                            <input required maxlength="200"
                                                   data-validation-required-message="Please select product code"
                                                   data-validation-maxlength-message="Title can not be more then 200 Characters"
                                                   value="{{ isset($campaign) ? $campaign->referee_product_code_postpaid : old('dashboard_card_title_bn') }}"
                                                   id="dashboard_card_title_bn"
                                                   type="text" class="form-control"
                                                   placeholder="Please select product code" name="referee_product_code_postpaid">
                                        @else
                                            <select class="product_code" name="referee_product_code_postpaid"
                                                    data-url="{{ url('product-core/match') }}"
                                                    required data-validation-required-message="Please select product code">
                                                <option value="">Select product code</option>
                                                @foreach($products as $productCodes)
                                                    <option
                                                        value="{{ $productCodes['product_code'] }}">{{ $productCodes['commercial_name_en'] . " / " . $productCodes['product_code'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-warning">If product exists in the list, select dropdown. otherwise, type then enter</span>
                                        @endif
                                        <div class="help-block"></div>
                                        @if ($errors->has('referee_product_code_postpaid'))
                                            <div class="help-block">{{ $errors->first('referee_product_code_postpaid') }}</div>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                        <label for="start_date">Start Date</label>
                                        <div class='input-group'>
                                            <input type='text' class="form-control" name="start_date" id="start_date"
                                                   placeholder="Please select start date"
                                                   value="{{ isset($campaign) ? $campaign->start_date : old('start_date') }}"
                                                   autocomplete="off"/>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('start_date'))
                                            <div class="help-block">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                        <label for="end_date">End Date</label>
                                        <input type="text" name="end_date" id="end_date" class="form-control"
                                               placeholder="Please select end date"
                                               value="{{ isset($campaign) ? $campaign->end_date : old('end_date') }}" autocomplete="off">
                                        <div class="help-block"></div>
                                        @if ($errors->has('end_date'))
                                            <div class="help-block">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>

                                    <!-- Refer Card Details Info-->
                                    <div class="col-md-12 pl-0"><h5><strong>Refer Card Details Info</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title" class="required">Card Title En</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->refer_card_title : old('refer_card_title') }}"
                                               id="title"
                                               type="text" class="form-control @error('refer_card_title') is-invalid @enderror"
                                               placeholder="Enter title in English" name="refer_card_title">
                                        <small class="text-danger"> @error('refer_card_title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="refer_card_title_bn" class="required">Card Title Bn</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->refer_card_title_bn : old('refer_card_title_bn') }}"
                                               id="refer_card_title_bn"
                                               type="text" class="form-control"
                                               placeholder="Enter title in English" name="refer_card_title_bn">
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="refer_card_sub_title">Description En</label>
                                        <textarea rows="4" id="refer_card_sub_title"
                                                  name="refer_card_sub_title"
                                                  class="form-control @error('refer_card_sub_title') is-invalid @enderror"
                                                  placeholder="Enter dashboard in English">{{ isset($campaign) ? $campaign->refer_card_sub_title : old('refer_card_sub_title') }}</textarea>
                                        <small
                                            class="text-danger"> @error('refer_card_sub_title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="refer_card_sub_title_bn">Description Bn</label>
                                        <textarea rows="4" id="refer_card_sub_title_bn"
                                                  name="refer_card_sub_title_bn"
                                                  class="form-control @error('refer_card_sub_title_bn') is-invalid @enderror"
                                                  placeholder="Enter dashboard in Bangla">{{ isset($campaign) ? $campaign->refer_card_sub_title_bn : old('refer_card_sub_title_bn') }}</textarea>
                                        <small
                                            class="text-danger"> @error('refer_card_sub_title_bn') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="redeem_card_title" class="required">Redeem Title En</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->redeem_card_title : old('redeem_card_title') }}"
                                               id="redeem_card_title"
                                               type="text" class="form-control @error('redeem_card_title') is-invalid @enderror"
                                               placeholder="Enter title in English" name="redeem_card_title">
                                        <small class="text-danger"> @error('redeem_card_title') {{ $message }} @enderror </small>
                                        <small class="text-info">Example: <strong>Forgot To Use Refer Code?</strong></small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="redeem_card_title_bn" class="required">Redeem Title Bn</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->redeem_card_title_bn : old('redeem_card_title_bn') }}"
                                               id="redeem_card_title_bn"
                                               type="text" class="form-control"
                                               placeholder="Enter title in English" name="redeem_card_title_bn">
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="redeem_card_sub_title" class="required">Redeem Sub Title En</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->redeem_card_sub_title : old('redeem_card_sub_title') }}"
                                               id="redeem_card_sub_title"
                                               type="text" class="form-control @error('redeem_card_sub_title') is-invalid @enderror"
                                               placeholder="Enter title in English" name="redeem_card_sub_title">
                                        <small class="text-danger"> @error('redeem_card_sub_title') {{ $message }} @enderror </small>
                                        <small class="text-info">Example: <strong>Use it now and get 500 MB</strong></small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="redeem_card_sub_title_bn" class="required">Redeem Sub Title Bn</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ isset($campaign) ? $campaign->redeem_card_sub_title_bn : old('redeem_card_sub_title_bn') }}"
                                               id="redeem_card_sub_title_bn"
                                               type="text" class="form-control"
                                               placeholder="Enter title in English" name="redeem_card_sub_title_bn">
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="col-md-12 pl-0"><h5><strong>Refferal Claim And Other Settings</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                    <div class="form-group col-md-3 mb-2">
                                        <label for="claim_reward_type">Claim Reward Type: </label>
                                        <div class="form-group {{ $errors->has('claim_reward_type') ? ' error' : '' }}">
                                            <input type="radio" name="claim_reward_type" class="claim_reward_type radio" value="unlimited" id="input-radio-17"
                                                {{ (isset($campaign->claim_reward_type) && $campaign->claim_reward_type == "unlimited") ? 'checked' : '' }}>
                                            <label for="input-radio-17" class="mr-3">Unlimited</label>
                                            <input type="radio" name="claim_reward_type" class="claim_reward_type" value="capped" id="input-radio-19"
                                                {{ (isset($campaign->claim_reward_type) && $campaign->claim_reward_type == "capped") ? 'checked' : '' }}>
                                            <label for="input-radio-19" class="mr-3">Capped</label>
                                            @if ($errors->has('claim_reward_type'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mb-2 capped-check {{ isset($campaign) && $campaign->claim_reward_type == "capped" ? "" : "d-none" }}">
                                        <label for="capping_internal" class="required">Capping Interval</label>
                                        <select  id="capping_internal" name="capping_interval"
                                                class="browser-default custom-select product-list">
                                            <option value="">Select Capping Interval</option>
                                            @foreach (config('constants.capping_interval') as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ isset($campaign) && $campaign->capping_interval == $key ? 'selected' : '' }}>{{ strtoupper($value) }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-3 mb-2 capped-check {{ isset($campaign) && $campaign->claim_reward_type == "capped" ? "" : "d-none" }}">
                                        <label for="number_of_reffarals" class="required">No Of Referral To Be Claimed</label>
                                        <input
                                               value="{{ isset($campaign) ? $campaign->number_of_referrals : old('number_of_referrals') }}"
                                               id="number_of_reffarals"
                                               type="number" class="form-control"
                                               placeholder="Enter The Number" name="number_of_referrals">
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-3 mb-2">
                                        <label for="claim_validity_days" >Claim Validity(Days)</label>
                                        <input
                                            value="{{ isset($campaign) ? $campaign->claim_validity_days : old('claim_validity_days') }}"
                                            id="claim_validity_days"
                                            type="number" class="form-control"
                                            placeholder="Enter Claim Validity Days" name="claim_validity_days">
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-3 mb-2" id="exclude_base_groups_id">
                                        <label for="redirect_url">Exclude User Group</label>
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
                                    <div class="form-group col-md-3 mb-2">
                                        <label for="is_auto_claim">Claim Type: </label>
                                        <div class="form-group {{ $errors->has('is_auto_claim') ? ' error' : '' }}">
                                            <input type="radio" name="is_auto_claim" class="is_auto_claim radio" value=1 id="input-radio-17"
                                                {{ (isset($campaign->is_auto_claim) && $campaign->is_auto_claim == 1) ? 'checked' : '' }}>
                                            <label for="input-radio-17" class="mr-3">Automatic</label>
                                            <input type="radio" name="is_auto_claim" class="is_auto_claim" value=0 id="input-radio-18"
                                                {{ !isset($campaign) || (isset($campaign) && $campaign->is_auto_claim == 0) ? 'checked' : '' }}>
                                            <label for="input-radio-18" class="mr-3">Manual</label>

                                            @if ($errors->has('is_auto_claim'))
                                                <div class="help-block">  {{ $errors->first('is_auto_claim') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dashboard_card_btn_text" class="required">Home Button Text En</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               value="{{ isset($campaign) ? $campaign->dashboard_card_btn_text : old('dashboard_card_btn_text') }}"
                                               id="dashboard_card_btn_text"
                                               type="text" class="form-control"
                                               placeholder="Enter title in English" name="dashboard_card_btn_text">
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dashboard_card_btn_text_bn" class="required">Home Button Text Bn</label>
                                        <input required maxlength="200"
                                               data-validation-required-message="Title is required"
                                               value="{{ isset($campaign) ? $campaign->dashboard_card_btn_text_bn : old('dashboard_card_btn_text_bn') }}"
                                               id="dashboard_card_btn_text_bn"
                                               type="text" class="form-control"
                                               placeholder="Enter title in Bangla" name="dashboard_card_btn_text_bn">
                                        <div class="help-block"></div><br>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title_en" class="required">
                                                How it works description of EN
                                            </label>
                                            <textarea id="terms-conditions" name="description_en" required>
                                                @if(isset($campaign->description_en))
                                                    {{ $campaign->description_en }}
                                                @endif
                                            </textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="title_en" class="required">How it works description of BN</label>
                                            <textarea id="terms-conditions" name="description_bn" required>
                                                @if(isset($campaign->description_bn))
                                                    {{ $campaign->description_bn }}
                                                @endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input">Status: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input type="radio" name="status" value="1" id="input-radio-15"
                                                {{ (isset($campaign->status) && $campaign->status == 1) ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input type="radio" name="status" value="0" id="input-radio-16"
                                                {{ (isset($campaign->status) && $campaign->status == 0) ? 'checked' : '' }}>
                                            <label for="input-radio-16" class="mr-3">Inactive</label>
                                            @if ($errors->has('status'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div id="image-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_url">Upload Icon</label>
                                            <input type="file"
                                                   id="image_url"
                                                   name="icon"
                                                   class="dropify_image"
                                                   data-height="80"
                                                   data-default-file="{{ isset($campaign->icon) ? url('/' .$campaign->icon) : ''}}"
                                                       data-allowed-file-extensions="png jpg gif"/>
                                            <div class="help-block"></div>
                                            <small
                                                class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small id="massage"></small>
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
    <style>
        .error{
            color: red;
        }
    </style>
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
{{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#refer_form').validate();
            var date = new Date();
            date.setDate(date.getDate());
            $('#start_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
            });

            $('#end_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false, //Important! See issue #1075
                showClose: true,

            });

           $('.product_code').selectize({
                create: true,
            });

            // var $select = $('.product_code').selectize({ ... });
            // var selectize = $select[0].selectize;
            // var selected_objects = $.map(selectize, function(value) {
            //     return selectize.options[value];
            // });

            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });

            $('.claim_reward_type').click(function () {
                console.log($(this).val());
                if ($(this).val() !== "capped"){
                    $('.capped-check').addClass('d-none');
                    $('#capping_internal').removeAttr('required', 'required');
                    $('#number_of_reffarals').removeAttr('required', 'required');
                    $('#claim_validity_days').removeAttr('required', 'required');
                } else {
                    $('.capped-check').removeClass('d-none');
                    $('#capping_internal').prop('required', 'required');
                    $('#number_of_reffarals').prop('required', 'required');
                    $('#claim_validity_days').prop('required', 'required');
                }
            });

            $('#capping_internal').click(function () {

                $('#capping_internal').prop('required', 'required');
            });

            $('#number_of_reffarals').keyup(function () {

                $('#number_of_reffarals').prop('required', 'required');
            });

            // $('#claim_validity_days').keyup(function () {
            //
            //     $('#claim_validity_days').prop('required', 'required');
            // });

            $(function () {
                console.log("test");
                $("textarea#terms-conditions").summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen']]
                    ],
                    height:300
                })
            });
            // $('.js_editor_box').each(function (k, v) {
            //     $(this).summernote({
            //         toolbar: [
            //             ['style', ['bold', 'italic', 'underline', 'clear']],
            //             ['font', ['strikethrough', 'superscript', 'subscript']],
            //             ['fontsize', ['fontsize']],
            //             ['color', ['color']],
            //             // ['table', ['table']],
            //             ['para', ['ul', 'ol', 'paragraph']],
            //             ['view', ['fullscreen', 'codeview']]
            //         ],
            //         height: 110
            //     });
            // });
        });
    </script>

@endpush
