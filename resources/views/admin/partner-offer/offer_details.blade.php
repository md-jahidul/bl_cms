@extends('layouts.admin')
@php $partner = ucfirst($partner)  @endphp
@section('title', "$partner Offer ")
@section('card_name', "$partner Offer Details")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("partner-offer", [$partnerOfferDetail->partner_id, strtolower($partner)]) }}"> {{ $partner }} List</a></li>
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active"> {{ $partner }} Offer Details</li>
@endsection
@section('action')
    <a href="{{ route("partner-offer", [$partnerOfferDetail->partner_id, strtolower($partner)]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Product Details Page</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('offer.details-update', [strtolower($partner)] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <input type="hidden" name="partner_id" value="{{ $partnerOfferDetail->partner_id }}">
                                <input type="hidden" name="offer_details_id" value="{{ $partnerOfferDetail->partner_offer_details->id }}">
                                <div class="form-group col-md-6 {{ $errors->has('offer_en') ? ' error' : '' }}">
                                    <label for="offer_en" class="">Offer Name</label>
                                    <input type="text" class="form-control" placeholder="Enter offer name english" readonly
                                           value="{{ $partnerOfferDetail->offer_en }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_en'))
                                        <div class="help-block">{{ $errors->first('offer_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_en') ? ' error' : '' }}">
                                    <label for="offer_en" class="">Offer Validity</label>
                                    <input type="text" class="form-control" placeholder="Enter offer name english" readonly
                                           value="{{ $partnerOfferDetail->validity_en }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_en'))
                                        <div class="help-block">{{ $errors->first('offer_en') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('eligible_customer_en') ? ' error' : '' }}">
                                    <label for="eligible_customer_en" class="required">Eligible customer (English)</label>
                                    <input type="text" name="eligible_customer_en"  class="form-control" placeholder="Enter short details in english"
                                           value="{{ $partnerOfferDetail->partner_offer_details->eligible_customer_en }}"
                                           required data-validation-required-message="Enter short details in english" />
                                    <div class="help-block"></div>
                                    @if ($errors->has('eligible_customer_en'))
                                        <div class="help-block">{{ $errors->first('eligible_customer_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('eligible_customer_bn') ? ' error' : '' }}">
                                    <label for="eligible_customer_bn" class="required">Eligible customer (Bangla)</label>
                                    <input type="text" name="eligible_customer_bn"  class="form-control" placeholder="Enter short details in english"
                                           value="{{ $partnerOfferDetail->partner_offer_details->eligible_customer_bn }}"
                                           required data-validation-required-message="Enter short details in english" />
                                    <div class="help-block"></div>
                                    @if ($errors->has('eligible_customer_bn'))
                                        <div class="help-block">{{ $errors->first('eligible_customer_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('avail_en') ? ' error' : '' }}">
                                    <label for="avail_en" class="required">How to Avail (English)</label>
                                    <input type="text" name="avail_en"  class="form-control" placeholder="Enter short details in english"
                                           value="{{ $partnerOfferDetail->partner_offer_details->avail_en }}"
                                           required data-validation-required-message="Enter short details in english"/>
                                    <div class="help-block"></div>
                                    @if ($errors->has('avail_en'))
                                        <div class="help-block">{{ $errors->first('avail_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('avail_bn') ? ' error' : '' }}">
                                    <label for="avail_bn" class="required">How to Avail (Bangla)</label>
                                    <input type="text" name="avail_bn"  class="form-control" placeholder="Enter short details in bangla"
                                           value="{{ $partnerOfferDetail->partner_offer_details->avail_bn }}"
                                           required data-validation-required-message="Enter short details in bangla" />
                                    <div class="help-block"></div>
                                    @if ($errors->has('avail_bn'))
                                        <div class="help-block">{{ $errors->first('avail_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
                                    <label for="details_en" class="required">Details (English)</label>
                                    <textarea type="text" name="details_en"  class="form-control" placeholder="Enter short details in english" rows="5"
                                              required data-validation-required-message="Enter short details in english">{{ $partnerOfferDetail->partner_offer_details->details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_en'))
                                        <div class="help-block">{{ $errors->first('details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                    <label for="details_bn" class="required">Details (Bangla)</label>
                                    <textarea type="text" name="details_bn"  class="form-control" placeholder="Enter short details in bangla" rows="5"
                                              required data-validation-required-message="Enter short details in bangla">{{ $partnerOfferDetail->partner_offer_details->details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_bn'))
                                        <div class="help-block">{{ $errors->first('details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
                                    <label for="offer_details_en" class="required">Offer Details (English)</label>
                                    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
                                           required data-validation-required-message="Enter offer details in english" id="details">{{ $partnerOfferDetail->partner_offer_details->offer_details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_details_en'))
                                        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
                                    <label for="offer_details_bn" class="required">Offer Details (Bangla)</label>
                                    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
                                              required data-validation-required-message="Enter offer details in english" id="details">{{ $partnerOfferDetail->partner_offer_details->offer_details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_details_bn'))
                                        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
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


<style>
    form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
        border-color: unset;
        -webkit-box-shadow: unset;
        -moz-box-shadow: unset;
        box-shadow: unset;
        border-width: 0;
        color : unset;
    }
</style>

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#details").summernote({
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
        })
    </script>
@endpush






