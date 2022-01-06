@extends('layouts.admin')
@section('title', 'Guest User Data')
@section('card_name', 'Guest User Tracking List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Guest User Tracking List</li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form id="filter_form" action="{{ route('lead_data.excel_export') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" name="date_range" class="form-control filter"
                                       autocomplete="off" id="date_range" placeholder="Date">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="device_id" class="form-control"
                                       autocomplete="off" id="device_id" placeholder="DeviceId">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="platform" class="form-control showdropdowns filter"
                                       autocomplete="off" id="platform" placeholder="Platform">
                            </div>

                            <div class="form-group col-md-2">
                                <input type="text" name="page_name" class="form-control showdropdowns filter"
                                       autocomplete="off" id="page_name" placeholder="Page Name">
                            </div>

                            <div class="form-group col-md-1">
                                <button type="button" class="btn-sm btn-primary"><i class="la la-search"></i></button>
                            </div>

                        <table class="table table-striped table-bordered" id="guestUserTrackList"> <!--zero-configuration-->
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>DeviceId</th>
                                <th>Platform</th>
                                <th>Page Name</th>
                                <th>Created At</th>
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


            $("#guestUserTrackList").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
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
                        platform: function () {
                            return $('input[name="platform"]').val();
                        },
                        page_name: function () {
                            return $('input[name="page_name"]').val();
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
                        name: 'device_id',
                        width: "15%",
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
                            return row.page_name;
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

            $('input[name="page_name"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="platform"]').change(function() {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $('#guestUserTrackList').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#guestUserTrackList').DataTable().ajax.reload();
            });
        });
    </script>
@endpush





