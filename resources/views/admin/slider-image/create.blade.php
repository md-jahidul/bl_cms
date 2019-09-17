@extends('layouts.admin')
@section('title', 'Slider Image Create')
@section('card_name', 'Slider Image Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('quick-launch') }}"> Slider Image List</a></li>
    <li class="breadcrumb-item active"> Slider Image Create</li>
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
                        <form role="form" action="{{ route('slider_image_store', [$sliderId, $type]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_btn_label') ? ' error' : '' }}">
                                    <label for="url_btn_label" class="required">Button Label</label>
                                    <input type="text" name="url_btn_label"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url_btn_label'))
                                        <div class="help-block">  {{ $errors->first('url_btn_label') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('redirect_url') ? ' error' : '' }}">
                                    <label for="redirect_url" class="required">Redirect Url</label>
                                    <input type="text" name="redirect_url"  class="form-control" placeholder="Enter alt text"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirect_url'))
                                        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Description</label>
                                    <textarea type="text" name="description" rows="5"  class="form-control" placeholder="Enter alt text"
                                              required data-validation-required-message="Please select start date">{{ old("title") ? old("title") : '' }}</textarea>
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

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                @include('layouts.partials.slider_types.'.$type )

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
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush







