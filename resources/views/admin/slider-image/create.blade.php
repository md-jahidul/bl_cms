@extends('layouts.admin')
@section('title', 'Slider Image Create')
@section('card_name', 'Slider Image Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('slider_images', [$sliderId, $type]) }}"> Slider Image List</a></li>
    <li class="breadcrumb-item active"> Slider Image Create</li>
@endsection
@section('action')
    <a href="{{ route('slider_images', [$sliderId, $type]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title">{{ ucwords($type) }} sliders image create</h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('slider_image_store', [$sliderId, $type]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Alt Text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter alt text">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                @include('layouts.partials.slider_types.'.$type )

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
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>


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







