@extends('layouts.admin')
@section('title', 'Create Bill Utility')
@section('card_name', 'Create Bill Utility')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create Bill Utility</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('utility-bill.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title_en" class="required">Bill Utility Title EN</label>
                                    <input class="form-control"
                                           name="title_en"
                                           id="title_en"
                                           placeholder="Bill utility Title"
                                           required>
                                    @if($errors->has('title_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title_bn" class="required">Bill utility Title BN</label>
                                    <input class="form-control"
                                           name="title_bn"
                                           id="title_bn"
                                           placeholder="Enter Utility Name"
                                           required>
                                    @if($errors->has('title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" >Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="image-input" class="form-group col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="icon">Upload Icon</label>
                                        <input type="file" id="icon" name="icon" class="dropify_image"
                                               data-allowed-file-extensions="png jpg gif"/>
                                        {{--                                        <div class="help-block text-warning">--}}
                                        {{--                                            The Dimensions should be <strong>200x200</strong>--}}
                                        {{--                                        </div>--}}
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="message"></small>
                                    </div>
                                </div>

{{--                                <div class="col-md-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="user_type" class="required mr-1">User Type:</label>--}}

{{--                                        <input type="radio" name="user_type" value="all" checked>--}}
{{--                                        <label for="user_type" class="mr-1">All</label>--}}

{{--                                        <input type="radio" name="user_type" value="prepaid">--}}
{{--                                        <label for="user_type">Prepaid</label>--}}

{{--                                        <input type="radio" name="user_type" value="postpaid">--}}
{{--                                        <label for="user_type">Postpaid</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
