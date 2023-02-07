@extends('layouts.admin')
@section('title', 'Fifa Content')
@section('card_name', 'Fifa Content')
@section('breadcrumb')
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{route('fifa-content.update') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf @method('POST')
                            <div class="row">

                                <div id="image-input" class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="image">Upload Image</label>
                                        <input type="file" id="image" name="image" class="dropify_image"
                                               data-default-file="{{  isset($content->image) ? asset($content->image) : "" }}"
                                               data-allowed-file-extensions="png jpg gif"/>
                                        <small class="text-danger"> @error('image') {{ $message }} @enderror </small>
                                        <small id="message"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> {{isset($content->id) ? "Update" : "Save"}}
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
