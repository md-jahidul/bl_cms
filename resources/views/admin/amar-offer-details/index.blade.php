
@extends('layouts.admin')
@section('title', "Amar Offer Details")
@section('card_name', "Amar Offer Details")
@section('breadcrumb')
<li class="breadcrumb-item ">Offer Details List</li>
@endsection
@section('action')

@endsection
@section('content')

<section>
    @php $types = array('Internet', 'Voice', 'Bundle'); @endphp
    @foreach($offerDetails as $key => $details)
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="menu-title text-success"><strong> {{ $types[$key] }} Details</strong></h4><hr>
                <div class="card-body card-dashboard">
                    <div class="raw">
                        <div class="col-xs-12 col-md-5 pull-left">
                            <h5 class="text-center">
                                <strong> English</strong>
                                <hr>
                            </h5>

                            {!! $details->details_en !!}
                        </div>
                        <div class="col-xs-12 col-md-5 pull-left">
                            <h5 class="text-center">
                                <strong> Bangla</strong>
                                <hr>
                            </h5>
                            {!! $details->details_bn !!}
                        </div>
                        <div class="col-xs-12 col-md-2 text-center pull-right">
                            <a href="{{ route('amaroffer.edit', [$details->type]) }}" role="button" class="btn-sm btn-warning">
                                <i class="la la-pencil-square"></i> Update
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


{{--    <div class="card">--}}
{{--        <div class="card-content collapse show">--}}
{{--            <div class="card-body card-dashboard">--}}
{{--                <h4 class="menu-title"><strong>Banner Image</strong></h4><hr>--}}
{{--                <div class="card-body card-dashboard">--}}
{{--                    <form role="form" action="{{ route('banner-image-upload') }}" method="POST" novalidate enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        {{method_field('POST')}}--}}
{{--                        <div class="row">--}}

{{--                            <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">--}}
{{--                                <label for="mobileImg">Desktop View Image</label>--}}
{{--                                <div class="custom-file">--}}
{{--                                    <input type="hidden" name="old_web_img" value="{{ isset($bannerImage->banner_image_url) ? $bannerImage->banner_image_url : null }}">--}}
{{--                                    <input type="file" name="banner_image_url" class="dropify" data-height="80" id="image"--}}
{{--                                           data-default-file="{{ isset($bannerImage->banner_image_url) ?  config('filesystems.file_base_url') . $bannerImage->banner_image_url : null  }}">--}}
{{--                                </div>--}}
{{--                                <span class="text-primary">Please given file type (.png, .jpg)</span>--}}

{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('banner_image_url'))--}}
{{--                                    <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">--}}
{{--                                <label for="mobileImg">Mobile View Image</label>--}}
{{--                                <div class="custom-file">--}}
{{--                                    <input type="hidden" name="old_mob_img" value="{{ isset($bannerImage->banner_mobile_view) ? $bannerImage->banner_mobile_view : null }}">--}}
{{--                                    <input type="file" name="banner_mobile_view" class="dropify" data-height="80" id="image"--}}
{{--                                           data-default-file="{{ isset($bannerImage->banner_mobile_view) ?  config('filesystems.file_base_url') . $bannerImage->banner_mobile_view : null  }}">--}}
{{--                                </div>--}}
{{--                                <span class="text-primary">Please given file type (.png, .jpg)</span>--}}

{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('banner_mobile_view'))--}}
{{--                                    <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                <label for="alt_text">Alt Text</label>--}}
{{--                                <input type="text" name="alt_text" id="alt_text" class="form-control" placeholder="Enter offer name in English"--}}
{{--                                       value="{{ isset($bannerImage->alt_text) ? $bannerImage->alt_text : null }}">--}}
{{--                                <div class="help-block"></div>--}}
{{--                                @if ($errors->has('alt_text'))--}}
{{--                                    <div class="help-block">{{ $errors->first('alt_text') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}


{{--                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--                                <label>Banner Photo Name</label>--}}
{{--                                <input type="hidden" name="old_banner_name" value="{{ isset($bannerImage->banner_name) ? $bannerImage->banner_name : null }}">--}}
{{--                                <input type="text" class="form-control" name="banner_name" value="{{ isset($bannerImage->banner_name) ? $bannerImage->banner_name : null }}"--}}
{{--                                       placeholder="Photo Name">--}}
{{--                                <small class="text-info">--}}
{{--                                    <strong>i.e:</strong> app-and-service-banner (no spaces)<br>--}}
{{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
{{--                                </small>--}}
{{--                            </div>--}}

{{--                            <div class="form-actions col-md-12">--}}
{{--                                <div class="pull-right">--}}
{{--                                    <button type="submit" class="btn btn-primary"><i--}}
{{--                                            class="la la-check-square-o"></i> Save--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</section>

<!--Banner Section-->
@php
    $action = [
        'section_id' => 0,
        'section_type' => "amar_offer"
    ];

@endphp
@include('admin.al-banner.section', $action)

@stop

@push('page-css')
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
    </script>
@endpush
