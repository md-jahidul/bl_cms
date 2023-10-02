@extends('layouts.admin')
@section('title', 'Popup Sequence')
@section('card_name', 'Popup Sequence')
@section('breadcrumb')
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{route('popup-sequence.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf @method('POST')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="required">New Campaign :
                                        </label>
                                        <div class="controls">
                                            <input type='text' class="form-control" name="campaign" id="campaign"
                                                   value="{{ $campaign }}"
                                                   placeholder="Please Enter Campaign Sequence" required />
                                        </div>
                                    </div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Enter The Sequence with comma-separated value</span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="required">Banner :
                                        </label>
                                        <div class="controls">
                                            <input type='text' class="form-control" name="banner" id="banner"
                                                   value="{{ $banner }}"
                                                   placeholder="Please Enter Banner Sequence" required />
                                        </div>
                                    </div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Enter The Sequence with comma-separated value</span>
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
@endpush
