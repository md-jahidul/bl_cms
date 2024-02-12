@extends('layouts.admin')
@section('title', 'Create  Component')
@section('card_name', 'Create Component')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create {{ $routeObj['componentName'] }} Component</li>
@endsection
@section('action')
    <a href="{{ route($routeObj['index']) }}" class="btn btn-info btn-sm btn-glow px-2">
        Back To {{ $routeObj['componentName'] }} Component
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route($routeObj['update'], $componentData['id']) }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <input type="hidden" name="id" value="{{ $componentData['id'] }}">

                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title" class="required">Title EN</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                           required data-validation-required-message="Enter footer menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title" class="required">Title BN</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                           required data-validation-required-message="Enter label in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                    <label for="title" class="required">Android Version Code</label>
                                    <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code"
                                           required data-validation-required-message="Enter Version Code" value="0-999999999">
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
                                           required data-validation-required-message="Enter Version Code" value="0-999999999">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('ios_version_code'))
                                        <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">User Can Enable/Disable:</label> <br>
                                        <input type="radio" name="is_eligible" value="1" id="active">
                                        <label for="active" class="mr-1">Yes</label>

                                        <input type="radio" name="is_eligible" value="0" id="inactive" checked>
                                        <label for="inactive">No</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status: </label> <br>

                                        <input type="radio" name="is_api_call_enable" value="1" id="can_enable_yes" >
                                        <label for="can_enable_yes" class="mr-1">Enable</label>

                                        <input type="radio" name="is_api_call_enable" value="0" id="can_disable_no" checked>
                                        <label for="can_disable_no">Disable</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="is_title_show" class="required mr-1">Is Title Show:</label> <br>
                                        <input type="radio" name="is_title_show" value="1" id="is_title_show_active" >
                                        <label for="active" class="mr-1">Yes</label>
                                        <input type="radio" name="is_title_show" value="0" id="is_title_show_inactive" checked>
                                        <label for="inactive">No</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cta_name_en">Cta Name EN</label>
                                    <input type="text" name="cta_name_en" id="cta_name_en" class="form-control"
                                           placeholder="Enter Cta Name En.">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cta_name_en">Cta Name BN</label>
                                    <input type="text" name="cta_name_bn" id="cta_name_bn" class="form-control"
                                           placeholder="Enter Cta Name Bn." >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="deeplink">Deeplink</label>
                                    <input type="text" name="deeplink" id="deeplink" class="form-control"
                                           placeholder="Enter Deeplink URL.">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="icon">icon</label>
                                    <input type="text" name="icon" id="icon" class="form-control"
                                           placeholder="Enter Icon URL.">
                                </div>

                                <div class="col-md-6">
                                    <label>Childes </label>
                                    <select multiple class="w-100 select2 childes" name="child_ids[]" style="width: 100%">
                                        <option value="">Select a option</option>
                                        @foreach ($candidateChildes as $key => $child)
                                            <option value="{{ $child['id'] }}">  {{$child['title_en']}}  </option>
                                        @endforeach
                                    </select>
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
        $(function () {
            $('.childes').select2({
                placeholder: 'Please Select Childes.',
                maximumSelectionLength: 4
            });
        });
    </script>
@endpush

