@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('corporate-resp-section') }}">Section List</a></li>
<li class="breadcrumb-item active"> {{$section->title_en}}</li>
@endsection
@section('action')
<a href="{{ url("corporate-resp-section") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form id="topbanner_section" role="form" action="{{ route("corporate-resp-section.update", $section->id) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (English)</label>
                                <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title_en (english)"
                                       value="{{ $section->title_en }}" required data-validation-required-message="Enter slider title_en (english)">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="required1">Title (Bangla)</label>
                                <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (bangla)"
                                       value="{{ $section->title_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('slug') ? ' error' : '' }}">
                                <label for="slug" class="required">Slug</label>
                                <input type="text" name="slug"  class="form-control section_slug"
                                       value="{{ $section->slug }}" required readonly  data-validation-required-message="Slug name can not be emply">
                                <div class="help-block"></div>
                                @if ($errors->has('slug'))
                                <div class="help-block">  {{ $errors->first('slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                <label for="alt_text" class="required">Banner Image (Web)</label>
                                <div class="custom-file">
{{--                                    <input type="hidden" name="old_web_img" value="{{$section->image}}">--}}
                                    <input type="file" class="dropify" name="banner_image_url" data-height="70"
                                           data-default-file="{{ isset($section->banner_image_url) ? config('filesystems.file_base_url') . $section->banner_image_url : '' }}"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>
                                <div class="help-block"></div>
                                @if ($errors->has('banner_image_url'))
                                <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                <label for="alt_text" class="required">Banner Image (Mobile)</label>
                                <div class="custom-file">
{{--                                    <input type="hidden" name="old_mob_img" value="{{$section->image_mobile}}">--}}
                                    <input type="file" class="dropify" name="banner_mobile_view" data-height="70"
                                           data-default-file="{{ isset($section->banner_mobile_view) ? config('filesystems.file_base_url') . $section->banner_mobile_view : '' }}"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>
                                <div class="help-block"></div>
                                @if ($errors->has('banner_mobile_view'))
                                <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                @endif
                            </div>



                            <div class="form-group col-md-4 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                <label for="alt_text_en" class="required1">Alt text</label>
                                <input type="text" name="alt_text_en"  class="form-control section_alt_text"
                                       value="{{ $section->alt_text }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text_en'))
                                <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{$section->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{$section->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
{{--                                <label>Banner Photo Name</label>--}}
{{--                                <input type="hidden" name="old_banner_name" value="{{$section->banner_name}}">--}}
{{--                                <input type="text" class="form-control" name="banner_name" value="{{$section->banner_name}}" placeholder="Photo Name">--}}
{{--                                <small class="text-info">--}}
{{--                                    <strong>i.e:</strong> about-roaming-banner (no spaces)<br>--}}
{{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
{{--                                </small>--}}
                                <br>
                                <br>
{{--                                <label> URL (route slug) <span class="text-danger">*</span></label>--}}
{{--                                <input type="text" class="form-control" value="{{$section->route_slug}}" required name="route_slug" placeholder="URL">--}}
{{--                                <small class="text-info">--}}
{{--                                    <strong>i.e:</strong> Buy-tickets-on-discount (no spaces)<br>--}}
{{--                                </small>--}}
                                <br>
                                <label for="title" class="required mr-1">Status:</label>
                                <input type="radio" name="status" value="1" id="input-radio-15" @if( $section->status == 1 ) checked @endif>
                                       <label for="input-radio-15" class="mr-1">Active</label>
                                <input type="radio" name="status" value="0" id="input-radio-16" @if( $section->status == 0 ) checked @endif>
                                       <label for="input-radio-16">Inactive</label>
                            </div>

                            <div class="form-actions col-md-12 ">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> SAVE
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

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

@endpush
@push('page-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


<script>
$(function () {

//show dropify for  photo
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });






});


</script>
@endpush


