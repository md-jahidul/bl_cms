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
                <h5 class="mb-1">Balance Summary</h5>
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
                <h5 class="mb-1">Balance Details</h5>
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
            let fetchData;
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

                getBalanceData(number);

            });

            fetchData = function (query, dataURL) {
                return $.ajax({
                    data: query,
                    url: dataURL
                });
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

                $("#balance-summary-loader").show();
                $("#balance-summary-div").hide();

                $("#internet-details-loader").show();
                $("#minutes-details-loader").show();
                $("#sms-details-loader").show();

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
            }
        })
    </script>
@endpush







