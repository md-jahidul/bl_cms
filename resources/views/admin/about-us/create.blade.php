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

                                <div class="form-group col-md-6 {{ $errors->has('banglalink_info') ? ' error' : '' }}">
                                    <label for="banglalink_info" class="required">About Banglalink (English)</label>
                                    <textarea
                                        required
                                        data-validation-required-message="About Banglalink is required"
                                        class="form-control" name="banglalink_info" placeholder="Enter About Banglalink in English" id="banglalink_info"
                                        rows="4">{{ old("banglalink_info") ? old("banglalink_info") : $banglalink_info  }}</textarea>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banglalink_info'))
                                        <div class="help-block">  {{ $errors->first('banglalink_info') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('banglalink_info_bn') ? ' error' : '' }}">
                                    <label for="banglalink_info_bn" class="required">About Banglalink (Bangla)</label>
                                    <textarea
                                        required
                                        data-validation-required-message="About Banglalink is required"
                                        class="form-control" name="banglalink_info_bn" placeholder="Enter About Banglalink in Bangla" id="banglalink_info_bn"
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

                                <div class="form-group col-md-6 {{ $errors->has('banner_image') ? ' error' : '' }}">
                                    <label for="alt_text" >Banner Image</label>
                                    <div class="custom-file">
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
                                        <img style="height:80px;width:100px;"
                                             src="{{ config('filesystems.file_base_url') . $about->content_image }}" id="profile_image_Display">
                                    @else
                                        <img style="height:80px;width:100px;display:none" id="profile_image_Display">
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    @if(isset($about))
                                        <img style="height:80px;width:100px;"
                                             src="{{ config('filesystems.file_base_url') . $about->banner_image }}" id="imgDisplay">
                                    @else
                                        <img style="height:80px;width:100px;display:none" id="imgDisplay">
                                    @endif
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







