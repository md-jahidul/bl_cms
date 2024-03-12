@extends('layouts.admin')
@section('title', 'Edit Veon Adtech')
@section('card_name', 'Edit Veon Adtech')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ url('veon-adtech') }}">Veon Adtech List</a>
    </li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('veon-adtech.update', $slider->id) }}"
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

                                        @foreach (Config::get('generic-slider.ad_inventory_size') as $key => $size)
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
                                <div class="form-group col-md-6">
                                    <label for="title_bn" class="required">Ad Unit Id</label>
                                    <input class="form-control"
                                           name="ad_unit_id"
                                           id="ad_unit_id"
                                           placeholder="Enter Unit Id."
                                           value="{{ $slider->ad_unit_id }}"
                                           required>
                                    @if($errors->has('ad_unit_id'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('ad_unit_id') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <input type="hidden" name="type" value="ad_inventory">
                                <div class="col-md-6">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="ft-save"></i> Save
                                    </button>
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
