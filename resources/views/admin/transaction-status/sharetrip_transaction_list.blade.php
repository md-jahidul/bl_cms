@extends('layouts.admin')
@section('title', 'Sharetrip Transaction Status')
@section('card_name', 'Sharetrip Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Sharetrip Transaction Status</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
                                <td>Booking Code:</td>
                                <td><input type="text" class="form-control" id="booking_code" name="booking_code" autocomplete="off"></td>
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
                            id="sharetrip_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Msisdn</th>
                                <th>pnr code</th>
                                <th>Booking Code</th>
                                <th>Booking Status</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Created At</th>
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
    <script>
        $(function () {
            
            $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

            $("#sharetrip_transaction_list").dataTable({
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
                    url: '{{ route('mybl.transaction-status.sharetrip.list') }}',
                    data: {
                        booking_code: function () {
                            return $("#booking_code").val();
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
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    
                    {
                        name: 'pnr_code',
                        render: function (data, type, row) {
                            return row.pnr_code;
                        }
                    },
                    
                    {
                        name: 'booking_code',
                        render: function (data, type, row) {
                            return row.booking_code;
                        }
                    },
                    
                    {
                        name: 'booking_status',
                        render: function (data, type, row) {
                            return row.booking_status;
                        }
                    },
                    
                    {
                        name: 'payment_status',
                        render: function (data, type, row) {
                            return row.payment_status;
                        }
                    },
                    
                    {
                        name: 'amount',
                        render: function (data, type, row) {
                            return row.amount;
                        }
                    },
                    
                    {
                        name: 'createdAt	',
                        render: function (data, type, row) {
                            return row.createdAt	;
                        }
                    }
                ],
                dom: 'Blfrtip',
                buttons:  [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#sharetrip_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
