@extends('layouts.admin')
@section('title', 'Popup Banner Create')
@section('card_name', 'Popup Banner Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('popup-banner.index') }}">Popup Banner List</a></li>
{{--    @if($parent_id != 0)--}}
{{--        <li class="breadcrumb-item active">--}}
{{--            <a href="{{ ($parent_id == 0) ? url('mybl-menu') : url("mybl-menu/$parent_id/child-menu") }}">{{ $parentMenu->title_en }}</a>--}}
{{--        </li>--}}
{{--    @endif--}}

    <li class="breadcrumb-item active">Create</li>
@endsection
@section('action')
    <a href="{{ route('popup-banner.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                            action="{{ route('popup-banner.store') }}"
                            method="POST" novalidate enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="required">Banner Image</label>
                                    <input type="file"
                                            name="banner_data"
                                            data-max-file-size="2M"
                                            {{-- data-allowed-formats="portrait square" --}}
                                            data-allowed-file-extensions="jpeg png jpg"
                                            class="dropify"/>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('deeplink') ? ' error' : '' }}">
                                        <label for="title" class="required">Deep Link</label>
                                        <input type="text" name="deeplink"  class="form-control" placeholder="Enter Deep Link"
                                                value="{{ old("deeplink") ? old("deeplink") : '' }}" required data-validation-required-message="Enter menu english label">
                                        <div class="help-block"></div>
                                        @if ($errors->has('deeplink'))
                                            <div class="help-block">  {{ $errors->first('deeplink') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('is_priority') ? ' error' : '' }}">
                                            <label for="title" class="required mr-1">Is Priority ?:</label>

                                            <input type="radio" name="is_priority" value="1" id="input-radio-17" checked>
                                            <label for="input-radio-17" class="mr-1">Yes</label>

                                            <input type="radio" name="is_priority" value="0" id="input-radio-18">
                                            <label for="input-radio-18">No</label>

                                            @if ($errors->has('is_priority'))
                                                <div class="help-block">  {{ $errors->first('is_priority') }}</div>
                                            @endif
                                        </div>
                                     </div>
                                    <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                        <label for="title" class="required">Android Version Code</label>
                                        <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code"
                                               required data-validation-required-message="Enter Version Code">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('android_version_code'))
                                            <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                        <label for="title" class="required">iOS Version Code</label>
                                        <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code"
                                               required data-validation-required-message="Enter Version Code">
                                        <div class="help-block"></div>
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                        <div class="help-block"></div>
                                        @if ($errors->has('ios_version_code'))
                                            <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                        <label for="start_date">Start Date</label>
                                        <div class='input-group'>
                                            <input type='text' class="form-control" name="start_date" id="start_date"
                                                   placeholder="Please select start date"/>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('start_date'))
                                            <div class="help-block">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                        <label for="end_date">End Date</label>
                                        <input type="text" name="end_date" id="end_date" class="form-control"
                                               placeholder="Please select end date"
                                               value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="off">
                                        <div class="help-block"></div>
                                        @if ($errors->has('end_date'))
                                            <div class="help-block">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> SAVE</button>
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
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>
{{--    <script>--}}
{{--        $(function () {--}}
{{--            var externalLink = $('#externalLink');--}}
{{--            $('#external_link').click(function () {--}}
{{--                if($(this).prop("checked") == true){--}}
{{--                    externalLink.removeClass('d-none');--}}
{{--                }else{--}}
{{--                    externalLink.addClass('d-none')--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

        })
    </script>
@endpush







