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
                                            {{ (isset($slider->component_for) && $slider->component_for == 'home') ? 'checked' : '' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">Home</label>
                                        <input type="radio" name="component_for" value="non_bl" id="campaignStatusInactive"
                                            {{ (isset($slider->component_for) && $slider->component_for == 'non_bl') ? 'checked' : '' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">Non Bl</label>
                                        <input type="radio" name="component_for" value="non_bl_offer" id="campaignStatusInactive"
                                            {{ (isset($slider->component_for) && $slider->component_for == 'non_bl_offer') ? 'checked' : '' }} disabled>
                                        <label for="campaignStatusInactive" class="mr-3">Non Bl Offer</label>
                                        @if ($errors->has('component_for'))
                                            <div class="help-block">  {{ $errors->first('component_for') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div id="scrollable_div" class="form-group col-md-6">
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

                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="required">Upload Icon :</label>
                                        @if (isset($slider->icon))
                                            <input disabled 
                                                type="file"
                                                id="icon"
                                                class="dropify"
                                                name="icon"
                                                data-height="70"
                                                data-allowed-formats="square"
                                                data-allowed-file-extensions="png"
                                                data-default-file="{{ asset($slider->icon) }}"
                                            />
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
            

            $('.dropify').dropify({
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
        });
    </script>
@endpush
