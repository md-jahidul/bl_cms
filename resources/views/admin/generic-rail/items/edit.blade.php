@extends('layouts.admin')
@section('title', 'Item')
@section('card_name', 'Edit Item Info')

@section('action')
    <a href="{{route('generic-rail.items.index', $itemData->generic_rail_id)}}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row"
                              action="{{ route('generic-rail-items.update', $itemData->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" hidden value="{{$itemData->id}}" name="id">
                            <div class="form-group col-md-12">
                                <div class="form-group {{ $errors->has('user_type') ? ' error' : '' }}">

                                    <input type="radio" name="user_type" value="all" id="input-radio-15" {{ $itemData->user_type == 'all'? 'checked': '' }}>
                                    <label for="input-radio-15" class="mr-3">All</label>
                                    <input type="radio" name="user_type" value="prepaid" id="input-radio-16" {{ $itemData->user_type == 'prepaid'? 'checked': '' }}>
                                    <label for="input-radio-16" class="mr-3">Prepaid</label>
                                    <input type="radio" name="user_type" value="postpaid" id="input-radio-17" {{ $itemData->user_type == 'postpaid'? 'checked': '' }}>
                                    <label for="input-radio-17" class="mr-3">Postpaid</label>

                                    @if ($errors->has('user_type'))
                                        <div class="help-block">  {{ $errors->first('user_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_en" class="required">Title English</label>
                                <input class="form-control"
                                       name="title_en"
                                       id="title_en"
                                       placeholder="Enter English Title"
                                       value="{{ $itemData->title_en }}"
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
                                       value="{{ $itemData->title_bn }}"
                                       placeholder="Enter Bangla Title"
                                       required>
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }}">
                                <label for="title" class="">Icon</label>
                                <input type="text" name="icon"  class="form-control" placeholder="Enter Icon URL." value="{{ $itemData->icon }}">
                                @if ($errors->has('icon'))
                                    <div class="help-block">  {{ $errors->first('icon') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="deeplink">Deeplink</label>
                                <input class="form-control"
                                       name="deeplink"
                                       id="deeplink"
                                       placeholder="Enter deeplink"
                                       value="{{ $itemData->deeplink }}"
                                >
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                <label for="title" class="">Android Version Code</label>
                                <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code" value="{{ $itemData->android_version_code }}">
                                <div class="help-block"></div>
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                <div class="help-block"></div>
                                @if ($errors->has('android_version_code'))
                                    <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                <label for="title" class="">iOS Version Code</label>
                                <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code" value = "{{ $itemData->ios_version_code }}">
                                <div class="help-block"></div>
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                <div class="help-block"></div>
                                @if ($errors->has('ios_version_code'))
                                    <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                @endif
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($itemData->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($itemData->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="status">Highlight:</label>
                                    <select
                                        class="form-control" id="is_highlight"
                                        name="is_highlight">
                                        <option value="1"
                                                @if($itemData->is_highlight == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($itemData->is_highlight == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="action_div">
                                @php
                                    $actionList = Helper::navigationActionList();
                                @endphp

                                <div class="form-group">
                                    <label>Component Identifier</label>
                                    <select name="component_identifier" class="browser-default custom-select"
                                            id="component_identifier">
                                        <option value="">Select Action</option>
                                        @foreach ($actionList as $key => $value)
                                            <option
                                                @if(isset($itemData->component_identifier) && $itemData->component_identifier == $key)
                                                    selected
                                                @endif
                                                value="{{ $key }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button style="float: right" type="submit" id="submitForm"
                                        class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@push('style')

@endpush

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
        $(function () {
        });


    </script>

@endpush
