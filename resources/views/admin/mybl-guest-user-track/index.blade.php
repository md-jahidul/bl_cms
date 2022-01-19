@extends('layouts.admin')
@section('title', 'Guest User Analytics')
@section('card_name', 'Guest User Analytics')
@section('breadcrumb')
{{--    <li class="breadcrumb-item ">Guest User Tracking List</li>--}}
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <h4 class="content-header-title mb-0 d-inline-block">Guest User Access Log List</h4>

                <button class="btn-sm btn-outline-warning waves-effect waves-light float-right fa-mouse-pointer" type="button" data-toggle="collapse" data-target="#filter-form" aria-expanded="false" aria-controls="filter-form">
                    <i class="la la-filter"></i> <b>Filter</b>
                </button>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">

                    <form action="{{--{{route('transactions.export')}}--}}" id="filter-form" class="collapse filter-container" method="GET">
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
                                <input type="text" name="msisdn_entry_type" class="form-control filter"
                                       autocomplete="off" id="msisdn" placeholder="Msisdn Entry Type">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="device_id" class="form-control"
                                       autocomplete="off" id="device_id" placeholder="DeviceId">
                            </div>

{{--                            <div class="form-group col-md-3">--}}
{{--                                <input type="text" name="platform" class="form-control"--}}
{{--                                       autocomplete="off" id="platform" placeholder="Platform">--}}
{{--                            </div>--}}

                            <div class="form-group col-md-3">
                                <select class="form-control" name="platform" id="platform">
                                    <option value="">--Select Platform--</option>
                                    <option value="android">Android</option>
                                    <option value="ios">IOS</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="page_name" class="form-control showdropdowns filter"
                                       autocomplete="off" id="page_name" placeholder="Page Name">
                            </div>

                            <div class="form-group col-md-3">
                                <select class="form-control" name="status" id="status">
                                    <option value="">--Select Status--</option>
                                    <option value="1">Success</option>
                                    <option value="0">Failed</option>
                                </select>
                            </div>

{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="eventInput4">Status</label>--}}

