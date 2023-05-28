@extends('layouts.admin')
@section('title', 'Cash Back')
@section('card_name',"Cash Back Campaign" )
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('cash-back-campaign.index') }}">Campaign List</a>
    </li>
    <li class="breadcrumb-item active">Create Campaign</li>
@endsection
@section('action')
    <a href="{{ route('cash-back-campaign.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i>
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
                        <form id="feed-form" novalidate class="form row"
                              action="{{ (isset($campaign)) ? route('cash-back-campaign.update', $campaign->id) : route('cash-back-campaign.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @if(isset($campaign))
                                @method('put')
                            @else
                                @method('post')
                            @endif
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Campaign Name</label>
                                        <input required maxlength="250"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 250 Characters"
                                               value="{{ isset($campaign) ? $campaign->title : old('title') }}" id="title"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Title" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user_type">Campaign For</label>
                                        <div>
                                            <input type="radio" name="user_type" value="all" id="all"
                                            @if( isset($campaign) && $campaign->user_type == "all") {{ 'checked' }} @endif>
                                            <label for="all" class="mr-3 cursor-pointer">All</label>
                                            <input type="radio" name="user_type" value="prepaid"
                                                   id="prepaid" @if(isset($campaign) && $campaign->user_type == "prepaid") {{ 'checked' }} @endif>
                                            <label for="prepaid" class="mr-3 cursor-pointer">Prepaid</label>
                                            <input type="radio" name="user_type" value="postpaid"
                                                   id="postpaid" @if(isset($campaign) && $campaign->user_type == "postpaid") {{ 'checked' }} @endif>
                                            <label for="postpaid" class="mr-3 cursor-pointer">Postpaid</label>
                                        </div>
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
                                </div>

                                <!-- Product Info Row Plus -->
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0 pl-0"><h5><strong>Product Selection Section</strong></h5></div>
                                    <div class="form-actions col-md-12 mt-0"></div>
                                </div>

                                <!-- Product Selection Start -->
                                <div class="row report-repeater" id="productSection" data-repeater-list="product-group">
                                    @if(isset($campaign))
                                        @foreach($campaign->cashBackProducts as $product)
                                            @include('admin.mybl-campaign.cash-back.partials.product-element', ['product' => $product])
                                        @endforeach
                                    @else
                                        @include('admin.mybl-campaign.cash-back.partials.product-element')
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <button data-repeater-create id="repeater-button" type="button"
                                                class="btn-sm btn-success cursor-pointer float-right">
                                            <i class="la la-plus"></i>
                                        </button>
                                    </div>
                                    <br><br><br>
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
            let productStart = $('.date_time');
            let productEnd = $('.product_end_date');
            function dateTime(element){
                var date = new Date();
                date.setDate(date.getDate());
                element.datetimepicker({
                    format : 'YYYY-MM-DD HH:00:00',
                    showClose: true,
                });
            }
            $('#repeater-button').click(function (){
                $(".product-list").select2()
                var date = new Date();
                date.setDate(date.getDate());
                $('.date_time').datetimepicker({
                    format : 'YYYY-MM-DD HH:00:00',
                    showClose: true,
                });
                $('.product_end_date').datetimepicker({
                    format : 'YYYY-MM-DD HH:00:00',
                    showClose: true,
                });
            })
            dateTime(campaignStart)
            dateTime(campaignEnd)
            dateTime(productStart)
            dateTime(productEnd)
        });
    </script>

@endpush