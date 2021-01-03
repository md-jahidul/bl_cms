@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('life-at-banglalink/topbanner') }}">Section List</a></li>
<li class="breadcrumb-item active"> {{$sections->title_en}}</li>
@endsection
@section('action')
<a href="{{ url("life-at-banglalink/topbanner") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">


                <div class="card-body card-dashboard">
                    <form id="topbanner_section" role="form" action="{{ url('life-at-banglalink/topbanner/'.$sections->id.'/update') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <input type="hidden" name="section_category" value="{{ $sections->category }}">

                            <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (English)</label>
                                <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title_en (english)"
                                       value="{{ $sections->title_en }}" required data-validation-required-message="Enter slider title_en (english)">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="required1">Title (Bangla)</label>
                                <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (bangla)"
                                       value="{{ $sections->title_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('slug') ? ' error' : '' }}">
                                <label for="slug" class="required">Slug</label>
                                <input type="text" name="slug"  class="form-control section_slug"
                                       value="{{ $sections->slug }}" required readonly  data-validation-required-message="Slug name can not be emply">
                                <div class="help-block"></div>
                                @if ($errors->has('slug'))
                                <div class="help-block">  {{ $errors->first('slug') }}</div>
                                @endif
                            </div>





                            <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                <label for="alt_text" class="required">Banner Image (Web)</label>
                                <div class="custom-file">

                                    <input type="hidden" name="old_web_img" value="{{$sections->image}}">


                                    <input type="file" class="dropify" name="image_url" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>

                                <div class="help-block"></div>
                                @if ($errors->has('image_url'))
                                <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                @endif

                                @if( !empty($sections->image) )
                                <img style="width:100%;display:block" src="{{ config('filesystems.file_base_url') . $sections->image}}" id="imgDisplay">
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                <label for="alt_text" class="required">Banner Image (Mobile)</label>
                                <div class="custom-file">

                                    <input type="hidden" name="old_mob_img" value="{{$sections->image_mobile}}">

                                    <input type="file" class="dropify" name="image_url_mobile" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>

                                <div class="help-block"></div>
                                @if ($errors->has('image_url'))
                                <div class="help-block">  {{ $errors->first('image_url_mobile') }}</div>
                                @endif

                                @if( !empty($sections->image) )
                                <img style="width:100%;display:block" src="{{ config('filesystems.file_base_url') . $sections->image_mobile}}" id="imgDisplay">
                                @endif
                            </div>

                            <div class="col-md-4 {{ $errors->has('banner_name') ? ' error' : '' }}">
                                <label class="required">Banner Name EN</label>
                                <input type="hidden" name="old_banner_name" value="{{$sections->banner_name}}">
                                <input type="text" class="form-control" required name="banner_name"
                                       value="{{ $sections->banner_name }}" placeholder="Banner Name EN">
                                <small class="text-info">
                                    <strong>i.e:</strong> about-roaming-banner (no spaces)<br>
                                    <strong>Note: </strong> Don't need MIME type like jpg,png
                                </small>
                                @if ($errors->has('banner_name'))
                                    <div class="help-block text-danger">  {{ $errors->first('banner_name') }}</div>
                                @endif
                            </div>

                            <div class="col-md-4 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                <label class="required">Banner Name BN</label>
                                <input type="text" class="form-control" name="banner_name_bn"
                                       value="{{ $sections->banner_name_bn }}" required placeholder="Banner Name BN">
                                <small class="text-info">
                                    <strong>i.e:</strong> রোমিং-সম্পর্কে (no spaces)<br>
                                    <strong>Note: </strong> Don't need MIME type like jpg,png
                                </small>
                                @if ($errors->has('banner_name_bn'))
                                    <div class="help-block text-danger">  {{ $errors->first('banner_name_bn') }}</div>
                                @endif
                            </div>



                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label for="alt_text" class="required1">Alt Text EN</label>
                                <input type="text" name="alt_text"  class="form-control section_alt_text" placeholder="Alt Text EN"
                                       value="{{ $sections->alt_text }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text'))
                                <div class="help-block text-danger">  {{ $errors->first('alt_text') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                <label for="alt_text_bn" class="required1">Alt Text BN</label>
                                <input type="text" name="alt_text_bn"  class="form-control section_alt_text_bn" placeholder="Alt Text BN"
                                       value="{{ $sections->alt_text_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text_bn'))
                                    <div class="help-block text-danger">  {{ $errors->first('alt_text_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Page Header EN (HTML)</label>
                                <textarea class="form-control" rows="4" name="page_header">{{$sections->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                <label>Page Header BN (HTML)</label>
                                <textarea class="form-control" rows="4" name="page_header_bn">{{$sections->page_header_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="4" name="schema_markup">{{$sections->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="col-md-4 {{ $errors->has('route_slug') ? ' error' : '' }}">
                                        <label> URL EN (route slug) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control slug-convert"
                                               value="{{$sections->route_slug}}" required name="route_slug"
                                               placeholder="URL">
                                        <small class="text-info">
                                            <strong>i.e:</strong> life-at-banglalink (no spaces and slash)<br>
                                        </small>
                                        @if($errors->has('route_slug'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('route_slug') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 {{ $errors->has('route_slug_bn') ? ' error' : '' }}">
                                        <label> URL BN (route slug) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control slug-convert"
                                               value="{{$sections->route_slug_bn}}" required name="route_slug_bn"
                                               placeholder="URL">
                                        <small class="text-info">
                                            <strong>i.e:</strong> লাইফ-এট-বাংলালিংক (no spaces and slash)<br>
                                        </small>
                                        @if($errors->has('route_slug_bn'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('route_slug_bn') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label for="title" class="required mr-1">Status:</label>

                            <input type="radio" name="is_active" value="1" id="input-radio-15" @if( $sections->is_active == 1 ) checked @endif>
                            <label for="input-radio-15" class="mr-1">Active</label>

                            <input type="radio" name="is_active" value="0" id="input-radio-16" @if( $sections->is_active == 0 ) checked @endif>
                            <label for="input-radio-16">Inactive</label>

                            <div class="form-actions col-md-12 ">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> SAVE
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $sections->id }}"/>
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
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}"></script>
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


