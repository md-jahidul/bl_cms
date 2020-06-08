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
                <button type="button" class="btn btn-sm btn-icon btn-info" id="search_btn" ><i class="la la-search"></i></button>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info">100</h3>
                                            <span>MINUTES</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="la la-phone success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info">250</h3>
                                            <span>SMS</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-speech info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info">423</h3>
                                            <span>MB</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-globe primary font-large-2 float-right"></i>
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
            <div class="col-md-12">
                <h5 class="mb-1">Balance Details</h5>
                <hr>
            </div>
            <div class="col-md-12" id="balance-details-loader">
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
            <div class="col-md-12" id="balance-details-div" style="display: none;">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
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
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            var fetchData;
            $(document).on('click', '#search_btn', function (e) {
                var pattern;
                var number;
                e.preventDefault();
                number = $('#search_input').val();

                pattern = new RegExp('^01[3456789][0-9]{8}\\b');

                if(!pattern.test(number)){
                    alert('Please enter a valid number');
                    return;
                }

                $('#report-div').show();

                getBalanceData();

            });

            fetchData = function(query, dataURL) {
                return $.ajax({
                    data: query,
                    dataType: 'json',
                    url: dataURL
                });
            }

            function getBalanceData(number)
            {
                let getSummary = fetchData(
                    {
                        'number': number
                    }, '/path/to/url/1');

                let getDetails = fetchData(
                    {
                        'number': number
                    }, '/path/to/url/1');

                $.when(getSummary, getDetails).then(function(summary, details) {
                    // set summary data first

                    // set details data
                });

            }
        })
    </script>
@endpush







