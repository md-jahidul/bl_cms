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
                    <h5 class="menu-title"><strong>{{ ucfirst($type) }} Offer Create</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('product.store', strtolower($type)) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Offer Name English</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter offer validity english"
                                           required data-validation-required-message="Enter offer name english"
                                           value="{{ old("name_en") ? old("name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Offer Name Bangla</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter offer name bangla"
                                           required data-validation-required-message="Enter offer name bangla"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ussd_en') ? ' error' : '' }}">
                                    <label for="ussd_en">USSD Code English</label>
                                    <input type="text" name="ussd_en"  class="form-control" placeholder="Enter offer ussd english"
                                           value="{{ old("ussd_en") ? old("ussd_en") : '' }}">
                                    <div class="help-block"></div>
{{--                                    @if ($errors->has('ussd_en'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('ussd_en') }}</div>--}}
{{--                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ussd_bn') ? ' error' : '' }}">
                                    <label for="ussd_bn">USSD Code Bangla</label>
                                    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd"
                                           value="{{ old("ussd_bn") ? old("ussd_bn") : '' }}">
                                    <div class="help-block"></div>
{{--                                    @if ($errors->has('ussd_bn'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('ussd_bn') }}</div>--}}
{{--                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('price_tk') ? ' error' : '' }}">
                                    <label for="price_tk">Offer Price</label>
                                    <input type="text" name="price_tk"  class="form-control" placeholder="Enter offer price"
                                           value="{{ old("price_tk") ? old("price_tk") : '' }}">
                                    <div class="help-block"></div>
                                    {{--                                    @if ($errors->has('price_tk'))--}}
                                    {{--                                        <div class="help-block">{{ $errors->first('price_tk') }}</div>--}}
                                    {{--                                    @endif--}}
                                </div>

                                @if(strtolower($type) == 'prepaid')
                                    <div class="form-group col-md-6">
                                        <label for="sms_volume">SMS Volume</label>.
                                        <input type="number" name="sms_volume"  class="form-control" placeholder="Enter offer sms volume"
                                               value="{{ old("sms_volume") ? old("sms_volume") : '' }}" >
                                        <div class="help-block"></div>
{{--                                        @if ($errors->has('sms_volume'))--}}
{{--                                            <div class="help-block">  {{ $errors->first('sms_volume') }}</div>--}}
{{--                                        @endif--}}
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('min_volume') ? ' error' : '' }}">
                                        <label for="min_volume">Minute Volume</label>
                                        <input type="number" name="min_volume"  class="form-control" placeholder="Enter minute volume"
                                               value="{{ old("min_volume") ? old("min_volume") : '' }}">
                                        <div class="help-block"></div>
{{--                                        @if ($errors->has('min_volume'))--}}
{{--                                            <div class="help-block">  {{ $errors->first('min_volume') }}</div>--}}
{{--                                        @endif--}}
                                    </div>
                                @endif

                                <div class="form-group col-md-6">
                                    <label for="internet_volume_mb">Internet Volume</label>
                                    <input type="number" name="internet_volume_mb"  class="form-control" placeholder="Enter internet volume mb"
                                           value="{{ old("internet_volume_mb") ? old("internet_volume_mb") : '' }}">
                                    <div class="help-block"></div>
{{--                                    @if ($errors->has('internet_volume_mb'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>--}}
{{--                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="bonus">Bonus</label>
                                    <input type="text" name="bonus"  class="form-control" placeholder="Enter bonus"
                                           value="{{ old("bonus") ? old("bonus") : '' }}">
                                    <div class="help-block"></div>
{{--                                    @if ($errors->has('bonus'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('bonus') }}</div>--}}
{{--                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
                                    <label for="validity_days">Validity Days</label>
                                    <input type="text" name="validity_days"  class="form-control" placeholder="Enter validity days"
                                           value="{{ old("validity_days") ? old("validity_days") : '' }}">
                                    <div class="help-block"></div>
{{--                                    @if ($errors->has('validity_days'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('validity_days') }}</div>--}}
{{--                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('point') ? ' error' : '' }}">
                                    <label for="point">Point</label>
                                    <input type="number" name="point"  class="form-control" placeholder="Enter point"
                                           value="{{ old("point") ? old("point") : '' }}">
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('point'))--}}
{{--                                        <div class="help-block">{{ $errors->first('point') }}</div>--}}
{{--                                    @endif--}}
                                </div>



                                <div class="form-group col-md-6 {{ $errors->has('tag_category_id') ? ' error' : '' }}">
                                    <label for="tag_category_id">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option>---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
{{--                                    @if ($errors->has('tag_category_id'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('tag_category_id') }}</div>--}}
{{--                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer Type</label>
{{--                                    <input type="text" name="offer_category_id"  class="form-control" placeholder="Enter point" required--}}
{{--                                           value="{{ old("point") ? old("point") : '' }}">--}}

                                    <select class="form-control required" name="offer_category_id" required data-validation-required-message="Please select offer">
                                        <option value="">---Select Offer Type---</option>
                                        @foreach($offers as $offer)
                                            <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
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
                                        <label for="title" class="mr-1">Recharge</label>

                                        <input type="radio" name="is_recharge" value="1" id="yes" checked>
                                        <label for="yes" class="mr-1">Yes</label>

                                        <input type="radio" name="is_recharge" value="0" id="no">
                                        <label for="no">No</label>
                                    </div>
                                </div>


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







