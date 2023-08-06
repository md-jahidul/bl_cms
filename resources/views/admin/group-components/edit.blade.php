@extends('layouts.admin')
@section('title', 'Group Components List')
@section('card_name', 'Group Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Edit Group Components</strong></li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1 mb-0"><strong>Edit Group</strong></h4>
                    <form role="form"
                            action="{{ route('group.components.update', $component['id']) }}"
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
                                        value="{{$component->title_en}}"
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
                                        value="{{$component->title_bn}}"
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
                                    @foreach ($components as $item)
                                    <option {{($component->member_1_type == $item['prefix'] && $component->member_1_id == $item['id']) ? 'selected' : ''}}
                                    value="{{json_encode(['type' => $item['prefix'], 'id' => $item['id']])}}" >
                                        {{$item['prefix']}} - {{$item['title_en']}}
                                    </option>
                                    @endforeach

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
                                    @foreach ($components as $item)
                                    <option {{($component->member_2_type == $item['prefix'] && $component->member_2_id == $item['id']) ? 'selected' : ''}}
                                    value="{{json_encode(['type' => $item['prefix'], 'id' => $item['id']])}}" >
                                        {{$item['prefix']}} - {{$item['title_en']}}
                                    </option>
                                    @endforeach

                                </select>
                                @if($errors->has('member_2'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('member_2') }}</small>
                                    </p>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                <label for="end_date">Start Time</label>
                                <input type="text" class="form-control" name="start_time" id="start_date"
                                       placeholder="Please select end date"
                                       value="{{$component->start_time}}">
                                <div class="help-block"></div>
                                @if ($errors->has('end_date'))
                                    <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                <label for="end_date">End Time</label>
                                <input type="text" class="form-control" name="end_time" id="end_date"
                                       placeholder="Please select end date"
                                       value="{{$component->end_time}}">
                                <div class="help-block"></div>
                                @if ($errors->has('end_date'))
                                    <div class="help-block">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="status_input">Component For: </label>
                                <div class="form-group {{ $errors->has('component_for') ? ' error' : '' }}">
                                    <input disabled type="radio" name="component_for" value="commerce" id="campaignStatusActive"
                                        {{ (isset($component->component_for) && $component->component_for == 'commerce') ? 'checked' : '' }}/>
                                    <label for="campaignStatusActive" class="mr-3">Commerce</label>
                                    <input disabled type="radio" name="component_for" value="content" id="campaignStatusActive"
                                        {{ (isset($component->component_for) && $component->component_for == 'content') ? 'checked' : '' }}/>
                                    <label for="campaignStatusActive" class="mr-3">Content</label>
                                    <input disabled type="radio" name="component_for" value="home" id="campaignStatusInactive"
                                        {{ (isset($component->component_for) && $component->component_for == 'home') ? 'checked' : '' }}/>
                                    <label for="campaignStatusInactive" class="mr-3">Home</label>
                                    <input disabled type="radio" name="component_for" value="non_bl" id="campaignStatusInactive"
                                        {{ (isset($component->component_for) && $component->component_for == 'non_bl') ? 'checked' : '' }}/>
                                    <label for="campaignStatusInactive" class="mr-3">Non Bl</label>
                                    <input disabled type="radio" name="component_for" value="non_bl_offer" id="campaignStatusInactive"
                                        {{ (isset($component->component_for) && $component->component_for == 'non_bl_offer') ? 'checked' : '' }}/>
                                    <label for="campaignStatusInactive" class="mr-3">Non Bl Offer</label>
                                    @if ($errors->has('component_for'))
                                        <div class="help-block">  {{ $errors->first('component_for') }}</div>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="component_for" id="" value="{{$component->component_for}}">

                            <div class="form-group col-md-3 mb-2">
                                <label for="active_status">Status: </label>
                                <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                    <input type="radio" name="active" value="1" id="groupComponentStatusActive" {{$component->active == 1 ? 'checked' : ''}} />
                                    <label for="campaignStatusActive" class="mr-3">Active</label>
                                    <input type="radio" name="active" value="0" id="groupComponentStatusInactive" {{$component->active == 0 ? 'checked' : ''}} />
                                    <label for="campaignStatusActive" class="mr-3">Inactive</label>

                                    @if ($errors->has('status'))
                                        <div class="help-block">  {{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-3 mb-2">
                                <label for="is_title_show">Is Title Show: </label>
                                <div class="form-group {{ $errors->has('is_title_show') ? ' error' : '' }}">
                                    <input type="radio" name="is_title_show" value="1" id="true" {{$component->is_title_show == 1 ? 'checked' : ''}} />
                                    <label for="is_title_show" class="mr-3">True</label>
                                    <input type="radio" name="is_title_show" value="0" id="false" {{$component->is_title_show == 0 ? 'checked' : ''}} />
                                    <label for="is_title_show" class="mr-3">False</label>

                                    @if ($errors->has('status'))
                                        <div class="help-block">  {{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="image">Upload Icon :</label>
                                        @if (isset($component->icon))
                                            <input type="file"
                                                id="icon"
                                                class="dropify_image"
                                                name="icon"
                                                data-height="70"
                                                data-allowed-formats="square"
                                                data-allowed-file-extensions="png"
                                                data-default-file="{{ asset($component->icon) }}"
                                            />
                                        @else
                                            <input type="file"
                                               id="icon"
                                               name="icon"
                                               class="dropify_image"
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
                                <i class="ft-save"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script>
        $(document).ready(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#start_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
            });
            $('#end_date').datetimepicker({
                format : 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false, //Important! See issue #1075
                showClose: true,

            });

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
