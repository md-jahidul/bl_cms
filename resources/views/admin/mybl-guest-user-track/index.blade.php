@extends('layouts.admin')
@section('title', 'Guest User Analytics')
@section('card_name', 'Guest User Analytics')
@section('breadcrumb')
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <h4 class="content-header-title mb-0 d-inline-block">Guest User Access Log Report</h4>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">

                    <form action="{{route('guest-user-data-export')}}" id="filter-form" class="filter-container" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="date_range" class="form-control filter"
                                       autocomplete="off" id="date_range" placeholder="Date">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="msisdn" class="form-control filter"
                                       autocomplete="off" id="msisdn" placeholder="Msisdn">
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="msisdn_entry_type">
                                    <option value="">--Select Msisdn Input Type--</option>
                                    <option value="header_input">Automatic (Header)</option>
                                    <option value="user_input">User Input</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="device_id" class="form-control"
                                       autocomplete="off" id="device_id" placeholder="DeviceId">
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="platform" id="platform">
                                    <option value="">--Select Platform--</option>
                                    <option value="android">Android</option>
                                    <option value="ios">IOS</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="page_name">
                                    <option value="">--Select Page--</option>
                                    <option value="landing_page">Landing_page</option>
                                    <option value="otp_page">OTP Page</option>
                                    <option value="otp_send">OTP Send</option>
                                    <option value="password_login">Password Login</option>
                                    <option value="password_page">Password Page</option>
                                    <option value="forget_password_page">Forget Password Page</option>
                                    <option value="forget_password_send_otp">Forget Password Send OTP</option>
                                    <option value="set_new_password_page">Set New Password Page</option>
                                    <option value="change_password">Change Password</option>
                                    <option value="register_page">Register Page</option>
                                    <option value="send_otp_register">Send OTP Register</option>
                                    <option value="register_set_new_password_page">Register Set New Password Page</option>
                                    <option value="register_password_set">Register Password Set</option>
                                    <option value="number_verification">Number Verification</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="status" id="status">
                                    <option value="">--Select Status--</option>
                                    <option value="1">Success</option>
                                    <option value="0">Failed</option>
                                </select>
                            </div>

                            <div class="col-md-12 ">
                                <div class="pull-right">
                                    <button type="submit" name="export_type" value="csv" class="btn btn-primary"><i
                                            class="la la-file"></i> CSV
                                    </button>
                                    <button type="submit" name="export_type" value="xlsx" class="btn btn-warning"><i
                                            class="la la-file-excel-o"></i> Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + '-' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endpush





