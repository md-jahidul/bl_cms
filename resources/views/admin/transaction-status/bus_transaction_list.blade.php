@extends('layouts.admin')
@section('title', 'Bus Transaction Status')
@section('card_name', 'Bus Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Bus Transaction Status</li>
@endsection
@section('content')
@php
@endphp
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
                                <td>Ticket Id:</td>
                                <td><input type="text" class="form-control" id="ticket_id" name="ticket_id" autocomplete="off"></td>
                                <td>From:</td>
                                <td><input type="text" class="datepicker form-control" id="from" name="from" autocomplete="off"></td>
                                <td>To:</td>
                                <td><input type="text" class="datepicker form-control" id="to" name="to" autocomplete="off"></td>
                                <td><input id="submit" value="Search"  class="btn btn-sm btn-success "  type="button" ></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped table-bordered dataTable"
                            id="bus_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Ticket Id</th>
                                <th>Ticket No</th>
                                <th>From Station</th>
                                <th>To Station</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Bus Name</th>
                                <th>Amount</th>
                                <th>Passenger Name</th>
                                <th>Passenger Email</th>
                                <th>Passenger Mobile</th>
                                <th>Booked At</th>
                                <th>Confirmed At</th>
                                <th>Cancelled At</th>
                                <th>Expiry Time</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
            margin-top: -52px;
        }
        .dt-buttons.btn-group {
            text-align: center;
            margin-bottom: 2px;
            /*margin-left: 27%;*/
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').datetimepicker({
                format : 'YYYY-MM-DD',
                showClose: true,
            });
            
            $("#bus_transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                lengthMenu: [[30, 50, -1], [30, 50, "All"]],
                pageLength: 30,
                lengthChange: true,
                ajax: {
                    url: '{{ route('mybl.transaction-status.list',['type' => request('type')]) }}',
                    data: {
                        ticket_id: function () {
                            return $("#ticket_id").val();
                        },
                        from: function () {
                            return $("#from").val();
                        },
                        to: function () {
                            return $("#to").val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: '30px',
                        render: function () {
                            return null;
                        }
                    },

                    {
                        name: 'ticket_id',
                        render: function (data, type, row) {
                            return row.ticket_id;
                        }
                    },
                    
                    {
                        name: 'ticket_no',
                        render: function (data, type, row) {
                            return row.ticket_no;
                        }
                    },
                    
                    {
                        name: 'from_station',
                        render: function (data, type, row) {
                            return row.from_station;
                        }
                    },
                    
                    {
                        name: 'to_station',
                        render: function (data, type, row) {
                            return row.to_station;
                        }
                    },
                    
                    {
                        name: 'date',
                        render: function (data, type, row) {
                            return row.date;
                        }
                    },
                    
                    {
                        name: 'time	',
                        render: function (data, type, row) {
                            return row.time	;
                        }
                    },
                    
                    {
                        name: 'bus_name	',
                        render: function (data, type, row) {
                            return row.bus_name	;
                        }
                    },
                    
                    {
                        name: 'amount	',
                        render: function (data, type, row) {
                            return row.amount	;
                        }
                    },
                    {
                        name: 'passenger_name	',
                        render: function (data, type, row) {
                            return row.passenger_name	;
                        }
                    },
                    {
                        name: 'passenger_email	',
                        render: function (data, type, row) {
                            return row.passenger_email	;
                        }
                    },
                    {
                        name: 'passenger_mobile	',
                        render: function (data, type, row) {
                            return row.passenger_mobile	;
                        }
                    },
                    {
                        name: 'booked_at	',
                        render: function (data, type, row) {
                            return row.booked_at	;
                        }
                    },
                    {
                        name: 'confirmed_at	',
                        render: function (data, type, row) {
                            return row.confirmed_at	;
                        }
                    },
                    {
                        name: 'cancelled_at	',
                        render: function (data, type, row) {
                            return row.cancelled_at	;
                        }
                    },
                    {
                        name: 'expiry_time	',
                        render: function (data, type, row) {
                            return row.expiry_time	;
                        }
                    },
                    {
                        name: 'date',
                        render: function (data, type, row) {
                            return row.date	;
                        }
                    }
                ],
                dom: 'Blfrtip',
                buttons:  [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#bus_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
