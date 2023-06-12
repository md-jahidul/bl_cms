@extends('layouts.admin')
@section('title', 'Create Team')
@section('card_name', 'Create Team')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create Team</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('teams.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="team_name" class="required">Team Name</label>
                                    <input class="form-control"
                                           name="team_name"
                                           id="team_name"
                                           placeholder="Enter Team Name"
                                           required>
                                    @if($errors->has('team_name'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('team_name') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="group_name" class="required">Group Name</label>
                                    <input class="form-control"
                                           name="group_name"
                                           id="group_name"
                                           placeholder="Enter Group Name"
                                           required>
                                    @if($errors->has('group_name'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('group_name') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div id="image-input" class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="logo">Upload Logo</label>
                                        <input required type="file" id="team_flag" name="team_flag" class="dropify_image"
                                               data-allowed-file-extensions="png jpg gif"/>team
                                        <small class="text-danger"> @error('team_flag') {{ $message }} @enderror </small>
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
