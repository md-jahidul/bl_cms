@extends('layouts.admin')
@section('title', "$type Offer Create")
@section('card_name', "$type Offer Create")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
{{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
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
                    <h5 class="menu-title"><strong>{{ $type }} offer create</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('product.store', $type) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Offer Name</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter offer validity english"
                                           value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter offer name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('price_tk') ? ' error' : '' }}">
                                    <label for="price_tk" class="required">Offer Price</label>
                                    <input type="text" name="price_tk"  class="form-control" placeholder="Enter offer price"
                                           value="{{ old("price_tk") ? old("price_tk") : '' }}" required data-validation-required-message="Enter offer price">
                                    <div class="help-block"></div>
                                    @if ($errors->has('price_tk'))
                                        <div class="help-block">{{ $errors->first('price_tk') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ussd') ? ' error' : '' }}">
                                    <label for="ussd" class="required">USSD Code</label>
                                    <input type="text" name="ussd"  class="form-control" placeholder="Enter offer ussd english"
                                           value="{{ old("ussd") ? old("ussd") : '' }}" required data-validation-required-message="Enter offer ussd">
                                    <div class="help-block"></div>
                                    @if ($errors->has('ussd'))
                                        <div class="help-block">  {{ $errors->first('ussd') }}</div>
                                    @endif
                                </div>

                                @if(strtolower($type) == 'prepaid')
                                    <div class="form-group col-md-6 {{ $errors->has('sms_volume') ? ' error' : '' }}">
                                        <label for="sms_volume" class="required">SMS Volume</label>.
                                        <input type="text" name="sms_volume"  class="form-control" placeholder="Enter offer sms_volume bangla"
                                               value="{{ old("sms_volume") ? old("sms_volume") : '' }}" required data-validation-required-message="Enter offer sms volume">
                                        <div class="help-block"></div>
                                        @if ($errors->has('sms_volume'))
                                            <div class="help-block">  {{ $errors->first('sms_volume') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('min_volume') ? ' error' : '' }}">
                                        <label for="min_volume" class="required">Minute Volume</label>
                                        <input type="text" name="min_volume"  class="form-control" placeholder="Enter minute volume"
                                               value="{{ old("min_volume") ? old("min_volume") : '' }}" required data-validation-required-message="Enter minute volume">
                                        <div class="help-block"></div>
                                        @if ($errors->has('min_volume'))
                                            <div class="help-block">  {{ $errors->first('min_volume') }}</div>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
                                    <label for="internet_volume_mb" class="required">Internet Volume</label>
                                    <input type="text" name="internet_volume_mb"  class="form-control" placeholder="Enter get send SMS text english"
                                           value="{{ old("internet_volume_mb") ? old("internet_volume_mb") : '' }}" required data-validation-required-message="Enter internet volume mb">
                                    <div class="help-block"></div>
                                    @if ($errors->has('internet_volume_mb'))
                                        <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bonus') ? ' error' : '' }}">
                                    <label for="bonus" class="required">Bonus</label>
                                    <input type="text" name="bonus"  class="form-control" placeholder="Enter get send SMS text english"
                                           value="{{ old("bonus") ? old("bonus") : '' }}" required data-validation-required-message="Enter bonus">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bonus'))
                                        <div class="help-block">  {{ $errors->first('bonus') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('get_offer_msg_bn') ? ' error' : '' }}">--}}
{{--                                    <label for="get_offer_msg_bn" class="required">Point</label>--}}
{{--                                    <input type="text" name="get_offer_msg_bn"  class="form-control" placeholder="Enter get send SMS text bangla"--}}
{{--                                           value="{{ old("get_offer_msg_bn") ? old("get_offer_msg_bn") : '' }}" required data-validation-required-message="Enter get send SMS text bangla">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('get_offer_msg_bn'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('get_offer_msg_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
                                    <label for="validity_days" class="required">Validity Days</label>
                                    <input type="text" name="validity_days"  class="form-control" placeholder="Enter alt text"
                                           value="{{ old("validity_days") ? old("validity_days") : '' }}" required data-validation-required-message="Enter validity_days">
                                    <div class="help-block"></div>
                                    @if ($errors->has('validity_days'))
                                        <div class="help-block">  {{ $errors->first('validity_days') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('point') ? ' error' : '' }}">
                                    <label for="point" class="required">Point</label>
                                    <input type="text" name="point"  class="form-control" placeholder="Enter point"
                                           value="{{ old("point") ? old("point") : '' }}" required data-validation-required-message="Enter point">
                                    <div class="help-block"></div>
                                    @if ($errors->has('point'))
                                        <div class="help-block">{{ $errors->first('point') }}</div>
                                    @endif
                                </div>



                                <div class="form-group col-md-6 {{ $errors->has('tag_category_id') ? ' error' : '' }}">
                                    <label for="tag_category_id" class="required">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option>---Select Tag---</option>
                                        @foreach($offers as $offer)
                                            <option value="">Option 1</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_category_id'))
                                        <div class="help-block">  {{ $errors->first('tag_category_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer</label>
                                    <select class="form-control">
                                        <option>---Select Offer---</option>
                                        @foreach($offers as $offer)
                                            <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">  {{ $errors->first('offer_category_id') }}</div>
                                    @endif
                                </div>



                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group pt-1">
                                        <label for="show_in_home" class="mr-1">Show In Home:</label>
                                        <input type="checkbox" name="show_in_home" value="1" id="show_in_home">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Recharge</label>

                                        <input type="radio" name="is_recharge" value="1" id="yes" checked>
                                        <label for="yes" class="mr-1">Yes</label>

                                        <input type="radio" name="is_recharge" value="0" id="no">
                                        <label for="no">No</label>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
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
@endpush
@push('page-js')

@endpush







