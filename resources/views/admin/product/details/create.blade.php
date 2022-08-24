@extends('layouts.admin')
@section('title', 'Section Create')
@section('card_name', 'Section Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('section-list', [$simType, $productDetailsId]) }}"> Section List</a></li>
    <li class="breadcrumb-item active"> Section Create</li>
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
                        <form role="form" action="{{ route('section-store',[$simType, $productDetailsId]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="product_id" value="{{ $productDetailsId }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter section title in English"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter section title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter section title in Bangla"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id" class="required">Section Type</label>
                                    <select class="form-control" name="section_type"
                                            required data-validation-required-message="Please select section type">
                                        <option value="">---Select Section Type---</option>
                                        <option value="multi_section">Multi Component Section</option>
                                        <option value="tab_section">Tab Section</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('section_type'))
                                        <div class="help-block">  {{ $errors->first('section_type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name') ? ' error' : '' }}">
                                    <label for="banner_name" class="">Banner Name EN</label>
                                    <input type="text" name="banner_name"  class="form-control" placeholder="Enter banner title en"
                                           value="{{ old("banner_name") ? old("banner_name") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name'))
                                        <div class="help-block">  {{ $errors->first('banner_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                    <label for="banner_name_bn" class="">Banner Name BN</label>
                                    <input type="text" name="banner_name_bn"  class="form-control" placeholder="Enter banner title bn"
                                           value="{{ old("banner_name_bn") ? old("banner_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_name_bn'))
                                        <div class="help-block">  {{ $errors->first('banner_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Alt Text EN</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ old("alt_text") ? old("alt_text") : '' }}">
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn" class="">Alt Text BN</label>
                                    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Enter alt text bn"
                                           value="{{ old("alt_text_bn") ? old("alt_text_bn") : '' }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Desktop View Image</label>
                                    <div class="custom-file">
{{--                                        <input type="hidden" name="old_web_img">--}}
                                        <input type="file" name="banner_image_url" class="dropify" data-height="80">
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
{{--                                        <input type="hidden" name="old_mob_img" value="">--}}
                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="80">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group mt-1">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
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







