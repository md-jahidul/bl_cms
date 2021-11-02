@extends('layouts.admin')
@section('title', 'Guest User Tracking')
@section('card_name', 'Guest(Logged out) User Tracking')
@section('breadcrumb')
    <li class="breadcrumb-item active">Guest User List</li>
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

                            <div class="col-md-4">
                                <input type='text'
                                       class="form-control datetime"
                                       value=""
                                       name="logout_time"
                                       id="logout_time"/>
                            </div>

                            <div class="col-md-4">
                                <select name="device_type" class="form-control filter" id="device_type">
                                    <option value=""> Device Type</option>
                                    <option value="android">ANDROID</option>
                                    <option value="ios">IOS</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="number_type" class="form-control filter" id="number_type">
                                    <option value=""> Number Type</option>
                                    <option value="prepaid">PREPAID</option>
                                    <option value="ios">postpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered dataTable" id="guest_user_datatable">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="12%">Name</th>
                            <th width="25%">Msisdn</th>
                            <th width="10%">Device Type</th>
                            <th width="10%">Number Type</th>
                            <th width="10%">Platform</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($guestUsers as $user)
                            <tr>
                                <td width="5%"> {{ $user->id }} </td>
                                <td width="12%"> {{ data_get($user, 'name', '') }} </td>
                                <td width="25%"> {{ data_get($user, 'msisdn', '') }}</td>
                                <td width="10%"> {{ data_get($user, 'device_type', '') }}</td>
                                <td width="10%"> {{ data_get($user, 'number_type', '') }}</td>
                                <td width="10%"> {{ data_get($user, 'platform', '') }}</td>
                            </tr>
                        @endforeach
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

        var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());
        $('.datetime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 5,
            startDate: '{{ date('Y-m-d H:i:s')}}',
            endDate: '{{ date('Y-m-d H:i:s', strtotime('+ 6 hours'))}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });

        $(document).ready(function () {
            $('#guest_user_datatable').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
                "order": [],
            });
        });
    </script>
@endpush
