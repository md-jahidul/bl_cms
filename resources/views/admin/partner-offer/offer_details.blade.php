@extends('layouts.admin')
@php $partner = ucfirst($partner)  @endphp
@section('title', "$partner Offer ")
{{--@section('card_name', "$partner Offer Details")--}}
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('partners') }}"> Partner List</a></li>
    <li class="breadcrumb-item"><a href="{{ route("partner-offer", [$partnerOfferDetail->partner_id, strtolower($partner)]) }}"> {{ $partner }} List</a></li>
    <li class="breadcrumb-item active"> {{ $partner }} Offer Details</li>
@endsection
@section('action')
    <a href="{{ route("partner-offer", [$partnerOfferDetail->partner_id, strtolower($partner)]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        @if ($errors->any())
            @foreach ($errors->all() as $error) @endforeach
        @endif
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>{{ $partner }} Details Page</strong></h4><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('offer.details-update', [strtolower($partner)] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            {{-- {{ dd($partnerOfferDetail) }} --}}
                            <div class="row">
                                <input type="hidden" name="partner_id" value="{{ $partnerOfferDetail->partner_id }}">
                                <input type="hidden" name="offer_details_id" value="{{ $partnerOfferDetail->partner_offer_details->id }}">
                                <div class="form-group col-md-6 {{ $errors->has('offer_en') ? ' error' : '' }}">
                                    <label for="offer_en" class="">Partner Offer</label>
                                    <input type="text" class="form-control" placeholder="Enter offer name english" readonly
                                           value="{{ $partnerOfferDetail->offer_scale .' '. $partnerOfferDetail->offer_value .' '. $partnerOfferDetail->offer_unit }}" required data-validation-required-message="Enter offer name english">
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
                                    <textarea type="text" name="offer_details_en" class="form-control summernote_editor" placeholder="Enter offer details in english"
                                           required data-validation-required-message="Enter offer details in english">{{ $partnerOfferDetail->partner_offer_details->offer_details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_details_en'))
                                        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
                                    <label for="offer_details_bn" class="required">Offer Details (Bangla)</label>
                                    <textarea type="text" name="offer_details_bn" class="form-control summernote_editor" placeholder="Enter offer details in english"
                                              required data-validation-required-message="Enter offer details in english">{{ $partnerOfferDetail->partner_offer_details->offer_details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_details_bn'))
                                        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Page Header (HTML)</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="page_header">{{ isset($partnerOfferDetail->partner_offer_details->page_header) ?--}}
{{--                                                $partnerOfferDetail->partner_offer_details->page_header : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> Title, meta, canonical and other tags--}}
{{--                                    </small>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Page Header Bangla (HTML)</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($partnerOfferDetail->partner_offer_details->page_header_bn) ?--}}
{{--                                                        $partnerOfferDetail->partner_offer_details->page_header_bn : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> Title, meta, canonical and other tags--}}
{{--                                    </small>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                    <label>Schema Markup</label>--}}
{{--                                    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($partnerOfferDetail->partner_offer_details->schema_markup) ?--}}
{{--                                                $partnerOfferDetail->partner_offer_details->schema_markup : null }}</textarea>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>Note: </strong> JSON-LD (Recommended by Google)--}}
{{--                                    </small>--}}
{{--                                </div>--}}


                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    @php $webBannerImg = $partnerOfferDetail->partner_offer_details->banner_image_url @endphp
                                    <label for="mobileImg">Desktop View Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image_url" class="dropify" data-height="90"
                                               data-default-file="{{ isset($webBannerImg) ? config('filesystems.file_base_url') . $webBannerImg : '' }}">
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image_url'))
                                        <div class="help-block">{{ $errors->first('banner_image_url') }}</div>
                                    @endif
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                    @php $mobileBannerImg = $partnerOfferDetail->partner_offer_details->banner_mobile_view @endphp
                                    <label for="mobileImg">Mobile View Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="90"
                                        data-default-file="{{ isset($mobileBannerImg) ? config('filesystems.file_base_url') . $mobileBannerImg : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">{{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6">--}}
{{--                                    @if( !empty($partnerOfferDetail->partner_offer_details->banner_image_url) )--}}
{{--                                    <img src="{{ config('filesystems.file_base_url') . $partnerOfferDetail->partner_offer_details->banner_image_url }}" style="height:70px;width:70px;" id="imgDisplay">--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6 mt-4  {{ $errors->has('banner_name') ? ' error' : '' }}">--}}
{{--                                    <label >Image Name EN</label>--}}
{{--                                    <input type="text" name="banner_name"  class="form-control" placeholder="Enter image alter text"--}}
{{--                                           value="{{ old('banner_name') ? old('banner_name') : $partnerOfferDetail->partner_offer_details->banner_name }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_name'))--}}
{{--                                        <div class="help-block text-danger">{{ $errors->first('banner_name') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6 mt-4  {{ $errors->has('banner_name_bn') ? ' error' : '' }}">--}}
{{--                                    <label>Image Name BN</label>--}}
{{--                                    <input type="text" name="banner_name_bn"  class="form-control" placeholder="Enter image alter text"--}}
{{--                                           value="{{ old('banner_name_bn') ? old('banner_name_bn') : $partnerOfferDetail->partner_offer_details->banner_name_bn }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('banner_name_bn'))--}}
{{--                                        <div class="help-block text-danger">{{ $errors->first('banner_name_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6 mt-1">--}}
{{--                                    <label for="banner_alt_text">Alt Text EN</label>--}}
{{--                                    <input type="text" name="banner_alt_text"  class="form-control" placeholder="Enter image alter text"--}}
{{--                                           value="{{ $partnerOfferDetail->partner_offer_details->banner_alt_text }}">--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6 mt-1">--}}
{{--                                    <label for="banner_alt_text">Alt Text BN</label>--}}
{{--                                    <input type="text" name="banner_alt_text_bn"  class="form-control" placeholder="Enter image alter text"--}}
{{--                                           value="{{ $partnerOfferDetail->partner_offer_details->banner_alt_text }}">--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 mt-1 {{ $errors->has('url_slug') ? ' error' : '' }}">--}}
{{--                                    <label> URL EN (url slug) <span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control" value="{{ old('url_slug') ? old('url_slug') : $partnerOfferDetail->partner_offer_details->url_slug }}"--}}
{{--                                           name="url_slug" placeholder="URL EN">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>--}}
{{--                                    </small>--}}
{{--                                    @if ($errors->has('url_slug'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('url_slug') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 mt-1 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">--}}
{{--                                    <label> URL BN (url slug) <span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control" value="{{ old('url_slug_bn') ? old('url_slug_bn') : $partnerOfferDetail->partner_offer_details->url_slug_bn }}"--}}
{{--                                           name="url_slug_bn" placeholder="URL BN">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>--}}
{{--                                    </small>--}}
{{--                                    @if ($errors->has('url_slug_bn'))--}}
{{--                                        <div class="help-block">{{ $errors->first('url_slug_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}



                                <div class="form-group col-md-6"></div>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Image File to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });

        var auto_save_url = "{{ url('product-details/section-sortable') }}";
    </script>
@endpush






