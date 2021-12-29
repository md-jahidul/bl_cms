@extends('layouts.admin')
@section('title', 'Developer Panel')
@section('card_name', 'Debug Panel')

@section('content')
    <section>
        <div class="row">
            <div class="col-md-4 mb-2 pull-right">
                <div class="project-search">
                    <div class="project-search-content">
                        <div class="position-relative">
                            <input type="text" class="form-control" name="search" id="search_input"
                                   placeholder="Search By Mobile Number e.g 01933332121211">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-icon btn-info" id="search_btn"><i class="la la-search"></i>
                </button>
            </div>
        </div>
    </section>
    <section id="report-div" style="display: none;">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-1 mt-2 text-bold-600">Balance Summary</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="balance-summary-loader">
                <div class="loader-wrapper">
                    <div class="loader-wrapper">
                        <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="balance-summary-div" style="display: none; padding: 10px">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-1 mt-2 text-bold-600">Balance Details</h5>
                <hr>
            </div>
            {{--    <div class="col-md-12" id="balance-details-loader">
                    <div class="loader-wrapper">
                        <div class="loader-wrapper">
                            <div class="loader-container">
                                <div class="ball-clip-rotate-multiple loader-success">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
            <div class="col-md-12" id="balance-details-div">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                   data-toggle="tab"
                                                   aria-controls="minutes"
                                                   href="#minutes"
                                                   aria-expanded="true">Minutes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-toggle="tab"
                                                   aria-controls="sms"
                                                   href="#sms"
                                                   aria-expanded="false">SMS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-toggle="tab"
                                                   aria-controls="internet"
                                                   href="#internet"
                                                   aria-expanded="false">Internet</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel"
                                                 class="tab-pane active"
                                                 id="minutes"
                                                 aria-expanded="true"
                                                 aria-labelledby="minutes">
                                                <div class="col-md-12" id="minutes-details-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="sms"
                                                 aria-labelledby="base-tab42">
                                                <div class="col-md-12" id="sms-details-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="internet"
                                                 aria-labelledby="base-tab43">
                                                <div class="col-md-12" id="internet-details-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row" style="background-color: white">
                <div class="col-md-12">
                    <div class="row" style="padding: 10px">
                        <div class="col-md-8">
                            <h5 class="mb-1 mt-2 text-bold-600">Recent Browse History</h5>
                        </div>
                        <div class="col-md-4">
                            <input type='date'
                                   class="form-control datetime"
                                   id="date"
                                   value="{{ $current_date }}"
                                   min="{{ $last_date }}"
                                   max="{{ $current_date }}"
                                   name="date">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <table class="table table-bordered" id="audit_log_table">
                        <thead class="alert-warning">
                        <tr>
                            <th>Browse Time</th>
                            <th>URL</th>
                            <th>Source</th>
                            <th>Request Data</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2 mb-2" style="background-color: white">
            <div class="row">
                <div class="col-md-4 mt-2">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="loader-wrapper" id="last-login-loader">
                                    <div class="loader-wrapper">
                                        <div class="loader-container">
                                            <div class="ball-clip-rotate-multiple loader-success">
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media d-flex" id="last-login-div" style="display: none;">
                                    <div class="align-self-center">
                                        <i class="icon-login success font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 id="last-login-data"></h3>
                                        <span class="success">Last login</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-1 mt-2 text-bold-600">Recent Login Bonus Status</h5>
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type='date'
                                   class="form-control datetime"
                                   id="date_bonus"
                                   value="{{ $current_date }}"
                                   min="{{ $last_date }}"
                                   max="{{ $current_date }}"
                                   name="date">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <table class="table table-bordered" id="bonus_log_table">
                            <thead class="alert-warning">
                            <tr>
                                <th>Date</th>
                                <th>Bonus type</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12" style="background-color: white; padding: 10px">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-1 mt-2 text-bold-600">Recent OTP Request Logs</h5>
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type='date'
                                   class="form-control datetime"
                                   id="date_otp"
                                   value="{{ $current_date }}"
                                   min="{{ $last_date }}"
                                   max="{{ $current_date }}"
                                   name="date">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12" style="background-color: white; padding: 10px;">
                    <table class="table table-bordered" id="otp_log_table">
                        <thead class="alert-warning text-white">
                        <tr>
                            <th>Request Time</th>
                            <th>OTP</th>
                            <th>Source</th>
                            <th>Version</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>


        <br/>
        <div class="row">

            <div class="col-md-12">
                <div class="col-md-12" style="padding: 10px">

                <div class="row">
                    <div class="col-md-8">
                        <h5 class="mb-1 mt-2 text-bold-600">Recent OTP and Login Logs</h5>
                    </div>

                    <div class="col-md-4 mt-2">
                        <input type='date'
                               class="form-control datetime"
                               id="date_otp_login"
                               value="{{ $current_date }}"
                               min="{{ $date_limit }}"
                               max="{{ $current_date }}"
                               name="date" >
                    </div>
                  </div>
                </div>

                <hr>
                <div class="col-md-12" style="background-color: white; padding: 10px;">
                    <table class="table table-bordered" id="otp_login_table">
                        <thead class="alert-warning text-white">
                        <tr>
                            <th>Request Time</th>
                            <th>number</th>
                            <th>response</th>
                            <th>message</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div>
                    <h5 class="mb-1 mt-2 text-bold-600 pull-left">Summary Usage History</h5>
                    <h5 class="mb-1 mt-2 text-bold-600 pull-right">{{ $last_date }} - {{ $current_date }}</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="usage-summary-loader">
                <div class="loader-wrapper">
                    <div class="loader-wrapper">
                        <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
            <div class="col-md-12" id="usage-summary-div" style="display: none;">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div>
                    <h5 class="mb-1 mt-2 text-bold-600 pull-left">Usage Details</h5>
                    <h5 class="mb-1 mt-2 text-bold-600 pull-right">{{ $last_date }} - {{ $current_date }}</h5>
                </div>
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
            <div class="col-md-12" id="usage-details-div">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                   data-toggle="tab"
                                                   aria-controls="minutes"
                                                   href="#minutes-usage"
                                                   aria-expanded="true">Minutes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-toggle="tab"
                                                   aria-controls="sms"
                                                   href="#sms-usage"
                                                   aria-expanded="false">SMS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-toggle="tab"
                                                   aria-controls="internet"
                                                   href="#internet-usage"
                                                   aria-expanded="false">Internet</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-toggle="tab"
                                                   aria-controls="internet"
                                                   href="#subscription-usage"
                                                   aria-expanded="false">Subscription</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-toggle="tab"
                                                   aria-controls="internet"
                                                   href="#recharge-usage"
                                                   aria-expanded="false">Recharge</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel"
                                                 class="tab-pane active"
                                                 id="minutes-usage"
                                                 aria-expanded="true"
                                                 aria-labelledby="minutes">
                                                <div class="col-md-12" id="minutes-usage-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="sms-usage"
                                                 aria-labelledby="base-tab42">
                                                <div class="col-md-12" id="sms-usage-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="internet-usage"
                                                 aria-labelledby="base-tab43">
                                                <div class="col-md-12" id="internet-usage-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="subscription-usage"
                                                 aria-labelledby="base-tab43">
                                                <div class="col-md-12" id="subscription-usage-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="recharge-usage"
                                                 aria-labelledby="base-tab43">
                                                <div class="col-md-12" id="recharge-usage-loader">
                                                    <div class="loader-wrapper">
                                                        <div class="loader-wrapper">
                                                            <div class="loader-container">
                                                                <div class="ball-clip-rotate-multiple loader-success">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--================================================================================--}}

        <div class="row mt-3">
            <div class="col-md-6">
                <div>
                    <h5 class="mb-1 mt-2 text-bold-600 pull-left">Product Logs</h5>
                    {{--                    <h5 class="mb-1 mt-2 text-bold-600 pull-right">{{ $last_date }} - {{ $current_date }}</h5>--}}
                </div>

            </div>
            <div class="col-md-6">
                <input type='text'
                       class="form-control date_range"
                       id="logDate"
                       {{-- value="{{ $current_date }}" --}}
                       {{-- min="{{ $last_date }}" --}}
                       {{-- max="{{ $current_date }}" --}}
                       name="log_date"  autocomplete="off" placeholder="Select date">
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
            <div class="col-md-12" id="usage-details-div">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <table id="productLog" class="table table-bordered table-striped">
                                            <thead class="text-center alert-warning text-white">
                                            <th>Date</th>
                                            <th>Msisdn</th>
                                            <th>Product Code</th>
                                            <th>
                                                Balance
                                                <i class="la la-question-circle" style="cursor: pointer"
                                                   title="Balance before purchase"></i>
                                            </th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Contact restore logs--}}
        <div class="row mt-3">
                <div class="col-md-8 mr-1">
                    <h5 class="mb-1 mt-2 text-bold-600">Contact Number Restore Logs</h5>
                </div>

                <div class="col-md-3 mt-1 ml-5">
                    <input type='text'
                           placeholder="Date"
                           class="form-control datetime contact_log_date"
                           id="search-contact-restore-log"
                           autocomplete="off"
                           name="search_contact_log" >
                </div>

            <div class="col-md-12">
                <hr/>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="contact_restore_logs_table">
                                <thead class="text-center alert-warning text-white">
                                <tr>
                                    <th>Backup Id</th>
                                    <th width="15%">Message</th>
                                    <th>Date time</th>
                                    <th>Platform</th>
                                    <th>Device OS</th>
                                    <th>Device model</th>
                                    <th>Mobile number</th>
                                    <th>Total Restore</th>
                                    <th>Restored</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Contact restore logs-->
        <div class="row mt-3">
            <div class="col-md-12">
                <div>
                    <h5 class="mb-1 mt-2 text-bold-600 pull-left">Header Msisdn Enrichment</h5>
                    {{--                    <h5 class="mb-1 mt-2 text-bold-600 pull-right">{{ $last_date }} - {{ $current_date }}</h5>--}}
                </div>
            </div>
{{--            <div class="col-md-12">--}}
{{--                <hr/>--}}
{{--            </div>--}}
            <div class="col-md-12" id="usage-details-div">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <table id="productLog" class="table table-bordered table-striped">
                                            <thead class="text-center alert-warning text-white">
                                            <th>Msisdn</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/loaders/loaders.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-loader.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>

    <script>
        $(function () {

            $('.date_range').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                startDate: moment().add(9, 'day'),
                // minDate: moment(),
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                },
            });

            $('input[name="log_date"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + '=' + picker.endDate.format('YYYY-MM-DD'));
            });

            $('input[name="log_date"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $.fn.dataTable.ext.errMode = 'none';
            $(document).on('click', '#search_btn', function (e) {
                let number;
                let pattern;
                e.preventDefault();
                number = $('#search_input').val();

                pattern = new RegExp('^01[3456789][0-9]{8}\\b');

                if (!pattern.test(number)) {
                    alert('Please enter a valid number');
                    return;
                }

                $('#report-div').show();

                $("#last-login-loader").show();
                $("#last-login-div").hide();

                getBalanceData(number);
                getAuditData(number);
                getBonusData(number);
                getLastLogin(number);
                getUsageDetails(number);
                getOtpData(number);
                getOtpLoginData(number);
                getProductLog(number);
                getContactRestoreLogsData(number);

            });

            fetchData = function (query, dataURL) {
                return $.ajax({
                    data: query,
                    url: dataURL
                });
            }

            function getLastLogin(number) {
                let getLastLogin = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/last-login/' + number);

                getLastLogin.done(function (data) {
                    $("#last-login-data").html(data);

                    $("#last-login-loader").hide();
                    $("#last-login-div").show();
                })
            }


            function getBalanceData(number) {
                let getSummary = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/balance-summary/' + number);

                let getInternetDetails = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/balance-details/' + number + '/internet');

                let getMinutesDetails = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/balance-details/' + number + '/minutes');

                let getSmsDetails = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/balance-details/' + number + '/sms');

                let getUsageSummary = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/usage-summary/' + number);

                $("#balance-summary-loader").show();
                $("#balance-summary-div").hide();

                $("#internet-details-loader").show();
                $("#minutes-details-loader").show();
                $("#sms-details-loader").show();
                $("#usage-summary-loader").hide();

                getSummary.done(function (data) {
                    $("#balance-summary-div").html(data);

                    $("#balance-summary-loader").hide();
                    $("#balance-summary-div").show();
                })

                getInternetDetails.done(function (data) {
                    $("#internet").html(data);

                    $("#internet-details-loader").hide();
                })

                getMinutesDetails.done(function (data) {
                    $("#minutes").html(data);

                    $("#minutes-details-loader").hide();
                })

                getSmsDetails.done(function (data) {
                    $("#sms").html(data);

                    $("#sms-details-loader").hide();
                })

                getUsageSummary.done(function (data) {
                    $("#usage-summary-div").html(data);

                    $("#usage-summary-loader").hide();

                    $("#usage-summary-div").show();
                })
            }

            function getProductLog(number) {

                $('#productLog').DataTable().destroy();

                $("#productLog").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: "/developer/api/debug/product/log/" + number,
                        data: {
                            date: function () {
                                return $("#logDate").val();
                            }
                        }
                    },
                    columns: [
                        {
                            name: 'date',
                            render: function (data, type, row) {
                                return row.date;
                            }
                        },
                        {
                            name: 'msisdn',
                            render: function (data, type, row) {
                                return row.msisdn;
                            }
                        },
                        {
                            name: 'others',
                            render: function (data, type, row) {
                                return row.others;
                            }
                        },
                        {
                            name: 'balance',
                            render: function (data, type, row) {
                                return row.balance;
                            }
                        },
                        {
                            name: 'message',
                            render: function (data, type, row) {
                                return row.message;
                            }
                        }, {
                            name: 'status',
                            render: function (data, type, row) {
                                return row.status;
                            }
                        }
                    ]
                });
            }

            function getUsageDetails(number) {
                let minutes = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/usage-details/' + number + '/minutes');

                let sms = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/usage-details/' + number + '/sms');

                let internet = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/usage-details/' + number + '/internet');

                let subscription = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/usage-details/' + number + '/subscription');

                let recharge = fetchData(
                    {
                        'number': number
                    }, '/developer/api/debug/usage-details/' + number + '/recharge');

                minutes.done(function (data) {
                    $("#minutes-usage").html(data);
                })

                sms.done(function (data) {
                    $("#sms-usage").html(data);
                })

                internet.done(function (data) {
                    $("#internet-usage").html(data);
                })

                internet.fail(function (data) {
                    $("#internet-usage").html(data);
                })

                recharge.done(function (data) {
                    $("#recharge-usage").html(data);
                })

                subscription.done(function (data) {
                    $("#subscription-usage").html(data);
                })
            }

            function getAuditData(number) {

                $('#audit_log_table').DataTable().destroy();

                $("#audit_log_table").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: "/developer/api/debug/audit_logs/" + number,
                        data: {
                            date: function () {
                                return $("#date").val();
                            }
                        }
                    },
                    columns: [
                        {
                            name: 'browse_date',
                            render: function (data, type, row) {
                                return row.browse_date;
                            }
                        },

                        {
                            name: 'browse_url',
                            render: function (data, type, row) {
                                return row.browse_url;
                            }
                        },

                        {
                            name: 'source',
                            render: function (data, type, row) {
                                return row.source;
                            }
                        },
                        {
                            name: 'request_data',
                            render: function (data, type, row) {
                                return row.request_data;
                            }
                        }
                    ]
                });
            }

            function getBonusData(number) {

                $('#bonus_log_table').DataTable().destroy();

                $("#bonus_log_table").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: "/developer/api/debug/bonus_logs/" + number,
                        data: {
                            date: function () {
                                return $("#date_bonus").val();
                            }
                        }
                    },
                    columns: [
                        {
                            name: 'date',
                            render: function (data, type, row) {
                                return row.date;
                            }
                        },

                        {
                            name: 'bonus_type',
                            render: function (data, type, row) {
                                return row.bonus_type;
                            }
                        },

                        {
                            name: 'status',
                            render: function (data, type, row) {
                                return row.status;
                            }
                        }
                    ]
                });
            }

            function getOtpData(number) {

                $('#otp_log_table').DataTable().destroy();

                $("#otp_log_table").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: "/developer/api/debug/otp-logs/" + number,
                        data: {
                            date: function () {
                                return $("#date_otp").val();
                            }
                        }
                    },
                    columns: [
                        {
                            name: 'request_time',
                            render: function (data, type, row) {
                                return row.date;
                            }
                        },

                        {
                            name: 'otp',
                            render: function (data, type, row) {
                                return row.otp;
                            }
                        },

                        {
                            name: 'source',
                            render: function (data, type, row) {
                                return row.source;
                            }
                        },

                        {
                            name: 'otp',
                            render: function (data, type, row) {
                                return row.version;
                            }
                        },

                        {
                            name: 'status',
                            render: function (data, type, row) {
                                if (row.status == 200) {
                                    return `<div class="badge badge-success">
                                                  <span>` + row.status + `</span>
                                                  <i class="la la-check-circle-o font-medium-2"></i>
                                                </div>`;
                                }

                                return `<div class="badge badge-danger">
                                                  <span>` + row.status + `</span>
                                                  <i class="la la-bell-o font-medium-2"></i>
                                                </div>`;
                            }
                        }
                    ]
                });
            }


            function getOtpLoginData(number) {
                $('#otp_login_table').DataTable().destroy();
                $("#otp_login_table").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: "/developer/api/debug/otp-login-logs/" + number,
                        data: {
                            date: function () {
                                return $("#date_otp_login").val();
                            }
                        }
                    },
                    columns: [
                        {
                            name: 'request_time',
                            render: function (data, type, row) {
                                return row.date;
                            }
                        },
                        {
                            name: 'number',
                            render: function (data, type, row) {
                                return row.number;
                            }
                        },
                        {
                            name: 'response',
                            render: function (data, type, row) {
                                return row.response;
                            }
                        },
                        {
                            name: 'message',
                            render: function (data, type, row) {
                                return row.message;
                            }
                        },
                        {
                            name: 'status',
                            render: function (data, type, row) {
                                return row.status;
                            }
                        }
                    ]
                });
            }

            $(document).on('input', '#date', function (e) {
                e.preventDefault();
                $('#audit_log_table').DataTable().ajax.reload();
            });

            $(document).on('input', '#date_bonus', function (e) {
                e.preventDefault();
                $('#bonus_log_table').DataTable().ajax.reload();
            });

            $(document).on('input', '#date_otp', function (e) {
                e.preventDefault();
                $('#otp_log_table').DataTable().ajax.reload();
            });

            $(document).on('input', '#date_otp_login', function (e) {
                e.preventDefault();
                $('#otp_login_table').DataTable().ajax.reload();
            });


            // Contact Restore Log
            var contact_restore_log_date = $('#search-contact-restore-log');

            var date = new Date();
            date.setDate(date.getDate());

            contact_restore_log_date.daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });

            contact_restore_log_date.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + '--' + picker.endDate.format('YYYY/MM/DD'));
            });
            contact_restore_log_date.on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            // contact_restore_log.datetimepicker({
            //     format : 'YYYY-MM-DD',
            //     showClose: true,
            //     showClear: true,
            //     maxDate: date
            // });
            // contact_restore_log.val('')

            // $(document).on('input', '#search-contact-restore-log', function (e) {
            //     e.preventDefault();
            //     $('#contact_restore_logs_table').DataTable().ajax.reload();
            // });

            function getContactRestoreLogsData(number) {
                $('#contact_restore_logs_table').DataTable().destroy();
                $("#contact_restore_logs_table").dataTable({
                    scrollX: true,
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ordering: false,
                    autoWidth: false,
                    pageLength: 10,
                    lengthChange: false,
                    ajax: {
                        url: "/developer/api/debug/contact-restore-logs/" + number,
                        data: {
                            date: function () {
                                return $("#search-contact-restore-log").val();
                            },
                            number: function () {
                                return $('#search_input').val();
                            }
                        }
                    },
                    columns: [
                        {
                            name: 'contact_backup_id',
                            render: function (data, type, row) {
                                return row.contact_backup_id;
                            }
                        },
                        {
                            name: 'message',
                            render: function (data, type, row) {
                                return row.message;
                            }
                        },
                        {
                            name: 'date_time',
                            width: "20%",
                            render: function (data, type, row) {
                                return row.date_time;
                            }
                        },
                        {
                            name: 'platform',
                            render: function (data, type, row) {
                                return row.platform;
                            }
                        },
                        {
                            name: 'device_os',
                            render: function (data, type, row) {
                                return row.device_os;
                            }
                        },
                        {
                            name: 'device_model',
                            render: function (data, type, row) {
                                return row.device_model;
                            }
                        },
                        {
                            name: 'mobile_number',
                            render: function (data, type, row) {
                                return row.mobile_number;
                            }
                        },
                        {
                            name: 'total_number_to_be_restore',
                            render: function (data, type, row) {
                                return row.total_number_to_be_restore;
                            }
                        },
                        {
                            name: 'total_restore',
                            render: function (data, type, row) {
                                return row.total_restore;
                            }
                        },
                    ]
                });
            }

            contact_restore_log_date.on('apply.daterangepicker', function(ev, picker) {
                $('#contact_restore_logs_table').DataTable().ajax.reload();
            });
            contact_restore_log_date.on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#contact_restore_logs_table').DataTable().ajax.reload();
            });

            // $('input[name="search_contact_log"]').on('dp.change',function (e) {
            //     e.preventDefault();
            //     $('#contact_restore_logs_table').DataTable().ajax.reload();
            // });
        })


        $('#logDate').on('apply.daterangepicker', function(ev, picker) {
                $('#productLog').DataTable().ajax.reload();
            });
            $('#logDate').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#productLog').DataTable().ajax.reload();
            });
    </script>
@endpush
