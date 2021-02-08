@extends('layouts.admin')
@section('title', 'Be A Partner')
@section('card_name', 'Be A Partner')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url("be-a-partner") }}">Landing Page</a></li>
    <li class="breadcrumb-item ">Be A Partner and Banner Edit</li>
@endsection
@section('action')
    <a href="{{ url("be-a-partner") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <!-- Fixed sections -->
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Be A Partner Text and Banner</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("be-a-partner/save/$beAPartner->id") }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en">Title En</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($beAPartner->title_en) ? $beAPartner->title_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn">Title Bn</label>
                                    <input type="text" name="title_bn" id="title_bn" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($beAPartner->title_bn) ? $beAPartner->title_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                    <label for="description_en">Description En</label>
                                    <textarea type="text" name="description_en" id="description_en" class="form-control summernote_editor"
                                              placeholder="Enter description In English">{{ isset($beAPartner->description_en) ? $beAPartner->description_en : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_en'))
                                        <div class="help-block">{{ $errors->first('description_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                    <label for="description_bn">Description Bn</label>
                                    <textarea type="text" name="description_bn" id="description_bn" class="form-control summernote_editor"
                                              placeholder="Enter description In Bangla">{{ isset($beAPartner->description_bn) ? $beAPartner->description_bn : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_bn'))
                                        <div class="help-block">{{ $errors->first('description_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('vendor_button_en') ? ' error' : '' }}">
                                    <label for="vendor_button_en">Vendor Button En</label>
                                    <input type="text" name="vendor_button_en" id="vendor_button_en" class="form-control"
                                           placeholder="Enter vendor portal button" value="{{ isset($beAPartner->vendor_button_en) ? $beAPartner->vendor_button_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('vendor_button_en'))
                                        <div class="help-block">{{ $errors->first('vendor_button_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('vendor_button_bn') ? ' error' : '' }}">
                                    <label for="vendor_button_bn">Vendor Button Bn</label>
                                    <input type="text" name="vendor_button_bn" id="vendor_button_bn" class="form-control"
                                           placeholder="Enter vendor portal button" value="{{ isset($beAPartner->vendor_button_bn) ? $beAPartner->vendor_button_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('vendor_button_bn'))
                                        <div class="help-block">{{ $errors->first('vendor_button_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('vendor_portal_url') ? ' error' : '' }}">
                                    <label for="vendor_portal_url">Vendor Portal Url</label>
                                    <input type="text" name="vendor_portal_url" id="vendor_portal_url" class="form-control"
                                           placeholder="Enter vendor portal URL" value="{{ isset($beAPartner->vendor_portal_url) ? $beAPartner->vendor_portal_url : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('vendor_portal_url'))
                                        <div class="help-block">{{ $errors->first('vendor_portal_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('interested_button_en') ? ' error' : '' }}">
                                    <label for="interested_button_en">Interested Button En</label>
                                    <input type="text" name="interested_button_en" id="interested_button_en" class="form-control"
                                          value="{{ isset($beAPartner->interested_button_en) ? $beAPartner->interested_button_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('interested_button_en'))
                                        <div class="help-block">{{ $errors->first('interested_button_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('interested_button_bn') ? ' error' : '' }}">
                                    <label for="interested_button_bn">Interested Button Bn</label>
                                    <input type="text" name="interested_button_bn" id="interested_button_bn" class="form-control"
                                           value="{{ isset($beAPartner->interested_button_bn) ? $beAPartner->interested_button_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('interested_button_bn'))
                                        <div class="help-block">{{ $errors->first('interested_button_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('interested_url') ? ' error' : '' }}">
                                    <label for="interested_url">Interested Button Url</label>
                                    <input type="text" name="interested_url" id="interested_url" class="form-control"
                                           value="{{ isset($beAPartner->interested_url) ? $beAPartner->interested_url : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('interested_url'))
                                        <div class="help-block">{{ $errors->first('interested_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image" data-height="90" class="dropify"
                                               data-default-file="{{ isset($beAPartner->banner_image) ? config('filesystems.file_base_url') . $beAPartner->banner_image : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image_url'))
                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Mobile)</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="90"
                                               data-default-file="{{ isset($beAPartner->banner_mobile_view) ? config('filesystems.file_base_url') . $beAPartner->banner_mobile_view : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text_en">Alt Text English</label>
                                    <input type="text" name="alt_text_en" id="alt_text_en" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($beAPartner->alt_text_en) ? $beAPartner->alt_text_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_en'))
                                        <div class="help-block">{{ $errors->first('alt_text_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn">Alt Text Bangla</label>
                                    <input type="text" name="alt_text_bn" id="alt_text_bn" class="form-control"
                                           placeholder="Enter alt text" value="{{ isset($beAPartner->alt_text_bn) ? $beAPartner->alt_text_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">{{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('banner_name') ? ' error' : '' }}">
                                    <label>Banner Image Name En</label>
                                    <input type="text" class="form-control slug-convert" name="banner_name"
                                           value="{{ $beAPartner->banner_name }}" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> app-and-service-banner (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name'))
                                        <div class="help-block">{{ $errors->first('banner_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                    <label>Banner Image Name Bn</label>
                                    <input type="text" class="form-control slug-convert" name="banner_name_bn"
                                           value="{{ $beAPartner->banner_name_bn }}" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> app-and-service-banner (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name_bn'))
                                        <div class="help-block">{{ $errors->first('banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <h5><strong>Be A Partner SEO Page Info</strong></h5>
                                <div class="form-actions col-md-12 mt-0"></div>

                                <div class="form-group col-md-4 {{ $errors->has('page_header') ? ' error' : '' }}">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control" rows="7" name="page_header">{{ isset($beAPartner->page_header) ? $beAPartner->page_header : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                    <label>Page Header Bangla (HTML)</label>
                                    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($beAPartner->page_header_bn) ? $beAPartner->page_header_bn : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('schema_markup') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($beAPartner->schema_markup) ? $beAPartner->schema_markup : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        // Sortable URL
        var auto_save_url = "{{ url('landing-page-sortable') }}";

        // Image Dropify
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });
        });
    </script>
@endpush
