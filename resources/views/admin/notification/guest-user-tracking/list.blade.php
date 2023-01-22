@extends('layouts.admin')
@section('title', 'Guest User Tracking')
@section('card_name', 'Guest User Tracking')
@section('breadcrumb')
    <li class="breadcrumb-item active">Guest User List</li>
@endsection
@section('action')
    <a href="#" class="btn btn-primary round btn-glow px-2"><i class="la la-paper-plane-o"></i>
        Send Selected Notification
    </a>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">

                    <div class="col-md-12 mb-1">
                        <div class="row">

                            <div class="col-md-6" style="margin-top: 5px">
                                <input type="text" name="date_range" class="form-control filter datetime"
                                       autocomplete="off" id="date_picker" placeholder="Filter By Date">
<!--                                <input type="text" placeholder="From" class="datepicker form-control" id="from" name="from" autocomplete="off">
                                <input type="text" placeholder="To" class="datepicker form-control" id="to" name="to" autocomplete="off" style="margin-top: 5px">-->

<!--                                <input type='text'
                                       class="form-control datetime filter"
                                       style="height: 40px"
                                       value=""
                                       name="logout_time"
                                       id="logout_time"/>-->
                            </div>

                            <div class="col-md-3" style="margin-top: 5px">
                                <select name="device_type" class="form-control filter" id="device_type">
                                    <option value=""> Device Type</option>
                                    <option value="android">ANDROID</option>
                                    <option value="ios">IOS</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-top: 5px">
                                <select name="number_type" class="form-control filter" id="number_type">
                                    <option value=""> Number Type</option>
                                    <option value="prepaid">PREPAID</option>
                                    <option value="ios">POSTPAID</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered dataTable" id="guest_user_datatable">
                        <thead>
                        <tr>
                            <th width="5%"><input type="checkbox" id="checkAll"> Select all</th>
                            <th width="30%">Msisdn</th>
                            <th width="30%">Device Type</th>
                            <th width="30%">Number Type</th>
                            <th width="5%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@endsection




@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>

        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            showDropdowns: true,
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY/MM/DD'
            },
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD') + '--' + picker.endDate.format('YYYY/MM/DD'));
        });

        $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        //$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

        /*var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());
        $('.datetime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 5,
            startDate: '{{--{{ date('Y-m-d H:i:s')}}--}}',
            endDate: '{{--{{ date('Y-m-d H:i:s', strtotime('+ 6 hours'))}}--}}',
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });*/

        /*$(document).ready(function () {
            $('#guest_user_datatable').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
                "order": [],
            });
        });*/

        $("#guest_user_datatable").dataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            ajax: {
                url: '{{ route('guest.user.track') }}',
                type: 'GET',
                data: {
                    date_range: function () {
                        return $('input[name="date_range"]').val();
                    },
                    time_range: function () {
                        return $("#logout_time").val();
                    },
                    device_type: function () {
                        return $("#device_type").val();
                    },
                    number_type: function () {
                        return $("#number_type").val();
                    }
                }
            },
            columns: [
                {
                    name: '',
                    width: '30px',
                    orderable: false,
                    render: function () {
                        return `<input id="selected_notification" type="checkbox">`;
                    }
                },
                {
                    name: 'msisdn',
                    render: function (data, type, row) {
                        return row.msisdn;
                    }
                },
                {
                    name: 'device_type',
                    render: function (data, type, row) {
                        return row.device_type;
                    }
                },
                {
                    name: 'number_type',
                    render: function (data, type, row) {
                        return row.number_type;
                    }
                },
                {
                    name: 'action',
                    render: function (data, type, row) {
                        return `<a role="button"
                                               data-id=""
                                               href="#"
                                               data-placement="right"
                                               class="showButton btn btn-outline-info btn-sm"
                                               onclick=""><i class="la la-paper-plane"></i></a>`;
                    }
                }
            ],
        });

        $(".filter").on('change', function (e) {
            $('#guest_user_datatable').DataTable().ajax.reload();
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $('#guest_user_datatable').DataTable().ajax.reload();
        });

        $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $('#guest_user_datatable').DataTable().ajax.reload();
        });
    </script>
@endpush
