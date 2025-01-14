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


                                <div class="form-group col-md-6">
                                    <label for="component_size" class="required">Component Size</label>
                                    <select disabled name="component_size" class="form-control custom-select"
                                            id="component_size" required data-validation-required-message="Please select component size">
                                        <option value="" >--Select Tab Section--</option>

                                        @foreach (Config::get('generic-slider.component_size') as $key => $size)
                                        <option value="{{$key}}" {{ (isset($slider->component_size) && $slider->component_size == $key) ? 'selected' : '' }} >{{$size}}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('component_size'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('component_size') }}</small>
                                        </p>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="component_type" class="required">Component Type</label>
                                    <select disabled name="component_type" class="form-control custom-select"
                                            id="component_type" required data-validation-required-message="Please select component type">
                                        <option value="" >--Select Tab Section--</option>
                                        @foreach (Config::get('generic-slider.component_type') as $key => $type)
                                        <option value="{{$key}}" {{ (isset($slider->component_type) && $slider->component_type == $key) ? 'selected' : '' }} >{{ucfirst($type)}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('component_type'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('component_type') }}</small>
                                        </p>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="hidden" name = "component_for" value="{{ $slider->component_for }}">
                                    <label for="component_for" class="required">Component For</label>
                                    <select disabled name="component_for" class="form-control custom-select"
                                            id="component_for" required data-validation-required-message="Please select component For">
                                        <option value="" >--Select Tab Section--</option>
                                        @foreach ($componentType as $key => $type)
                                            <option value="{{$key}}" {{ (isset($slider->component_for) && $slider->component_for == $key) ? 'selected' : '' }} >{{$type}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('component_for'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('component_for') }}</small>
                                        </p>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 mb-2">--}}
{{--                                    <label for="status_input">Component For: </label>--}}
{{--                                    <div class="form-group {{ $errors->has('component_for') ? ' error' : '' }}">--}}
{{--                                        <input type="radio" name="component_for" value="commerce" id="campaignStatusActive"--}}
{{--                                            {{ (isset($slider->component_for) && $slider->component_for == 'commerce') ? 'checked' : '' }} disabled>--}}
{{--                                        <label for="campaignStatusActive" class="mr-3">Commerce</label>--}}
{{--                                        <input type="radio" name="component_for" value="content" id="campaignStatusActive"--}}
{{--                                            {{ (isset($slider->component_for) && $slider->component_for == 'content') ? 'checked' : '' }} disabled>--}}
{{--                                        <label for="campaignStatusActive" class="mr-3">Content</label>--}}
{{--                                        <input type="radio" name="component_for" value="home" id="campaignStatusInactive"--}}
{{--                                            {{ (isset($slider->component_for) && $slider->component_for == 'home') ? 'checked' : '' }} disabled>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">Home</label>--}}
{{--                                        <input type="radio" name="component_for" value="lms" id="campaignStatusInactive"--}}
{{--                                            {{ (isset($slider->component_for) && $slider->component_for == 'lms') ? 'checked' : '' }}--}}
{{--                                            {{ isset($slider->component_for) ? '' : 'checked' }} disabled>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">LMS</label>--}}
{{--                                        <input type="radio" name="component_for" value="non_bl" id="campaignStatusInactive"--}}
{{--                                            {{ (isset($slider->component_for) && $slider->component_for == 'non_bl') ? 'checked' : '' }} disabled>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">Non Bl</label>--}}
{{--                                        <input type="radio" name="component_for" value="non_bl_offer" id="campaignStatusInactive"--}}
{{--                                            {{ (isset($slider->component_for) && $slider->component_for == 'non_bl_offer') ? 'checked' : '' }} disabled>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">Non Bl Offer</label>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">LMS</label> <br>--}}
{{--                                        <input type="radio" name="component_for" value="toffee" id="campaignStatusInactive"--}}
{{--                                               {{ (isset($slider->component_for) && $slider->component_for == 'toffee') ? 'checked' : '' }}--}}
{{--                                               {{ isset($slider->component_for) ? '' : 'checked' }} disabled>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">Toffee Home</label>--}}
{{--                                        <input type="radio" name="component_for" value="toffee_section" id="campaignStatusInactive"--}}
{{--                                               {{ (isset($slider->component_for) && $slider->component_for == 'toffee_section') ? 'checked' : '' }}--}}
{{--                                               {{ isset($slider->component_for) ? '' : 'checked' }} disabled>--}}
{{--                                        <label for="campaignStatusInactive" class="mr-3">Toffee Section</label>--}}
{{--                                        @if ($errors->has('component_for'))--}}
{{--                                            <div class="help-block">  {{ $errors->first('component_for') }}</div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div id="scrollable_div" class="form-group col-md-2">
                                    <label for="scrollable" class="">Scrollable</label>
                                    <select name="scrollable" class="form-control custom-select"
                                            id="scrollable" required data-validation-required-message="Please select component is scrollable or not">
                                        <option value="" >--Select Tab Section--</option>
                                        <option value="1" {{ (isset($slider->scrollable) && $slider->scrollable == 1) ? 'selected' : '' }}>True</option>
                                        <option value="0" {{ (isset($slider->scrollable) && $slider->scrollable == 0) ? 'selected' : '' }}>False</option>

                                    </select>
                                    @if($errors->has('scrollable'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('scrollable') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-2 mb-2">
                                    <label for="is_title_show">Is Title Show: </label>
                                    <div class="form-group {{ $errors->has('is_title_show') ? ' error' : '' }}">
                                        <input type="radio" name="is_title_show" value="1" id="true" {{$slider->is_title_show == 1 ? 'checked' : ''}} />
                                        <label for="is_title_show" class="mr-3">True</label>
                                        <input type="radio" name="is_title_show" value="0" id="false" {{$slider->is_title_show == 0 ? 'checked' : ''}} />
                                        <label for="is_title_show" class="mr-3">False</label>

                                        @if ($errors->has('status'))
                                            <div class="help-block">  {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-2 mb-2">
                                    <label for="is_card">Is Card Show: </label>
                                    <div class="form-group {{ $errors->has('is_card') ? ' error' : '' }}">
                                        <input type="radio" name="is_card" value="1" id="true" {{$slider->is_card == 1 ? 'checked' : ''}} />
                                        <label for="is_card" class="mr-3">True</label>
                                        <input type="radio" name="is_card" value="0" id="false" {{$slider->is_card == 0 ? 'checked' : ''}} />
                                        <label for="is_card" class="mr-3">False</label>

                                        @if ($errors->has('is_card'))
                                            <div class="help-block">  {{ $errors->first('is_card') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                    <label for="title" class="">Android Version Code</label>
                                    <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code" value="{{ $slider->android_version_code }}">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('android_version_code'))
                                        <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                    <label for="title" class="">iOS Version Code</label>
                                    <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code" value="{{ $slider->ios_version_code }}">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('ios_version_code'))
                                        <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('redirection_button_en') ? ' error' : '' }}">
                                    <label for="title" class="">Redirection Button En</label>
                                    <input type="text" name="redirection_button_en"  class="form-control" placeholder="Enter Button Name En" value="{{ $slider->redirection_button_en }}">
                                    <div class="help-block"></div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirection_button_en'))
                                        <div class="help-block">  {{ $errors->first('redirection_button_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('redirection_button_bn') ? ' error' : '' }}">
                                    <label for="title" class="">Redirection Button Bn</label>
                                    <input type="text" name="redirection_button_bn"  class="form-control" placeholder="Enter Button Name Bn" value="{{ $slider->redirection_button_bn }}">
                                    <div class="help-block"></div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirection_button_bn'))
                                        <div class="help-block">  {{ $errors->first('redirection_button_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('redirection_button_deeplink') ? ' error' : '' }}">
                                    <label for="title" class="">Redirection Button Deeplink</label>
                                    <input type="text" name="redirection_button_deeplink"  class="form-control" placeholder="Enter  Deeplink" value="{{ $slider->redirection_button_deeplink }}">
                                    <div class="help-block"></div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('redirection_button_deeplink'))
                                        <div class="help-block">  {{ $errors->first('redirection_button_deeplink') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="required">Upload Icon :</label>
                                        @if (isset($slider->icon))
                                            <input
                                                type="file"
                                                id="icon"
                                                class="dropify"
                                                name="icon"
                                                data-height="70"
                                                data-allowed-formats="square"
                                                data-allowed-file-extensions="png"
                                                data-default-file="{{ asset($slider->icon) }}"
                                            />

                                            <input
                                                hidden
                                                type="text"
                                                id="icon-unchanged"
                                                class=""
                                                name="icon"
                                                data-height="70"
                                                data-allowed-formats="square"
                                                data-allowed-file-extensions="png"
                                                value="not-updated"
                                            />
                                        @else
                                            <input type="file"
                                               id="icon"
                                               name="icon"
                                               class="dropify"
                                               data-allowed-formats="square"
                                               data-allowed-file-extensions="png"
                                               data-height="70"/>
                                        @endif
                                        <div class="help-block">
                                            <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small class="text-info"> Shortcut icon should be in 1:1 aspect ratio</small>
                                        </div>
                                        <small id="massage"></small>
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
        $(document).ready(function () {

            let show = $('#component_type').val() == 'carousel'

            if(show) {
                $('#scrollable_div').show()
            } else {
                $('#scrollable_div').hide()
            }

            let dropify = $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Icon to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Icon file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });

            dropify.on('dropify.beforeClear', function(event, element) {
                $('#icon-unchanged').val('removed')
            });
        });

    </script>
@endpush
