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
                        <form role="form" action="{{ url("quick-launch/$quickLaunch->id") }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('en_title') ? ' error' : '' }}">
                                    <label for="en_title" class="required">English Title</label>
                                    <input type="text" name="en_title"  class="form-control" placeholder="Enter english title"
                                           value="{{ $quickLaunch->en_title }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('en_title'))
                                        <div class="help-block">  {{ $errors->first('en_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bn_title') ? ' error' : '' }}">
                                    <label for="bn_title" class="required">Bangla Title</label>
                                    <input type="text" name="bn_title"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ $quickLaunch->bn_title }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bn_title'))
                                        <div class="help-block">  {{ $errors->bn_titlefirst('bn_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('link') ? ' error' : '' }}">
                                    <label for="link" class="required">Link</label>
                                    <input type="text" name="link"  class="form-control" placeholder="Enter english title"
                                           value="{{ $quickLaunch->link }}" required data-validation-required-message="Enter link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('link'))
                                        <div class="help-block">  {{ $errors->first('link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $quickLaunch->alt_text }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mt-1">
                                    <label for="file" class="required">Select File</label>
                                    <label id="projectinput7" class="file center-block ml-2">
                                        <input type="file" id="file" name="image_url">
                                        <span class="file-custom"></span>
                                    </label>
                                    <img src="{{ $quickLaunch->image_url }}" height="50" width="50">
                                </div>

{{--                                <div class="form-group col-md-6">--}}
{{--                                    <img src="{{ $quickLaunch->image_url }}" height="50" width="50">--}}
{{--                                    <label class="label-control ml-1" for="file">Current Image</label>--}}
{{--                                </div>--}}

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($quickLaunch->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($quickLaunch->status == 0) {{ 'checked' }} @endif>
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







