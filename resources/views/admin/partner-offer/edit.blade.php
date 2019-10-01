@extends('layouts.admin')
@section('title', 'Partner Offer Edit')
@section('card_name', 'Partner Offer Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong><a href="{{ url('partners') }}"> Partner List</a></strong></li>
    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$partnerId, $partnerName]) }}"> Partner Offer List</a></li>
    <li class="breadcrumb-item active"> Partner Offer Edit</li>
@endsection
@section('action')
    <a href="{{ route('partner-offer', [$partnerId, $partnerName]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title">{{ ucwords($partnerName) }} offer edit</h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('partner_offer_update', [$partnerId, $partnerName, $partnerOffer->id]) }}" method="POST" novalidate>
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('validity_en') ? ' error' : '' }}">
                                    <label for="validity_en" class="required">Offer Validity (English)</label>
                                    <input type="text" name="validity_en"  class="form-control" placeholder="Enter offer validity english"
                                           value="{{ $partnerOffer->validity_en }}" required data-validation-required-message="Enter offer validity english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('validity_en'))
                                        <div class="help-block">{{ $errors->first('validity_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('validity_bn') ? ' error' : '' }}">
                                    <label for="validity_bn" class="required">Offer Validity (Bangla)</label>
                                    <input type="text" name="validity_bn"  class="form-control" placeholder="Enter offer validity bangla"
                                           value="{{ $partnerOffer->validity_bn }}" required data-validation-required-message="Enter offer validity bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('validity_bn'))
                                        <div class="help-block">{{ $errors->first('validity_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_en') ? ' error' : '' }}">
                                    <label for="offer_en" class="required">Offer Percentage (English)</label>
                                    <input type="text" name="offer_en"  class="form-control" placeholder="Enter offer percentage english"
                                           value="{{ $partnerOffer->offer_en }}" required data-validation-required-message="Enter offer percentage english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_en'))
                                        <div class="help-block">  {{ $errors->first('offer_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_bn') ? ' error' : '' }}">
                                    <label for="offer_bn" class="required">Offer Percentage (Bangla)</label>
                                    <input type="text" name="offer_bn"  class="form-control" placeholder="Enter offer percentage bangla"
                                           value="{{ $partnerOffer->offer_bn }}" required data-validation-required-message="Enter offer percentage bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_bn'))
                                        <div class="help-block">  {{ $errors->first('offer_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('get_offer_msg_en') ? ' error' : '' }}">
                                    <label for="get_offer_msg_en" class="required">Get Send SMS (English)</label>
                                    <input type="text" name="get_offer_msg_en"  class="form-control" placeholder="Enter get send SMS text english"
                                           value="{{ $partnerOffer->get_offer_msg_en }}" required data-validation-required-message="Enter get send SMS text english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('get_offer_msg_en'))
                                        <div class="help-block">  {{ $errors->first('get_offer_msg_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('get_offer_msg_bn') ? ' error' : '' }}">
                                    <label for="get_offer_msg_bn" class="required">Get Send SMS (Bangla)</label>
                                    <input type="text" name="get_offer_msg_bn"  class="form-control" placeholder="Enter get send SMS text bangla"
                                           value="{{ $partnerOffer->get_offer_msg_bn }}" required data-validation-required-message="Enter get send SMS text bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('get_offer_msg_bn'))
                                        <div class="help-block">  {{ $errors->first('get_offer_msg_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('btn_text_en') ? ' error' : '' }}">
                                    <label for="btn_text_en" class="required">Button Label (English)</label>
                                    <input type="text" name="btn_text_en"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $partnerOffer->btn_text_en }}" required data-validation-required-message="Enter button label english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('btn_text_en'))
                                        <div class="help-block">  {{ $errors->first('btn_text_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('btn_text_bn') ? ' error' : '' }}">
                                    <label for="btn_text_bn" class="required">Button Label (Bangla)</label>
                                    <input type="text" name="btn_text_bn"  class="form-control" placeholder="Enter button label bangla"
                                           value="{{ $partnerOffer->btn_text_bn }}" required data-validation-required-message="Enter alt text">
                                    <div class="help-block"></div>
                                    @if ($errors->has('btn_text_bn'))
                                        <div class="help-block">  {{ $errors->first('btn_text_bn') }}</div>
                                    @endif
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('btn_text_bn') ? ' error' : '' }}">
                                        <label for="title" class="mr-1">Show In Home:</label>
                                        <input type="checkbox" name="show_in_home" value="1" id="input-radio-16" {{ ($partnerOffer->show_in_home == 1) ? 'checked' : '' }}>
                                        @if ($errors->has('btn_text_bn'))
                                            <div class="help-block">  {{ $errors->first('btn_text_bn') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>
                                        <input type="radio" name="is_active" value="1" id="input-radio-15" {{ ($partnerOffer->is_active == 1) ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-1">Active</label>
                                        <input type="radio" name="is_active" value="0" id="input-radio-16" {{ ($partnerOffer->is_active == 0) ? 'checked' : '' }}>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Update
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
@endpush
@push('page-js')

@endpush







