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
            <div class="col-md-12" id="balance-summary-div" style="display: none;">

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

        <div class="row">
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
                       name="date" >
            </div>
            <hr>
            <div class="col-md-12">
                <table class="table table-bordered" id="audit_log_table">
                    <thead>
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
                               name="date" >
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <table class="table table-bordered" id="bonus_log_table">
                        <thead>
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
            <div class="col-md-12"> <hr/></div>
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
            <div class="col-md-12"> <hr/></div>
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
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/loaders/loaders.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-loader.css') }}">
@endpush
@push('page-js')

    <script>
        $(function () {
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
                getUsageDetails(number)

            });

            fetchData = function (query, dataURL) {
                return $.ajax({
                    data: query,
                    url: dataURL
                });
            }

            function getLastLogin(number)
            {
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

                //developer/api/debug/usage-summary/{number}

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

            $(document).on('input', '#date', function (e) {
                e.preventDefault();
                $('#audit_log_table').DataTable().ajax.reload();
            });

            $(document).on('input', '#date_bonus', function (e) {
                e.preventDefault();
                $('#bonus_log_table').DataTable().ajax.reload();
            });
        })
    </script>
@endpush







