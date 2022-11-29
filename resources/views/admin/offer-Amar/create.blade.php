@extends('layouts.admin')
@section('title', 'Amar Offer')
@section('card_name', "Amar Offer")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Create Amar Offer
    </li>
@endsection
@section('action')
    <a href="{{ route('amarOffer.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i>
        Cancel
    </a>
@endsection
@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form novalidate class="form" action="{{route('amarOffer.store')}}" method="POST">
                        @csrf
                        @method('post')

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Create Amar Offer.</h4>
                            <div class="row">
                                {{-- Select User Group --}}
                                <div class="form-group col-md-12 mb-0 pl-0 section-row"><h5><strong>Select User Group</strong></h5></div>
                                <div class="form-actions col-md-12 mt-0"></div>
                                <div class="form-group col-md-12 {{ $errors->has('type') ? ' error' : '' }}">
                                    <label for="title" class="required">Choose User Type</label><hr class="mt-0">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12">
                                            <input  type="radio" name="user_group_type" value="all" class="campaign_user_type" id="all"
                                                {{ (isset($campaign) && $campaign->campaign_user_type == "all") ? 'checked' : '' }}>
                                            <label for="all">All</label>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <input type="radio" name="user_group_type" value="prepaid" class="campaign_user_type" id="prepaid"
                                                {{ (isset($campaign) && $campaign->campaign_user_type == "prepaid") ? 'checked' : '' }}>
                                            <label for="prepaid">Prepaid</label>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <input type="radio" name="user_group_type" value="postpaid" class="campaign_user_type" id="postpaid"
                                                {{ isset($campaign) && $campaign->campaign_user_type == "postpaid" ? 'checked' : '' }}>
                                            <label for="postpaid">Postpaid</label>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <input type="radio" name="user_group_type" value="segment_wise" class="campaign_user_type" id="segment_wise"
                                                {{ isset($campaign) && $campaign->campaign_user_type == "segment_wise" ? 'checked' : '' }} {{ isset($campaign) ? '' : 'checked' }}>
                                            <label for="segment_wise">Segment Wise (Base Msisdn)</label>
                                        </div>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-2 {{ isset($campaign) && $campaign->campaign_user_type != "segment_wise" ? 'd-none' : '' }}" id="base_msisdn">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="required">Title:</label>
                                        <input
                                            required
                                            data-validation-required-message="Title is required"
                                            maxlength="200"
                                            data-validation-maxlength-message = "Title name can not be more then 200 characters"
                                            type="text" max="200" value="@if(old('name')){{old('name')}}@endif" id="title" class="form-control @error('name') is-invalid @enderror" placeholder="Enter title...." name="name">
                                        <div class="help-block">
                                            <small id="minutes" class="form-text text-info">Title name can not be more then 200 characters.</small>
                                        </div>

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_code" class="required">Product Code:</label>
                                        <input
                                            required
                                            data-validation-required-message="Product Code is required"
                                            maxlength="200"
                                            type="text" value="@if(old('product_code')){{old('product_code')}}@endif" id="product_code" class="form-control @error('product_code') is-invalid @enderror" placeholder="Product code.." name="product_code">
                                        @error('product_code')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="internet" class="required">Internet:</label>
                                        <input
                                            required
                                            maxlength="50000"
                                            data-validation-maxlength-message = "Internet Volume can not be more then 50000 digits"
                                            data-validation-required-message="Internet Volume is required"
                                            type="number" min="0" value="@if(old('internet')){{old('internet')}}@endif" id="internet" class="form-control @error('internet') is-invalid @enderror" placeholder="Enter volume...." name="internet">
                                        <div class="help-block">
                                            <small id="internet" class="form-text text-info">Enter volume in MB.</small>
                                        </div>
                                        @error('internet')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="minutes" class="required">Minutes:</label>
                                        <input
                                            required
                                            maxlength="50000"
                                            data-validation-maxlength-message = "Minutes Volume can not be more then 50000 digits"
                                            data-validation-required-message="Minutes Volume is required"
                                            type="number" min="0" value="@if(old('minutes')){{old('minutes')}}@endif" id="minutes" class="form-control @error('minutes') is-invalid @enderror" placeholder="Enter volume...." name="minutes">
                                        <div class="help-block">
                                            <small id="minutes" class="form-text text-info">Enter volume in minutes.</small>
                                        </div>
                                        @error('minutes')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sms" class="required">SMS:</label>
                                        <input
                                            required
                                            maxlength="50000"
                                            data-validation-maxlength-message = "SMS Volume can not be more then 50000 digits"
                                            data-validation-required-message="SMS Volume is required"
                                            type="number" min="0" value="@if(old('sms')){{old('sms')}}@endif" id="sms" class="form-control @error('sms') is-invalid @enderror" placeholder="Enter volume...." name="sms">
                                        <div class="help-block">
                                            <small id="sms" class="form-text text-info">Enter volume in amount of sms.</small>
                                        </div>
                                        @error('sms')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price" class="required">Price:</label>
                                        <input
                                            required
                                            maxlength="50"
                                            data-validation-maxlength-message = "Price can not be more then 50 digits"
                                            data-validation-required-message="Price is required"
                                            type="number" min="0" value="@if(old('price')){{old('price')}}@endif" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price.." name="price">

                                        <div class="help-block">
                                            <small id="price" class="form-text text-info">Enter price in BDT.</small>
                                        </div>
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="validity" class="required">Validity:</label>
                                        <input
                                            required
                                            maxlength="50"
                                            data-validation-required-message="Validity is required"
                                            type="number" min="0" value="@if(old('validity')){{old('validity')}}@endif" id="price" class="form-control @error('validity') is-invalid @enderror" placeholder="Validity.." name="validity">
                                        @error('validity')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="eventInput3">Validity Unit</label>
                                        <select name="validity_unit" class="form-control">
                                            <option value="hours" >Hours</option>
                                            <option value="day">Day</option>
                                            <option value="days">Days</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="0" >Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-0">
                                    <label for="desc_en" class="required">Description</label>
                                    <textarea rows="3" id="desc_en" name="description" class="form-control"
                                              placeholder="Enter Product Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success round px-2">
                                <i class="la la-check-square-o"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('style')
@endpush
@push('page-js')
    <script>
        $(document).ready(function () {
            $('.campaign_user_type').click(function () {
                if ($(this).val() !== "segment_wise"){
                    $('#base_msisdn').addClass('d-none')
                } else {
                    $('#base_msisdn').removeClass('d-none')
                }
            });
        });
    </script>
@endpush
