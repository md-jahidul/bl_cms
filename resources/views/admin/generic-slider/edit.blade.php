@extends('layouts.admin')
@section('title', 'Create Generic Slider')
@section('card_name', 'Create Generic Slider')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ url('generic-slider') }}">Generic Slider List</a>
    </li>
    <li class="breadcrumb-item active">Create Campaign</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('generic-slider.update', $slider->id) }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title_en" class="required">Title English</label>
                                    <input class="form-control"
                                           name="title_en"
                                           id="title_en"
                                           placeholder="Enter English Title"
                                           value="{{ $slider->title_en }}"
                                           required>
                                    @if($errors->has('title_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input class="form-control"
                                           name="title_bn"
                                           id="title_bn"
                                           placeholder="Enter Bangla Title"
                                           value="{{ $slider->title_bn }}"
                                           required>
                                    @if($errors->has('title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input">Component For: </label>
                                    <div class="form-group {{ $errors->has('component_for') ? ' error' : '' }}">
                                        <input type="radio" name="component_for" value="commerce" id="campaignStatusActive"
                                            {{ (isset($slider->component_for) && $slider->component_for == 'commerce') ? 'checked' : '' }} disabled>
                                        <label for="campaignStatusActive" class="mr-3">Commerce</label>
                                        <input type="radio" name="component_for" value="content" id="campaignStatusActive"
                                            {{ (isset($slider->component_for) && $slider->component_for == 'content') ? 'checked' : '' }} disabled>
                                        <label for="campaignStatusActive" class="mr-3">Content</label>
                                        <input type="radio" name="component_for" value="home" id="campaignStatusInactive"
                                            {{ (isset($slider->component_for) && $slider->component_for == 'home') ? 'checked' : '' }}
                                            {{ isset($slider->component_for) ? '' : 'checked' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">Home</label>
                                        <input type="radio" name="component_for" value="lms" id="campaignStatusInactive"
                                            {{ (isset($slider->component_for) && $slider->component_for == 'lms') ? 'checked' : '' }}
                                            {{ isset($slider->component_for) ? '' : 'checked' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">LMS</label> <br>
                                        <input type="radio" name="component_for" value="toffee" id="campaignStatusInactive"
                                               {{ (isset($slider->component_for) && $slider->component_for == 'toffee') ? 'checked' : '' }}
                                               {{ isset($slider->component_for) ? '' : 'checked' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">Toffee Home</label>
                                        <input type="radio" name="component_for" value="toffee_section" id="campaignStatusInactive"
                                               {{ (isset($slider->component_for) && $slider->component_for == 'toffee_section') ? 'checked' : '' }}
                                               {{ isset($slider->component_for) ? '' : 'checked' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">Toffee Section</label>
                                        @if ($errors->has('component_for'))
                                            <div class="help-block">  {{ $errors->first('component_for') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>
    </script>
@endpush