{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-1">--}}
{{--                                <button type="button" class="btn-sm btn-primary"><i class="la la-search"></i></button>--}}
{{--                            </div>--}}




{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="eventInput4">Customer Msisdn</label>--}}
{{--                                    <input type="text" name="customer_msisdn" id="" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="eventInput4">Bl unique ID</label>--}}
{{--                                    <input type="text" name="unique_id" id="" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>From Date</label>--}}
{{--                                    <div class='input-group date' >--}}
{{--                                        <input type='text' class="form-control datetimepicker1" name="from_date" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>To Date</label>--}}
{{--                                    <div class='input-group date' >--}}
{{--                                        <input type='text' class="form-control datetimepicker1" name="to_date" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="eventInput4">Payment Gateway</label>--}}
{{--                                    <select class="form-control" name="payment_gateway" >--}}
{{--                                        <option value="">select options</option>--}}
{{--                                        @foreach($gateways as $gateway)--}}
{{--                                            <option value="{{$gateway->gateway_id}}">{{$gateway->payment_channel}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="eventInput4">Recharge Status</label>--}}
{{--                                    <select class="form-control" name="recharge_status" >--}}
{{--                                        <option value="">select options</option>--}}
{{--                                        <option value="Successful">Success</option>--}}
{{--                                        <option value="Failed">Fail</option>--}}
{{--                                        <option value="refund">Refund</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="eventInput4">Recharge Platform</label>--}}
{{--                                    <select class="form-control" name="retailer_channel_id" >--}}
{{--                                        <option value="">select options</option>--}}
{{--                                        @foreach($channels as $channel)--}}
{{--                                            <option value="{{$channel->id}}">{{$channel->channel_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>

{{--                        <footer>--}}
{{--                            <button data-feature="filter" data-target="#dataTableBuilder"--}}
{{--                                    data-filter="#filter-form" class="btn btn-sm btn-warning" type="button">--}}
{{--                                <i class="fa fa-search"></i> Search--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-sm btn-info" type="submit">--}}
{{--                                <i class="fa fa-download"></i> Export--}}
{{--                            </button>--}}
{{--                        </footer>--}}
{{--                        <hr class="clearfix">--}}
                    </form>




                    <form id="filter_form" action="{{ route('lead_data.excel_export') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">


                            <table class="table table-striped table-bordered" id="guestUserTrackList"> <!--zero-configuration-->
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Msisdn</th>
                                    <th>Msisdn Input Type</th>
                                    <th>DeviceID</th>
                                    <th>Platform</th>
                                    <th>Page Access</th>
                                    <th>Status</th>
                                    <th>Failed Reason</th>
                                    <th>Date & Time</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <style>
        div.dt-buttons{
            position:relative;
            float:right;
        }
    </style>
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


            // Guest User Track Data
            $("#guestUserTrackList").dataTable({
                lengthChange: true,
                lengthMenu: [[5, 10, 50, 100, 500, 1000, -1], [5, 10, 50, 100, 500, '1K', 'ALL']],
                pageLength: 5,
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                dom: 'Bflrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    }
                ],
                ajax: {
                    url: '{{ url('guest-user-track-list') }}',
                    {{--url: '{{ route('lead-list.ajex') }}',--}}
                    data: {
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
                            return $('input[name="msisdn_entry_type"]').val();
                        },
                        platform: function () {
                            return $('select[name="platform"]').val();
                        },
                        page_name: function () {
                            return $('input[name="page_name"]').val();
                        },
                        status: function () {
                            return $('select[name="status"]').val();
                        }
                    }
                },

                "drawCallback": function (settings) {
                    // Here the response
                    var response = settings.json;
                    if (response.permission == false){
                        $('#permission_error').show()
                    }else {
                        $('#permission_error').hide()
                    }
                },

                columns: [
                    {
                        name: 'sl',
                        width: "2%",
                        render: function () {
                            return null;
                        }
                    },
                    {
                        name: 'msisdn',
                        width: "5%",
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    {
                        name: 'msisdn_entry_type',
                        class: 'text-center',
                        width: "6%",
                        render: function (data, type, row) {
                            let inputType = "";
                            if(row.msisdn_entry_type === "header_input") {
                                inputType = "<b class='text-success'>Automatic</b>"
                            } else {
                                inputType = "<b class='text-warning'>User Input</b>"
                            }
                            return inputType;
                        }
                    },
                    {
                        name: 'device_id',
                        width: "5%",
                        render: function (data, type, row) {
                            return row.device_id;
                        }
                    },
                    {
                        name: 'platform',
                        width: "8%",
                        render: function (data, type, row) {
                            return row.platform;
                        }
                    },
                    {
                        name: 'page_name',
                        width: "15%",
                        render: function (data, type, row) {
                            let pageName = ""
                            if (row.page_name === "number_verification"){
                                pageName = "The number is not BL number"
                            } else {
                                pageName = row.page_name
                                //     + `<button class="btn-sm btn-outline-danger cursor-pointer" data-toggle="tooltip"
                                // title="Please select deeplink action in the edit form. then try to generate deeplink."> Reason</button>`;
                            }
                            return pageName;
                        }
                    },
                    {
                        name: 'status',
                        width: "6%",
                        class: "text-center",
                        render: function (data, type, row) {
                            let status = '';
                            if(row.status) {
                                status += '<span class="badge badge-success">Success</span>'
                            } else {
                                status += '<span class="badge badge-danger">Failed</span>'
                            }
                            return status;
                        }
                    },
                    {
                        name: 'failed_reason',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.failed_reason;
                        }
                    },
                    {
                        name: 'created_at',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.created_at;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="device_id"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="msisdn"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="page_name"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('select[name="platform"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('select[name="status"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });
            // Guest User Track Data
        });
    </script>
@endpush





