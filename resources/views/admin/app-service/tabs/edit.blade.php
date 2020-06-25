@extends('layouts.admin')
@section('title', 'Offer Category Create')
@section('card_name', 'Offer Category Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('tabs.index') }}">App & Service Tabs List</a></li>
    <li class="breadcrumb-item active"> App & Service Tabs Edit</li>
@endsection
@section('action')
    <a href="{{ route('tabs.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("tabs.update", $appServiceTab->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">

                                <div class="form-group col-md-4 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Name (English)</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ $appServiceTab->name_en }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Name (Bangla)</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter duration name in bangla"
                                           value="{{ $appServiceTab->name_bn }}" required data-validation-required-message="Enter duration name in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label> URL (url slug) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$appServiceTab->url_slug}}" required name="url_slug" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> app-and-service-title (no spaces)<br>
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <span>Banner image (Web)</span>

                                    <div class="custom-file">

                                        <input type="hidden" name="old_web_img" value="{{ $appServiceTab->banner_image_url }}">

                                        <input type="file" name="banner_image_url" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>

                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    @if( !empty($appServiceTab->banner_image_url) )
                                        <img src="{{ config('filesystems.file_base_url') . $appServiceTab->banner_image_url }}" style="width:100%;margin-top:10px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('banner_image_mobile') ? ' error' : '' }}">
                                    <span>Banner image (Mobile)</span>

                                    <div class="custom-file">
                                        <input type="hidden" name="old_mob_img" value="{{ $appServiceTab->banner_image_mobile }}">

                                        <input type="file" name="banner_image_mobile" class="custom-file-input">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    @if( !empty($appServiceTab->banner_image_url) )
                                        <img src="{{ config('filesystems.file_base_url') . $appServiceTab->banner_image_mobile }}" style="width:100%;margin-top:10px;">
                                    @endif

                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('banner_alt_text') ? ' error' : '' }}">
                                    <label for="banner_alt_text" class="required">Alt Text</label>
                                    <input type="text" name="banner_alt_text"  class="form-control" placeholder="Enter image alter text"
                                           value="{{ $appServiceTab->banner_alt_text }}" required data-validation-required-message="Enter image alter text">
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_alt_text'))
                                        <div class="help-block">  {{ $errors->first('banner_alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Banner Photo Name</label>
                                    <input type="hidden" name="old_banner_name" value="{{$appServiceTab->banner_name}}">
                                    <input type="text" class="form-control" name="banner_name" value="{{$appServiceTab->banner_name}}" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> app-and-service-banner (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control" rows="7" name="page_header">{{$appServiceTab->page_header}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7" name="schema_markup">{{$appServiceTab->schema_markup}}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ ($appServiceTab->status == 1) ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ ($appServiceTab->status == 0) ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6"></div>

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

@endpush














