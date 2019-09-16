@extends('layouts.admin')
@section('title', 'Quick Launch Create')
@section('card_name', 'Quick Launch Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('quick-launch') }}"> Quick Launch List</a></li>
    <li class="breadcrumb-item active"> Quick Launch Create</li>
@endsection
@section('action')
    <a href="{{ url('quick-launch') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("quick-launch/$sliderImage->id") }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="en_title"  class="form-control" placeholder="Enter english title"
                                           value="{{ $sliderImage->title }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ $sliderImage->alt_text }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_btn_label') ? ' error' : '' }}">
                                    <label for="url_btn_label" class="required">Button Label</label>
                                    <input type="text" name="url_btn_label"  class="form-control" placeholder="Enter english title"
                                           value="{{ $sliderImage->url_btn_label }}" required data-validation-required-message="Enter link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url_btn_label'))
                                        <div class="help-block">  {{ $errors->first('url_btn_label') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('redirect_url') ? ' error' : '' }}">
                                    <label for="redirect_url" class="required">Redirect Url</label>
                                    <input type="text" name="redirect_url"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $sliderImage->redirect_url }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirect_url'))
                                        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Description</label>
                                    <textarea type="text" name="alt_text" rows="5"  class="form-control" placeholder="Enter alt text"
                                              required data-validation-required-message="Please select start date">{{ $sliderImage->description }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 mt-1">
                                    <label for="file">Select File</label>
                                    <label id="projectinput7" class="file center-block">
                                        <input type="file" id="file" name="image_url">
                                        <span class="file-custom"></span>
                                    </label>
                                </div>

                                <div class="form-group col-md-6">
                                    <img class="img-thumbnail" src="{{ asset('slider-images/'.$sliderImage->image_url) }}" height="80" width="80">
{{--                                    <label class="label-control ml-1" for="file">Current Image</label>--}}
                                </div>




                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($sliderImage->is_active == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($sliderImage->is_active == 0) {{ 'checked' }} @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
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


                    </form>
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







