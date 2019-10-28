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
                        <form role="form" action="{{ route('product.update', [strtolower($type), $product->id] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en">Offer Name</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter offer name english"
                                           value="{{ $product->name_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Offer Name Bangla</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter offer name bangla"
                                           value="{{ $product->name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd">USSD Code English</label>
                                    <input type="text" name="ussd"  class="form-control" placeholder="Enter offer ussd english" maxlength="25"
                                           value="{{ $product->ussd_en }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ussd_bn') ? ' error' : '' }}">
                                    <label for="ussd_bn">USSD Code Bangla</label>
                                    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd bangla" maxlength="25"
                                           value="{{ $product->ussd_bn }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price_tk">Offer Price</label>
                                    <input type="number" name="price_tk"  class="form-control" placeholder="Enter offer price" maxlength="8"
                                           value="{{ $product->price_tk }}">
                                </div>

                                @if(strtolower($type) == 'prepaid')
                                    <div class="form-group col-md-6 {{ $errors->has('sms_volume') ? ' error' : '' }}">
                                        <label for="sms_volume" class="required">SMS Volume</label>.
                                        <input type="number" name="sms_volume"  class="form-control" placeholder="Enter offer sms volume"
                                               value="{{ $product->sms_volume }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="min_volume" class="required">Minute Volume</label>
                                        <input type="number" name="min_v olume"  class="form-control" placeholder="Enter minute volume"
                                               value="{{ $product->min_volume }}">
                                    </div>
                                @endif

                                <div class="form-group col-md-6">
                                    <label for="internet_volume_mb" class="required">Internet Volume</label>
                                    <input type="number" name="internet_volume_mb"  class="form-control" placeholder="Enter internet volume mb"
                                           value="{{ $product->internet_volume_mb }}">
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="bonus">Bonus</label>
                                    <input type="text" name="bonus"  class="form-control" placeholder="Enter bonus"
                                           value="{{ $product->name }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="validity_days" class="required">Validity Days</label>
                                    <input type="text" name="validity_days"  class="form-control" placeholder="Enter validity days"
                                           value="{{ $product->validity_days }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('point') ? ' error' : '' }}">
                                    <label for="point" class="required">Point</label>
                                    <input type="number" name="point"  class="form-control" placeholder="Enter point"
                                           value="{{ $product->point }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id" class="required">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option value="">---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ ($tag->id == $product->tag_category_id ) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer</label>
                                    <select class="form-control" name="offer_category_id">
                                        <option value="">---Select Offer---</option>
                                        @foreach($offers as $offer)
                                            <option value="{{ $offer->id }}" {{ ($offer->id == $product->offer_category_id ) ? 'selected' : '' }}>
                                                {{ $offer->name }}</option>
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
                                        <input type="checkbox" name="show_in_home" value="1" id="show_in_home" {{ ($product->show_in_home == 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Recharge</label>
                                        <input type="radio" name="is_recharge" value="1" id="yes" {{ ($product->status == 1) ? 'checked' : '' }}>
                                        <label for="yes" class="mr-1">Yes</label>
                                        <input type="radio" name="is_recharge" value="0" id="no" {{ ($product->is_recharge == 0) ? 'checked' : '' }}>
                                        <label for="no">No</label>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="active" {{ ($product->status == 1) ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ ($product->status == 0) ? 'checked' : '' }}>
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







