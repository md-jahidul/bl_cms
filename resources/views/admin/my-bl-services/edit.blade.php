@extends('layouts.admin')
@section('title', 'Edit Service')
@section('card_name', 'Edit Service')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ url('my-bl-services') }}">Services List</a>
    </li>
    <li class="breadcrumb-item active">Edit Service</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('my-bl-services.update', $service->id) }}"
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
                                           value="{{ $service->title_en }}"
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
                                           value="{{ $service->title_bn }}"
                                           required>
                                    @if($errors->has('title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>


                                {{--                                <div class="form-group col-md-6">--}}
                                {{--                                    <label for="component_size" class="required">Component Size</label>--}}
                                {{--                                    <select disabled name="component_size" class="form-control custom-select"--}}
                                {{--                                            id="component_size" required data-validation-required-message="Please select component size">--}}
                                {{--                                        <option value="" >--Select Tab Section--</option>--}}

                                {{--                                        @foreach (Config::get('generic-slider.component_size') as $key => $size)--}}
                                {{--                                            <option value="{{$key}}" {{ (isset($service->component_size) && $service->component_size == $key) ? 'selected' : '' }} >{{$size}}</option>--}}
                                {{--                                        @endforeach--}}

                                {{--                                    </select>--}}
                                {{--                                    @if($errors->has('component_size'))--}}
                                {{--                                        <p class="text-left">--}}
                                {{--                                            <small class="danger text-muted">{{ $errors->first('component_size') }}</small>--}}
                                {{--                                        </p>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group col-md-6">--}}
                                {{--                                    <label for="component_type" class="required">Component Type</label>--}}
                                {{--                                    <select disabled name="component_type" class="form-control custom-select"--}}
                                {{--                                            id="component_type" required data-validation-required-message="Please select component type">--}}
                                {{--                                        <option value="" >--Select Tab Section--</option>--}}
                                {{--                                        @foreach (Config::get('generic-service.component_type') as $key => $type)--}}
                                {{--                                            <option value="{{$key}}" {{ (isset($service->component_type) && $service->component_type == $key) ? 'selected' : '' }} >{{ucfirst($type)}}</option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                    @if($errors->has('component_type'))--}}
                                {{--                                        <p class="text-left">--}}
                                {{--                                            <small class="danger text-muted">{{ $errors->first('component_type') }}</small>--}}
                                {{--                                        </p>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group col-md-6">--}}
                                {{--                                    <input type="hidden" name = "component_for" value="{{ $service->component_for }}">--}}
                                {{--                                    <label for="component_for" class="required">Component For</label>--}}
                                {{--                                    <select disabled name="component_for" class="form-control custom-select"--}}
                                {{--                                            id="component_for" required data-validation-required-message="Please select component For">--}}
                                {{--                                        <option value="" >--Select Tab Section--</option>--}}
                                {{--                                        @foreach (Config::get('generic-slider.component_for') as $key => $type)--}}
                                {{--                                            <option value="{{$key}}" {{ (isset($service->component_for) && $service->component_for == $key) ? 'selected' : '' }} >{{$type}}</option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                    @if($errors->has('component_for'))--}}
                                {{--                                        <p class="text-left">--}}
                                {{--                                            <small class="danger text-muted">{{ $errors->first('component_for') }}</small>--}}
                                {{--                                        </p>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}

                                {{--                                                                <div class="form-group col-md-6 mb-2">--}}
                                {{--                                                                    <label for="status_input">Component For: </label>--}}
                                {{--                                                                    <div class="form-group {{ $errors->has('component_for') ? ' error' : '' }}">--}}
                                {{--                                                                        <input type="radio" name="component_for" value="commerce" id="campaignStatusActive"--}}
                                {{--                                                                            {{ (isset($service->component_for) && $service->component_for == 'commerce') ? 'checked' : '' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusActive" class="mr-3">Commerce</label>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="content" id="campaignStatusActive"--}}
                                {{--                                                                            {{ (isset($service->component_for) && $service->component_for == 'content') ? 'checked' : '' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusActive" class="mr-3">Content</label>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="home" id="campaignStatusInactive"--}}
                                {{--                                                                            {{ (isset($service->component_for) && $service->component_for == 'home') ? 'checked' : '' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">Home</label>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="lms" id="campaignStatusInactive"--}}
                                {{--                                                                            {{ (isset($service->component_for) && $service->component_for == 'lms') ? 'checked' : '' }}--}}
                                {{--                                                                            {{ isset($service->component_for) ? '' : 'checked' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">LMS</label>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="non_bl" id="campaignStatusInactive"--}}
                                {{--                                                                            {{ (isset($service->component_for) && $service->component_for == 'non_bl') ? 'checked' : '' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">Non Bl</label>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="non_bl_offer" id="campaignStatusInactive"--}}
                                {{--                                                                            {{ (isset($service->component_for) && $service->component_for == 'non_bl_offer') ? 'checked' : '' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">Non Bl Offer</label>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">LMS</label> <br>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="toffee" id="campaignStatusInactive"--}}
                                {{--                                                                               {{ (isset($service->component_for) && $service->component_for == 'toffee') ? 'checked' : '' }}--}}
                                {{--                                                                               {{ isset($service->component_for) ? '' : 'checked' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">Toffee Home</label>--}}
                                {{--                                                                        <input type="radio" name="component_for" value="toffee_section" id="campaignStatusInactive"--}}
                                {{--                                                                               {{ (isset($service->component_for) && $service->component_for == 'toffee_section') ? 'checked' : '' }}--}}
                                {{--                                                                               {{ isset($service->component_for) ? '' : 'checked' }} disabled>--}}
                                {{--                                                                        <label for="campaignStatusInactive" class="mr-3">Toffee Section</label>--}}
                                {{--                                                                        @if ($errors->has('component_for'))--}}
                                {{--                                                                            <div class="help-block">  {{ $errors->first('component_for') }}</div>--}}
                                {{--                                                                        @endif--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                </div>--}}

                                {{--                                <div id="scrollable_div" class="form-group col-md-3">--}}
                                {{--                                    <label for="scrollable" class="">Scrollable</label>--}}
                                {{--                                    <select name="scrollable" class="form-control custom-select"--}}
                                {{--                                            id="scrollable" required data-validation-required-message="Please select component is scrollable or not">--}}
                                {{--                                        <option value="" >--Select Tab Section--</option>--}}
                                {{--                                        <option value="1" {{ (isset($service->scrollable) && $service->scrollable == 1) ? 'selected' : '' }}>True</option>--}}
                                {{--                                        <option value="0" {{ (isset($service->scrollable) && $service->scrollable == 0) ? 'selected' : '' }}>False</option>--}}

                                {{--                                    </select>--}}
                                {{--                                    @if($errors->has('scrollable'))--}}
                                {{--                                        <p class="text-left">--}}
                                {{--                                            <small class="danger text-muted">{{ $errors->first('scrollable') }}</small>--}}
                                {{--                                        </p>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}
                                <div class="form-group col-md-3 mb-2">
                                    <label for="is_title_show">Is Title Show: </label>
                                    <div class="form-group {{ $errors->has('is_title_show') ? ' error' : '' }}">
                                        <input type="radio" name="is_title_show" value="1"
                                               id="true" {{$service->is_title_show == 1 ? 'checked' : ''}} />
                                        <label for="is_title_show" class="mr-3">True</label>
                                        <input type="radio" name="is_title_show" value="0"
                                               id="false" {{$service->is_title_show == 0 ? 'checked' : ''}} />
                                        <label for="is_title_show" class="mr-3">False</label>

                                        @if ($errors->has('status'))
                                            <div class="help-block">  {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-3 mb-2">
                                    <label class="required" for="status">Status: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input required type="radio" name="status" value="1"
                                               id="true" {{$service->status == 1 ? 'checked' : ''}}/>
                                        <label for="status" class="mr-3">True</label>
                                        <input required type="radio" name="status" value="0"
                                               id="true" {{$service->status == 0 ? 'checked' : ''}}/>
                                        <label for="status" class="mr-3">False</label>

                                        @if ($errors->has('status'))
                                            <div class="help-block">  {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                    <label for="title" class="">Android Version Code</label>
                                    <input type="text" name="android_version_code" class="form-control"
                                           placeholder="Enter Version Code"
                                           value="{{ $service->android_version_code }}">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('android_version_code'))
                                        <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                    <label for="title" class="">iOS Version Code</label>
                                    <input type="text" name="ios_version_code" class="form-control"
                                           placeholder="Enter Version Code" value="{{ $service->ios_version_code }}">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('ios_version_code'))
                                        <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                    @endif
                                </div>
                                {{--                                <div class="form-group col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="image" class="required">Upload Icon :</label>--}}
                                {{--                                        @if (isset($service->icon))--}}
                                {{--                                            <input--}}
                                {{--                                                    type="file"--}}
                                {{--                                                    id="icon"--}}
                                {{--                                                    class="dropify"--}}
                                {{--                                                    name="icon"--}}
                                {{--                                                    data-height="70"--}}
                                {{--                                                    data-allowed-formats="square"--}}
                                {{--                                                    data-allowed-file-extensions="png"--}}
                                {{--                                                    data-default-file="{{ asset($service->icon) }}"--}}
                                {{--                                            />--}}

                                {{--                                            <input--}}
                                {{--                                                    hidden--}}
                                {{--                                                    type="text"--}}
                                {{--                                                    id="icon-unchanged"--}}
                                {{--                                                    class=""--}}
                                {{--                                                    name="icon"--}}
                                {{--                                                    data-height="70"--}}
                                {{--                                                    data-allowed-formats="square"--}}
                                {{--                                                    data-allowed-file-extensions="png"--}}
                                {{--                                                    value="not-updated"--}}
                                {{--                                            />--}}
                                {{--                                        @else--}}
                                {{--                                            <input type="file"--}}
                                {{--                                                   id="icon"--}}
                                {{--                                                   name="icon"--}}
                                {{--                                                   class="dropify"--}}
                                {{--                                                   data-allowed-formats="square"--}}
                                {{--                                                   data-allowed-file-extensions="png"--}}
                                {{--                                                   data-height="70"/>--}}
                                {{--                                        @endif--}}
                                {{--                                        <div class="help-block">--}}
                                {{--                                            <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>--}}
                                {{--                                            <small class="text-info"> Shortcut icon should be in 1:1 aspect--}}
                                {{--                                                ratio</small>--}}
                                {{--                                        </div>--}}
                                {{--                                        <small id="massage"></small>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Icon :</label>
                                        <input
                                                {{--                                                maxlength="200"--}}
                                                {{--                                                data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"--}}
                                                {{--                                                data-validation-required-message="Title is required"--}}
                                                {{--                                                data-validation-regex-message="Title must start with alphabets"--}}
                                                {{--                                                data-validation-maxlength-message="Title can not be more then 200 Characters"--}}
                                                {{--                                            value="@if(old('image_url')) {{old('image_url')}} @endif" required--}}
                                                value="{{old('icon')?old('icon'):$service->icon}}"
                                                required
                                                id="icon"
                                                type="text"
                                                class="form-control @error('icon') is-invalid @enderror"
                                                placeholder="Icon URL" name="icon">
                                        <small
                                                class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="message"></small>
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

            if (show) {
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

            dropify.on('dropify.beforeClear', function (event, element) {
                $('#icon-unchanged').val('removed')
            });
        });

    </script>
@endpush
