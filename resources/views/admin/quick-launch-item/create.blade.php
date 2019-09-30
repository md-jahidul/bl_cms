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
                        <form role="form" action="{{ route('quick-launch.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">English Title</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Bangla Title</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('link') ? ' error' : '' }}">
                                    <label for="link" class="required">Link</label>
                                    <input type="text" name="link"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("link") ? old("link") : '' }}" required data-validation-required-message="Enter link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('link'))
                                        <div class="help-block">  {{ $errors->first('link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ old("alt_text") ? old("alt_text") : '' }}" required data-validation-required-message="Enter alt text">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 mt-1 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="file" class="required">Select File</label>

                                    <label id="projectinput7" class="file center-block ml-2">
                                        <input type="file" id="file" name="image_url" required>
                                    </label><br>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <label for="title" class="required mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>
                                        @if ($errors->has('status'))
                                            <div class="help-block">  {{ $errors->first('status') }}</div>
                                        @endif
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
@endpush
@push('page-js')

@endpush







