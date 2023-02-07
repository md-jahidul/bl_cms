@extends('layouts.admin')
@section('title', 'Quick Launch Create')
@section('card_name', "Quick Launch $type Edit")
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url("quick-launch/$type") }}"> Quick Launch {{ $type }} List</a></li>
    <li class="breadcrumb-item active"> Quick Launch {{ $type }} Edit</li>
@endsection
@section('action')
    <a href="{{ url("quick-launch/$type") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("quick-launch.update", [$type, $quickLaunch->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">English Title</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter english title"
                                           value="{{ $quickLaunch->title_en }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Bangla Title</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ $quickLaunch->title_bn }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->title_bnfirst('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text English</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $quickLaunch->alt_text }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn" class="required">Alt Text Bangla</label>
                                    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $quickLaunch->alt_text_bn }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-5 mt-1 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <div class="custom-file">
                                        <input type="file" name="image_url" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, .svg)</span>
                                </div>

                                <div class="form-group col-md-1">
                                    <img src="{{ config('filesystems.file_base_url') . $quickLaunch->image_url }}" style="height:70px;width:70px;" id="imgDisplay">
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                    <label for="image_name_en" class="required">Image Name English</label>
                                    <input type="text" name="image_name_en"  class="form-control" placeholder="example: /quick-recharge"
                                           value="{{ $quickLaunch->image_name_en }}" required data-validation-required-message="Enter image name en">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_en'))
                                        <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label for="image_name_bn" class="required">Image Name Bangla </label>
                                    <input type="text" name="image_name_bn"  class="form-control" placeholder="example: /quick-recharge"
                                           value="{{ $quickLaunch->image_name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('link') ? ' error' : '' }}">
                                    <label for="link" class="required">URL English</label>
                                    <input type="text" name="link"  class="form-control" placeholder="example: /quick-recharge"
                                           value="{{ $quickLaunch->link }}" required data-validation-required-message="Enter link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('link'))
                                        <div class="help-block">  {{ $errors->first('link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('link_bn') ? ' error' : '' }}">
                                    <label for="link_bn" class="required">URL Bangla </label>
                                    <input type="text" name="link_bn"  class="form-control" placeholder="example: /quick-recharge"
                                           value="{{ $quickLaunch->link_bn }}" required data-validation-required-message="Enter link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('link_bn'))
                                        <div class="help-block">  {{ $errors->first('link_bn') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('link') ? ' error' : '' }}">--}}
{{--                                    <label for="link" class="required">Link</label>--}}
{{--                                    <input type="text" name="link"  class="form-control" placeholder="Enter english title"--}}
{{--                                           value="{{ $quickLaunch->link }}" required data-validation-required-message="Enter link">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('link'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('link') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="is_external_link" class="mr-1">Is External Link:</label>
                                        <input type="checkbox" name="is_external_link" value="1" id="is_external_link" {{ $quickLaunch->is_external_link == 1 ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($quickLaunch->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($quickLaunch->status == 0) {{ 'checked' }} @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            {{method_field('PUT')}}
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







