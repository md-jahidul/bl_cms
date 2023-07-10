@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('section-list', [$simType, $productDetailsId]) }}"> Section List</a></li>
    <li class="breadcrumb-item active"> Section Edit</li>
@endsection
@section('action')
    <a href="{{ route('section-list', [$simType, $productDetailsId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('section-update', [$simType, $productDetailsId, $section->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
{{--                                <input type="hidden" name="product_id" value="{{ $productDetailsId }}">--}}
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter company name in English"
                                           value="{{ $section->title_en }}" required data-validation-required-message="Enter company name in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter company name bangla"
                                           value="{{ $section->title_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6  {{ $errors->has('section_type') ? ' error' : '' }}">
                                    <label for="tag_category_id" class="required">Section Type</label>
                                    <select class="form-control" name="section_type" required
                                            data-validation-required-message="Please select section type">
                                        <option value="">---Select Section Type---</option>
                                        <option value="multi_section" {{ ($section->section_type == "multi_section") ? "selected" : '' }}>Multi Component Section</option>
                                        <option value="tab_section" {{ ($section->section_type == "tab_section") ? "selected" : '' }}>Tab Section</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('section_type'))
                                        <div class="help-block">  {{ $errors->first('section_type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name') ? ' error' : '' }}">
                                    <label for="banner_name" class="">Banner Name EN</label>
                                    <input type="hidden" name="old_banner_name" value="{{ $section->banner_name }}">
                                    <input type="text" name="banner_name"  class="form-control" placeholder="Enter banner title en"
                                           value="{{ $section->banner_name }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name'))
                                        <div class="help-block">  {{ $errors->first('banner_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                    <label for="banner_name_bn" class="">Banner Name BN</label>
                                    <input type="text" name="banner_name_bn"  class="form-control" placeholder="Enter banner title bn"
                                           value="{{ old("banner_name_bn") ? old("banner_name_bn") : $section->banner_name_bn  }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name_bn'))
                                        <div class="help-block">  {{ $errors->first('banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Alt Text EN</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ old("alt_text") ? old("alt_text") : $section->alt_text }}">
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn" class="">Alt Text BN</label>
                                    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Enter alt text bn"
                                           value="{{ old("alt_text_bn") ? old("alt_text_bn") : $section->alt_text_bn }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Desktop View Image</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_web_img" value="{{ isset($section->banner_image_url) ? $section->banner_image_url : null }}">
                                        <input type="file" name="banner_image_url" class="dropify" data-height="80" id="image"
                                               data-default-file="{{ isset($section->banner_image_url) ?  config('filesystems.file_base_url') . $section->banner_image_url : null  }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image_url'))
                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                    <label for="mobileImg">Mobile View Image</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_mob_img" value="{{ isset($section->banner_mobile_view) ? $section->banner_mobile_view : null }}">
                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="80" id="image"
                                               data-default-file="{{ isset($section->banner_mobile_view) ?  config('filesystems.file_base_url') . $section->banner_mobile_view : null  }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $section->alt_text }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

{{--                                <div class="col-md-6 mt-1">--}}
{{--                                    <label for="tag_category_id"></label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="is_tab_section" class="mr-1">Is Tab Section</label>--}}
{{--                                        <input type="checkbox" name="other_attributes[is_tab_section]" value="1" id="is_tab_section"--}}
{{--                                            {{ (isset($section->other_attributes['is_tab_section'])) ? "checked" : '' }}>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $section->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ $section->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
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







