@extends('layouts.admin')
@section('title', 'Offer Category Create')
@section('card_name', 'Offer Category Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ url('offer-categories') }}">Offer Categories List</a></li>
<li class="breadcrumb-item active"> Offer Category Edit</li>
@endsection
@section('action')
<a href="{{ url('offer-categories') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form role="form" action="{{ route("offer-categories.update", $offer->id) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="row">
{{--                            @dd($errors->all())--}}
{{--                            {{ $errors }}--}}
                            <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                <label for="name_en" class="required">Name (English)</label>
                                <input type="text" name="name_en"  class="form-control" placeholder="Enter duration name in english"
                                       value="{{ $offer->name_en }}" required data-validation-required-message="Enter duration name in english">
                                <div class="help-block"></div>
                                @if ($errors->has('name_en'))
                                <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                <label for="name_bn" class="required">Name (Bangla)</label>
                                <input type="text" name="name_bn"  class="form-control" placeholder="Enter duration name in bangla"
                                       value="{{ $offer->name_bn }}" required data-validation-required-message="Enter duration name in bangla">
                                <div class="help-block"></div>
                                @if ($errors->has('name_bn'))
                                <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                @endif
                            </div>

                            <h4><strong>For Prepaid</strong></h4>
                            <div class="form-actions col-md-12 mt-0"></div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                <label for="inputGroupFile01">Banner image (Web)</label>
                                    <input type="file" name="banner_image_url" class="form-control dropify" id="image" data-height="90"
                                           data-default-file="{{ config('filesystems.file_base_url') . $offer->banner_image_url }}">
                                <span class="text-primary">Please given file type (.png, .jpg)</span>
                                <div class="help-block"></div>
                                @if ($errors->has('thumbnail_image'))
                                    <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_image_mobile') ? ' error' : '' }}">
                                <label>Banner image (Mobile)</label>
                                <input type="file" name="banner_image_mobile" class="custom-file-input dropify" data-height="90"
                                       data-default-file="{{ config('filesystems.file_base_url') . $offer->banner_image_mobile }}">
                                <span class="text-primary">Please given file type (.png, .jpg)</span>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                <label> URL English<span class="text-danger">*</span></label>
                                <input type="text" class="form-control slug-convert" value="{{$offer->url_slug}}" required name="url_slug"
                                       id="url_en" placeholder="URL">
                                <small class="text-info">
                                    <strong>i.e:</strong> bundles (no spaces and slash)<br>
                                </small>
                                @if ($errors->has('url_slug'))
                                    <div class="help-block">  {{ $errors->first('url_slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                <label> URL Bangla<span class="text-danger">*</span></label>
                                <input type="text" class="form-control slug-convert" value="{{ isset($offer->url_slug_bn) ? $offer->url_slug_bn : '' }}"
                                       id="url_bn" required name="url_slug_bn" placeholder="URL">
                                <small class="text-info">
                                    <strong>i.e:</strong> বান্ডেল (no spaces and slash)<br>
                                </small>
                                @if ($errors->has('url_slug_bn'))
                                    <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>
                                    <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('banner_alt_text') ? ' error' : '' }}">
                                <label for="banner_alt_text">Alt Text English</label>
                                <input type="text" name="banner_alt_text"  class="form-control" placeholder="Enter image alter text"
                                       value="{{ $offer->banner_alt_text }}">
                                <div class="help-block"></div>
                                @if ($errors->has('banner_alt_text'))
                                <div class="help-block">  {{ $errors->first('banner_alt_text') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 {{ $errors->has('banner_alt_text_bn') ? ' error' : '' }}">
                                <label for="banner_alt_text_bn">Alt Text Bangla</label>
                                <input type="text" name="banner_alt_text_bn"  class="form-control" placeholder="Enter image alter text"
                                       value="{{ $offer->banner_alt_text_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('banner_alt_text_bn'))
                                    <div class="help-block">  {{ $errors->first('banner_alt_text_bn') }}</div>
                                @endif
                            </div>

{{--                            <div class="form-group col-md-6 {{ $errors->has('banner_name') ? ' error' : '' }}">--}}
{{--                                <label>Banner Name En <span class="text-danger">*</span></label>--}}
{{--                                <input type="text" class="form-control slug-convert" required name="banner_name" value="{{$offer->banner_name}}"--}}
{{--                                       placeholder="Enter English Web Banner Name" id="banner_name_en">--}}
{{--                                <small class="text-info">--}}
{{--                                    <strong>i.e:</strong> prepaid-internet-banner (no spaces)<br>--}}
{{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
{{--                                </small>--}}
{{--                                @if ($errors->has('banner_name'))--}}
{{--                                    <div class="help-block">  {{ $errors->first('banner_name') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-6 {{ $errors->has('banner_name_web_bn') ? ' error' : '' }}">--}}
{{--                                <label>Banner Name Bn<span class="text-danger">*</span></label>--}}
{{--                                <input type="text" class="form-control slug-convert" name="banner_name_web_bn"--}}
{{--                                       value="{{$offer->banner_name_web_bn}}" required--}}
{{--                                       placeholder="Enter Bangeli Web Banner Name">--}}
{{--                                <small class="text-info">--}}
{{--                                    <strong>i.e:</strong> prepaid-internet-banner (no spaces)<br>--}}
{{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
{{--                                </small>--}}
{{--                                @if ($errors->has('banner_name_web_bn'))--}}
{{--                                    <div class="help-block">  {{ $errors->first('banner_name_web_bn') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{$offer->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{$offer->page_header_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{$offer->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            {{--// Postpaid--}}
                            @php
                                $bondhoSim = 22;
                            @endphp

                            @if($offer->id != $bondhoSim)
                                <h4><strong>For Postpaid</strong></h4>
                                <div class="form-actions col-md-12 mt-0"></div>

                                <div class="form-group col-md-6 {{ $errors->has('postpaid_banner_image_url') ? ' error' : '' }}">
                                    <label for="inputGroupFile01">Banner image (Web)</label>
                                    <input type="hidden" name="old_web_img" value="{{ $offer->postpaid_banner_image_url }}">
                                    <input type="file" name="postpaid_banner_image_url" class="form-control dropify" id="image" data-height="90"
                                           data-default-file="{{ config('filesystems.file_base_url') . $offer->postpaid_banner_image_url }}">
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('postpaid_banner_image_mobile') ? ' error' : '' }}">
                                    <label>Banner image (Mobile)</label>
                                    <input type="hidden" name="old_mob_img" value="{{ $offer->postpaid_banner_image_mobile }}">
                                    <input type="file" name="postpaid_banner_image_mobile" class="custom-file-input dropify" data-height="90"
                                           data-default-file="{{ config('filesystems.file_base_url') . $offer->postpaid_banner_image_mobile }}">
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('postpaid_url_slug') ? ' error' : '' }}">
                                    <label> URL English<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" value="{{$offer->postpaid_url_slug}}" required name="postpaid_url_slug"
                                           id="url_en" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> bundles (no spaces and slash)<br>
                                    </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('postpaid_url_slug'))
                                        <div class="help-block">  {{ $errors->first('postpaid_url_slug') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('postpaid_url_slug_bn') ? ' error' : '' }}">
                                    <label> URL Bangla<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control slug-convert" value="{{ isset($offer->postpaid_url_slug_bn) ? $offer->postpaid_url_slug_bn : '' }}"
                                           id="url_bn" required name="postpaid_url_slug_bn" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> বান্ডেল (no spaces and slash)<br>
                                    </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('postpaid_url_slug_bn'))
                                        <div class="help-block">  {{ $errors->first('postpaid_url_slug_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('postpaid_alt_text') ? ' error' : '' }}">
                                    <label for="postpaid_alt_text">Alt Text English</label>
                                    <input type="text" name="postpaid_alt_text"  class="form-control" placeholder="Enter image alter text"
                                           value="{{ $offer->postpaid_alt_text }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('postpaid_alt_text'))
                                        <div class="help-block">  {{ $errors->first('postpaid_alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('postpaid_alt_text_bn') ? ' error' : '' }}">
                                    <label for="postpaid_alt_text_bn">Alt Text Bangla</label>
                                    <input type="text" name="postpaid_alt_text_bn"  class="form-control" placeholder="Enter image alter text"
                                           value="{{ $offer->postpaid_alt_text_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('postpaid_alt_text_bn'))
                                        <div class="help-block">  {{ $errors->first('postpaid_alt_text_bn') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('postpaid_banner_name') ? ' error' : '' }}">--}}
{{--                                    <label class="required">Banner Name En</label>--}}
{{--    --}}{{--                                <input type="hidden" name="old_postpaid_banner_name_en" value="{{$offer->postpaid_banner_name}}">--}}
{{--                                    <input type="text" class="form-control slug-convert" required name="postpaid_banner_name" value="{{$offer->postpaid_banner_name}}"--}}
{{--                                           placeholder="Enter English Web Banner Name" id="postpaid_banner_name_en">--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> prepaid-internet-banner (no spaces)<br>--}}
{{--                                        <strong>Note: </strong> Don't need MIME type like jpg,png--}}
{{--                                    </small>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('postpaid_banner_name'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('postpaid_banner_name') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('postpaid_banner_name_bn') ? ' error' : '' }}">--}}
{{--                                    <label class="required">Banner Name Bn</label>--}}
{{--                                    <input type="text" class="form-control slug-convert" name="postpaid_banner_name_bn"--}}
{{--                                           value="{{$offer->postpaid_banner_name_bn}}" required--}}
{{--                                           placeholder="Enter Bangeli Web Banner Name">--}}
{{--                                    <small class="text-info">--}}
{{--                                        <strong>i.e:</strong> prepaid-internet-banner (no spaces)<br>--}}
{{--                                        <strong>Note: </strong> Don't need MIME type like jpg,png--}}
{{--                                    </small>--}}
{{--                                    @if ($errors->has('postpaid_banner_name_bn'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('postpaid_banner_name_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-4 {{ $errors->has('postpaid_page_header') ? ' error' : '' }}">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control" rows="7" name="postpaid_page_header">{{$offer->postpaid_page_header}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('postpaid_page_header_bn') ? ' error' : '' }}">
                                    <label>Page Header Bangla (HTML)</label>
                                    <textarea class="form-control" rows="7" name="postpaid_page_header_bn">{{$offer->postpaid_page_header_bn}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('postpaid_schema_markup') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7" name="postpaid_schema_markup">{{$offer->postpaid_schema_markup}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>
                            @endif


                            <div class="form-actions col-md-12 ">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> UPDATE
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
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
    <script>
        //show dropify for  photo
        $('.dropify').dropify({
            messages: {
                'default': 'Browse for File/Photo',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });

    </script>
@endpush














