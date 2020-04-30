@extends('layouts.admin')
@section('title', 'About Banglalink')
@section('card_name', 'About Banglalink')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('about-us') }}"> About Banglalink</a></li>
    <li class="breadcrumb-item active"> About Banglalink</li>
@endsection
@section('action')
    <a href="{{ url('about-us') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        @if(isset($about))
                        <form novalidate action="{{ route('about-us.update',$about->id) }}" method="post" enctype="multipart/form-data">
                         @else
                        <form novalidate action="{{ route('about-us.store') }}" method="post" enctype="multipart/form-data">
                            @endif

                            @csrf
                            @if(isset($about))
                                @method('put')
                            @else
                                @method('post')
                            @endif

                            @if(isset($about))
                                @php $banglalink_info = $about->banglalink_info; @endphp
                            @else
                                @php $banglalink_info = ''; @endphp
                            @endif

                            @if(isset($about))
                                @php $banglalink_info_bn = $about->banglalink_info_bn; @endphp
                            @else
                                @php $banglalink_info_bn = ''; @endphp
                            @endif

                            <div class="row">

                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title (English)</label>
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Title in English"
                                           value="@if(isset($about)){{$about->title}} @elseif(old("title")) {{old("title")}} @endif"
                                           required data-validation-required-message="Enter Title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter Title in Bangla"
                                           value="@if(isset($about)){{$about->title_bn}} @elseif(old("title_bn")) {{old("title_bn")}} @endif"
                                           required data-validation-required-message="Enter Title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banglalink_info') ? ' error' : '' }}">
                                    <label for="banglalink_info" class="required">Description (English)</label>
                                    <textarea required data-validation-required-message="Description (English) is required"
                                        class="form-control" name="banglalink_info" placeholder="Enter Description in English" id="banglalink_info"
                                        rows="4">{{ old("banglalink_info") ? old("banglalink_info") : $banglalink_info  }}</textarea>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banglalink_info'))
                                        <div class="help-block">  {{ $errors->first('banglalink_info') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('banglalink_info_bn') ? ' error' : '' }}">
                                    <label for="banglalink_info_bn" class="required">Description (Bangla)</label>
                                    <textarea
                                        required
                                        data-validation-required-message="Description (Bangla) is required"
                                        class="form-control" name="banglalink_info_bn" placeholder="Enter Description in Bangla" id="banglalink_info_bn"
                                        rows="4">{{ old("banglalink_info_bn") ? old("banglalink_info_bn") : $banglalink_info_bn }}</textarea>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banglalink_info_bn'))
                                        <div class="help-block">  {{ $errors->first('banglalink_info_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('content_image') ? ' error' : '' }}">
                                    <label for="alt_text" >Content Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="content_image" class="custom-file-input" id="profile_image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    {{--@if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6">
                                    @if(isset($about))
                                        <img style="height:120px;width:180px;"
                                             src="{{ config('filesystems.file_base_url') . $about->content_image }}" id="profile_image_Display">
                                    @else
                                        <img style="height:120px;width:180px;display:none" id="profile_image_Display">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image') ? ' error' : '' }}">
                                    <label for="alt_text" >Banner Image (Web)</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_web_img"
                                               value="@if(isset($about)){{$about->banner_image}} @elseif(old("old_web_img")) {{old("old_web_img")}} @endif">
                                        <input type="file" name="banner_image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    {{--@if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif--}}
                                </div>


                                <div class="form-group col-md-6">
                                    @if(isset($about))
                                        <img style="height:120px;width:180px;"
                                             src="{{ config('filesystems.file_base_url') . $about->banner_image }}" id="imgDisplay">
                                    @else
                                        <img style="height:120px;width:180px;display:none" id="imgDisplay">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image_mobile') ? ' error' : '' }}">
                                    <span>Banner image (Mobile)</span>

                                    <div class="custom-file">
                                        <input type="hidden" name="old_mob_img"
                                               value="@if(isset($about)){{$about->banner_image_mobile}} @elseif(old("old_mob_img")) {{old("old_mob_img")}} @endif">
                                        <input type="file" name="banner_image_mobile" class="custom-file-input">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    @if( !empty($about->banner_image_mobile) )
                                        <img src="{{ config('filesystems.file_base_url') . $about->banner_image_mobile }}" style="height:100px;width:400px;margin-top:10px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter image alter text"
                                           value="@if(isset($about)){{$about->alt_text}} @else {{old("alt_text")}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Banner Photo Name</label>
                                    <input type="hidden" name="old_banner_name" value="@if(isset($about)){{$about->banner_name}} @else {{old("old_banner_name")}} @endif">
                                    <input type="text" class="form-control" name="banner_name"
                                           value="@if(isset($about)){{$about->banner_name}} @else {{old("banner_name")}} @endif" placeholder="Photo Name">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-us (no spaces)<br>
                                        <strong>Note: </strong> Don't need MIME type like jpg,png
                                    </small>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug') ? ' error' : '' }}">
                                    <label> URL (url slug) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                           value="@if(isset($about)){{$about->url_slug}} @else {{old("url_slug")}} @endif" required name="url_slug" placeholder="URL">
                                    <small class="text-info">
                                        <strong>i.e:</strong> about-us (no spaces)<br>
                                    </small>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control" rows="7" name="page_header">@if(isset($about)){{$about->page_header}} @else {{old("page_header")}} @endif </textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7" name="schema_markup">@if(isset($about)){{$about->schema_markup}} @else {{old("schema_markup")}}@endif</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($about)) btn-success @else btn-info @endif ">
                                            @if(isset($about)) <i class="la la-check-square-o"></i> Update @else <i class="la la-check-square-o"></i> SAVE @endif
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
@endpush
@push('page-js')

@endpush







