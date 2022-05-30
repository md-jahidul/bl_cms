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
                    @if($fileDownloadStatus === "0")
                        <div class="alert bg-warning alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="la la-refresh"></i> File is the generation in progress... Please refresh again after a few minutes.
                        </div>
                    @endif

                    <form action="{{route('guest-user-data-export')}}" id="filter-form" class="filter-container"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3" id="date_range">
                                <input type="text" name="date_range" class="form-control filter"
                                       autocomplete="off" id="date_range" placeholder="Date" required>
                                <div class="help-block"></div>
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
                                    <option value="n/a">Not Applicable (N/A)</option>
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
                                    @foreach($pages as $key => $page)
                                        <option value="{{ $key }}">{{ $page }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="status" id="status">
                                    <option value="">--Select Status--</option>
                                    <option value="1">Success</option>
                                    <option value="0">Failed</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="user_activity_type" id="status">
                                    <option value="">--User Type--</option>
                                    <option value="1">Logged In User</option>
                                    <option value="0">Guest User</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="#" id="search-btn" class="btn btn-outline-dark"><i
                                            class="la la-search"></i> Search
                                    </a>
                                    <button type="submit" name="export_type" value="csv" class="btn btn-primary"><i
                                            class="la la-file"></i> CSV
                                    </button>
                                    @if($fileDownloadStatus > 0 && $filePathExists)
                                        <a href="{{ url('guest-user-data-download') }}" id="search-btn" class="btn btn-success"><i
                                                class="la la-download"></i> Download
                                        </a>
                                    @endif
{{--                                    <button type="submit" name="export_type" value="xlsx" class="btn btn-warning"><i--}}
{{--                                            class="la la-file-excel-o"></i> Excel--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <table class="table table-striped table-bordered" id="guestUserTrackList">
                                    <!--zero-configuration-->
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>Msisdn</th>
                                        <th>Msisdn Input Type</th>
                                        <th>DeviceID</th>
                                        <th>Platform</th>
                                        <th>Pages</th>
                                        <th>Status</th>
                                        <th>Failed Reason</th>
                                        <th>Date & Time</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#filter-form').validate()
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' ➝ ' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

            // Show Guest User Track Data
            $('#search-btn').click(function (e) {
                let date = $('input[name="date_range"]');
                if(!date.val()) {
                    $('#filter-form').submit()
                } else {
                    e.preventDefault()
                    swal.fire({
                        title: 'Data Loading. Please wait...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });

                    $.ajax({
                        method: 'POST',
                        url: '{{ url('guest-user-show-data') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            date_range: function () {
                                return $('input[name="date_range"]').val();
                            },
                            device_id: function () {
                                return $('input[name="device_id"]').val();
                            },
                            msisdn: function () {
                                return $('input[name="msisdn"]').val();
                            },
                            msisdn_entry_type: function () {
                                return $('select[name="msisdn_entry_type"]').val();
                            },
                            platform: function () {
                                return $('select[name="platform"]').val();
                            },
                            page_name: function () {
                                return $('select[name="page_name"]').val();
                            },
                            status: function () {
                                return $('select[name="status"]').val();
                            },
                            user_activity_type: function () {
                                return $('select[name="user_activity_type"]').val();
                            }
                        },
                        success: function (result) {
                            $("#guestUserTrackList tbody").children().remove()
                            result.data.map(function (data, index) {
                                let count = index + 1;
                                let msisdn = (data.msisdn) ? data.msisdn : "" ;
                                let failedReason = (data.failed_reason) ? data.failed_reason : "" ;
                                let inputType = "";
                                if (data.msisdn_entry_type === "header_input") {
                                    inputType = "<b class='text-success'>Automatic (Header Input)</b>";
                                } else if (data.msisdn_entry_type === "n/a") {
                                    inputType = "<b class='text-primary'>N/A</b>";
                                } else {
                                    inputType = "<b class='text-warning'>User Input</b>";
                                }

                                let status = '';
                                if (data.page_access_status) {
                                    status += '<span class="badge badge-success">Success</span>'
                                } else {
                                    status += '<span class="badge badge-danger">Failed</span>'
                                }

                                let tbody = `<tr>
                                            <td>`+count+`</td>
                                            <td>`+msisdn+`</td>
                                            <td>`+inputType+`</td>
                                            <td>`+data.device_id+`</td>
                                            <td>`+data.device_type+`</td>
                                            <td>`+data.page_name+`</td>
                                            <td>`+status+`</td>
                                            <td>`+failedReason+`</td>
                                            <td>`+data.created_at+`</td>
                                        </tr>`;
                                $("#guestUserTrackList tbody").append(tbody);
                            })

                            if (result.success) {
                                swal.fire({
                                    title: result.massage,
                                    type: 'success',
                                    timer: 1000,
                                    showConfirmButton: false
                                });
                            } else {
                                swal.fire({
                                    title: result.massage,
                                    type: 'warning',
                                    timer: 1000,
                                    showConfirmButton: false
                                });
                            }
                        }
                    });
                }
            })
            // Show Guest User Track Data
        });
    </script>
@endpush





