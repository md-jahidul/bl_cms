@extends('layouts.admin')
@section('title', 'Non Bl Components List')
@section('card_name', 'Non Bl Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Create Group Components</strong></li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1 mb-0"><strong>Create Group</strong></h4>
                    <form role="form"
                            action="{{ route('group.components.store') }}"
                            method="POST"
                            class="form"
                            enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title_en" class="required">Title English</label>
                                <input class="form-control"
                                        name="title_en"
                                        id="title_en"
                                        placeholder="Enter English Title"
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
                                        required>
                                @if($errors->has('title_bn'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                    </p>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="member_1" class="required">Member 1</label>
                                <select name="member_1" class="form-control custom-select"
                                        id="component_size" required data-validation-required-message="Please select component ">
                                        
                                    <option value="" >--Select Tab Section--</option>
                                    @foreach ($components as $component)
                                    <option value="{{json_encode(['type' => $component['prefix'], 'id' => $component['id']])}}" >
                                        {{$component['prefix']}} - {{$component['title_en']}}
                                    </option>    
                                    @endforeach
                                    
                                    
                                    <!-- <option value="400x240" >4:2 400 x 240</option> -->
                                    
                                </select>
                                @if($errors->has('member_1'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('member_1') }}</small>
                                    </p>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="member_2" class="required">Member 2</label>
                                <select name="member_2" class="form-control custom-select"
                                        id="component_size" required data-validation-required-message="Please select component">
                                    
                                    <option value="" >--Select Tab Section--</option>
                                    @foreach ($components as $component)
                                    <option value="{{json_encode(['type' => $component['prefix'], 'id' => $component['id']])}}" >
                                        {{$component['prefix']}} - {{$component['title_en']}}
                                    </option>    
                                    @endforeach    
                                    
                                </select>
                                @if($errors->has('component_size'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('member_2') }}</small>
                                    </p>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="start_time" class="required">Start time</label>
                                <input class="form-control"
                                        name="start_time"
                                        id="start_time"
                                        placeholder="Enter Start Time"
                                        type="datetime-local"
                                        required>
                                @if($errors->has('start_time'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('start_time') }}</small>
                                    </p>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="end_time" class="required">End time</label>
                                <input class="form-control"
                                        name="end_time"
                                        id="end_time"
                                        placeholder="Enter End Time"
                                        type="datetime-local"
                                        required>
                                @if($errors->has('end_time'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('end_time') }}</small>
                                    </p>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label class="required" for="status_input">Component For: </label>
                                <div class="form-group {{ $errors->has('component_for') ? ' error' : '' }}">
                                    <input required type="radio" name="component_for" value="commerce" id="campaignStatusActive"
                                        {{ (isset($single_slider->component_for) && $single_slider->component_for == 'commerce') ? 'checked' : '' }}>
                                    <label for="campaignStatusActive" class="mr-3">Commerce</label>
                                    <input required type="radio" name="component_for" value="content" id="campaignStatusActive"
                                        {{ (isset($single_slider->component_for) && $single_slider->component_for == 'content') ? 'checked' : '' }}>
                                    <label for="campaignStatusActive" class="mr-3">Content</label>
                                    <input required type="radio" name="component_for" value="home" id="campaignStatusInactive"
                                        {{ (isset($single_slider->component_for) && $single_slider->component_for == 'home') ? 'checked' : '' }}>
                                    <label for="campaignStatusInactive" class="mr-3">Home</label>
                                    <input required type="radio" name="component_for" value="non_bl" id="campaignStatusInactive"
                                        {{ (isset($single_slider->component_for) && $single_slider->component_for == 'non_bl') ? 'checked' : '' }}>
                                    <label for="campaignStatusInactive" class="mr-3">Non Bl</label>
                                    <input required type="radio" name="component_for" value="non_bl_offer" id="campaignStatusInactive"
                                        {{ (isset($single_slider->component_for) && $single_slider->component_for == 'non_bl_offer') ? 'checked' : '' }}>
                                    <label for="campaignStatusInactive" class="mr-3">Non Bl Offer</label>
                                    @if ($errors->has('component_for'))
                                        <div class="help-block">  {{ $errors->first('component_for') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label class="required" for="active_status">Status: </label>
                                <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                    <input required type="radio" name="active" value="1" id="groupComponentStatusActive"/>
                                    <label for="campaignStatusActive" class="mr-3">Active</label>
                                    <input required type="radio" name="active" value="0" id="groupComponentStatusInactive"/>
                                    <label for="campaignStatusActive" class="mr-3">Inactive</label>
                                    
                                    @if ($errors->has('status'))
                                        <div class="help-block">  {{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="required">Upload Icon :</label>                                        
                                        <input type="file" required
                                               id="icon"
                                               name="icon"
                                               class="dropify_image"
                                               data-allowed-formats="square"
                                               data-allowed-file-extensions="png"
                                               data-height="70"/>
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
            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Logo to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Logo'
                },
                error: {
                    'imageFormat': 'The logo must be valid format'
                }
            });
        });
    </script>
@endpush
